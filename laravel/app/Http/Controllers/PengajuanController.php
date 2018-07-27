<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;

class PengajuanController extends Controller
{
    protected $administrator='00';
    protected $operator 	='01';
    protected $verifikator 	='02';

    public function index()
    {
    	$status="";
    	if(session('kdlevel')==$this->administrator){ //administrator
    		$status = " WHERE a.status_id='3' ";
    	}
    	elseif(session('kdlevel')==$this->operator){ //operator
    		$status = " WHERE a.user_id='".session('id_user')."' AND a.status_id in('1','5') ";
    	}
    	elseif(session('kdlevel')==$this->verifikator){ //verifikator
    		$status = " WHERE a.status_id in('2','6') ";
    	}

    	$tahun="";
    	if(isset($_GET['tahun']) && $_GET['tahun']!==''){
    		$tahun=" AND a.tahun='".$_GET['tahun']."' ";
    	}

    	$rows = DB::select("
			SELECT 	a.id,
					b.jenis,
					a.nomor,
					a.tahun,
					a.tentang,
					a.nama_file,
					a.status_id,
					ifnull(a.keterangan,'-') AS keterangan,
					c.nama_status,
					d.kd_level
			FROM tb_peraturan a
			LEFT OUTER JOIN r_jenis_peraturan b ON(a.jenis_id=b.id)
			LEFT OUTER JOIN r_status c ON(a.status_id=c.id)
			LEFT OUTER JOIN tb_user d ON(a.user_id=d.id)
			".$status.$tahun."
			ORDER BY a.status_id
    	");
    	$rows=collect($rows);
    	
        $datatables = Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('action', function($row){
				return view('action-pengajuan', [
					'id'=>$row->id,
					'status_id'=>$row->status_id,
					'level'=>session('kdlevel'),
					'nm_file'=>$row->nama_file
				]);
			})
    		->make(true);

    	return $datatables;
    }

    public function jenis_dropdown()
	{
		$rows = DB::select("
			SELECT *
			FROM r_jenis_peraturan
		");
		
		$data = '<option value="" style="display:none;">Pilih Jenis</option>';
		foreach($rows as $row){
			$data.='<option value="'.$row->id.'">'.$row->jenis.'</option>';
		}
		
		echo $data;
	}

	public function file_upload(Request $request)
	{
        try {
            $destinationPath = 'C:\xampp\htdocs\prakomship\data\peraturan\\';
			
			//cek folder
            $listing = file_exists($destinationPath);
			if(!$listing){
				mkdir($destinationPath,0777,true);
			}

			//cek file
			if (!empty($_FILES)) {
				
				$fileName = $_FILES['file']['name'];
				$tempFile = $_FILES['file']['tmp_name'];
				$fileParts = pathinfo($fileName);
				$targetFile = $destinationPath.$fileName;
				$fileTypes = ['pdf','PDF'];
				$fileSize = $_FILES['file']['size'];
				
				// cek type file	
				if (in_array($fileParts['extension'],$fileTypes)) {
					//cek ukuran file
					if($fileSize>0 && $fileSize<=2000000){
						//membuat nama file random berikut extension
						$newFileName = md5(time()).'.'.$fileParts['extension'];
						
						//pindahkan file dari php_temp ke app_temp
						$localUpload = move_uploaded_file($tempFile, $destinationPath.$newFileName);
						if($localUpload){
							session(['upload_lampiran'=>$newFileName]);
							setcookie('upload_lampiran', $newFileName, time() + 3600, "/");
							return '1';
						}
						else{
							return 'File gagal diupload ke local storage.';
						}
					}
					else{
						return 'Ukuran file tidak valid, periksa file Anda.';
					}
				}
				else{
					return 'Tipe file tidak sesuai.';
				}
			}
			else{
				return 'Tidak ada file yang diupload.';
			}
        }
		catch(\Exception $e) {
			return 'Terdapat kesalahan lainnya, hubungi Administrator!';
			//return $e;
		}
	}

	public function store(Request $request)
	{
		$lampiran  = '';
		if(isset($_COOKIE['upload_lampiran']) && $_COOKIE['upload_lampiran']!==''){
			$lampiran = $_COOKIE['upload_lampiran'];
		}

		try {
			if($lampiran!==''){

				$insert=DB::insert('
					INSERT INTO tb_peraturan(
						nomor,
						tahun,
						tentang,
						abstrak,
						jenis_id,
						nama_file,
						status_id,
						user_id,
						aktif)
					VALUES (?, ?, ?, ?, ?, ?, 1, ?, 0)
				',[
					$request->input('nomor'),
					$request->input('tahun'),
					$request->input('tentang'),
					$request->input('abstrak'),
					$request->input('jenis'),
					$lampiran,
					session('id_user')
				]);

				if($insert){
					return 'success';
				}
				else{
					return 'Proses simpan gagal!';
				}
			}
			else{
				return 'Lampiran belum diupload!';
			}
		} catch (\Exception $e) {
			return 'Terjadi kesalahan lainnya. Hubungi Admin!';
			//return $e;
		}
	}

	public function update_verifikator(Request $request)
	{
		try {
			$update = DB::update("
				UPDATE tb_peraturan
				SET status_id='2',
					keterangan=''
				WHERE id=?
			",[
				$request->input('id')
			]);

			if($update){
				return 'success';
			}
			else{
				return 'Data gagal diajukan!';
			}
		} catch (\Exception $e) {
			//return $e;
			return 'Terjadi kesalahan lainnya. Hubungi Admin!';
		}
	}

	public function update_administrator(Request $request)
	{
		try {
			$update = DB::update("
				UPDATE tb_peraturan
				SET status_id='3',
					keterangan=''
				WHERE id=?
			",[
				$request->input('id')
			]);

			if($update){
				return 'success';
			}
			else{
				return 'Data gagal diajukan!';
			}
		} catch (\Exception $e) {
			//return $e;
			return 'Terjadi kesalahan lainnya. Hubungi Admin!';
		}
	}

	public function update_operator_tolak(Request $request)
	{
		try {
			$update = DB::update("
				UPDATE tb_peraturan
				SET status_id='5',
					keterangan=?
				WHERE id=?
			",[
				$request->input('keterangan'),
				$request->input('id')
			]);

			if($update){
				return 'success';
			}
			else{
				return 'Data gagal ditolak!';
			}
		} catch (\Exception $e) {
			//return $e;
			return 'Terjadi kesalahan lainnya. Hubungi Admin!';
		}
	}

	public function update_terbit(Request $request)
	{
		try {
			$update = DB::update("
				UPDATE tb_peraturan
				SET status_id=?,
					aktif=?,
					keterangan=?
				WHERE id=?
			",[
				'4',
				'1',
				'',
				$request->input('id')
			]);

			if($update){
				return 'success';
			}
			else{
				return 'Data gagal diterbitkan!';
			}
		} catch (\Exception $e) {
			//return $e;
			return 'Terjadi kesalahan lainnya. Hubungi Admin!';
		}
	}

	public function update_verifikator_tolak(Request $request)
	{
		try {
			$update = DB::update("
				UPDATE tb_peraturan
				SET status_id='6',
					keterangan=?
				WHERE id=?
			",[
				$request->input('keterangan'),
				$request->input('id')
			]);

			if($update){
				return 'success';
			}
			else{
				return 'Data gagal ditolak!';
			}
		} catch (\Exception $e) {
			//return $e;
			return 'Terjadi kesalahan lainnya. Hubungi Admin!';
		}
	}
}
