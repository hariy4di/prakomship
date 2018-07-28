<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SurveiController extends Controller
{
    public function index()
    {
        $rowsTanya = DB::select(
            "SELECT id, deskripsi, jenis
			 FROM r_survei_tanya
    	    ");
        
        $rowsJawab = DB::select(
            "SELECT id, deskripsi
			 FROM r_survei_jawab
            ");
            
        return view('survei', [
            'rowsTanya' => $rowsTanya
        ]);
    }

    public function dropdown_usia()
	{
		$rows = DB::select(
            "SELECT *
             FROM r_survei_jawab
             WHERE id > 5");
		
		$data = '<option value="" style="display:none;">Range Usia</option>';
		foreach($rows as $row){
			$data.='<option value="'.$row->id.'">'.$row->deskripsi.'</option>';
		}
		echo $data;
	}

    public function dropdown_skala()
	{
		$data = '<option value="" style="display:none;">Skala</option>';
		for ($i = 1; $i <= 10; $i++) {
			$data.='<option value="'.$i.'">'.$i.'</option>';
		}
		echo $data;
    }
    
    public function dropdown_ref_jawab()
	{
		$rows = DB::select(
            "SELECT *
             FROM r_survei_jawab
             WHERE id <= 5");
		
		$data = '<option value="" style="display:none;">Ref Jawab</option>';
		foreach($rows as $row){
			$data.='<option value="'.$row->id.'">'.$row->deskripsi.'</option>';
		}
		echo $data;
	}

	public function store(Request $request)
	{   
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $ipCheck = DB::select("SELECT id FROM tb_ip_client WHERE ip_address = '".$ipAddress."'");

        $row = a;
		

		try {
			if($lampiran!==''){

				$insert=DB::insert(
                    'INSERT INTO tb_survei(
						nomor,
						tahun,
						tentang,
						abstrak,
						jenis_id,
						nama_file,
						status_id,
						user_id,
						aktif)
                    VALUES (?, ?, ?, ?, ?, ?, 1, ?, 0)',
                    [$request->input('nomor'),
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
