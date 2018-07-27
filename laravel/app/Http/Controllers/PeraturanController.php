<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;

class PeraturanController extends Controller
{
    protected $terbit='4';

    public function index()
    {
    	$jenis="";
    	if(isset($_GET['jenis']) && $_GET['jenis']!==''){
    		$jenis=" AND a.jenis_id='".$_GET['jenis']."' ";
    	}

    	$tahun="";
    	if(isset($_GET['tahun']) && $_GET['tahun']!==''){
    		$tahun=" AND a.tahun='".$_GET['tahun']."' ";
    	}

    	//Status Terbit = 4
    	$rows = DB::select("
			SELECT 	a.id,
					b.jenis,
					a.nomor,
					a.tahun,
					a.tentang,
					a.nama_file,
					a.aktif
			FROM tb_peraturan a
			LEFT OUTER JOIN r_jenis_peraturan b ON(a.jenis_id=b.id)
			WHERE a.status_id='".$this->terbit."' ".$jenis.$tahun."
			ORDER BY a.updated_at DESC
    	");
    	$rows=collect($rows);
    	
        $datatables = Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('aktif', function($row){
            	$aktif="Tidak Aktif";
            	if($row->aktif=='1'){
            		$aktif="Aktif";
            	}
            	return $aktif;
            })
            ->addColumn('action', function($row){
				return view('action-peraturan', [
					'id'=>$row->id,
					'tahun'=>$row->tahun,
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
		
		$data = '
			<option value="" style="display:none;">Pilih Jenis</option>
			<option value="" style="font-weight:bold;">Semua</option>
		';
		foreach($rows as $row){
			$data.='<option value="'.$row->id.'">'.$row->jenis.'</option>';
		}
		
		echo $data;
	}

	public function tahun_dropdown()
	{
		$rows = DB::select("
			SELECT DISTINCT(tahun) AS tahun
			FROM tb_peraturan
			ORDER BY 1
		");
		
		$data = '
			<option value="" style="display:none;">Pilih Tahun</option>
			<option value="" style="font-weight:bold;">Semua</option>
		';
		foreach($rows as $row){
			$data.='<option value="'.$row->tahun.'">'.$row->tahun.'</option>';
		}
		
		echo $data;
	}

	public function edit($id)
	{
		$rows = DB::select("
			SELECT *
			FROM tb_peraturan
			WHERE id=?
		",[
			$id
		]);

		if(isset($rows[0]) && count($rows)>0){
            return json_encode($rows[0]);
        }
	}

	public function update(Request $request)
	{
		try {
			$update = DB::update("
				UPDATE tb_peraturan
				SET jenis_id=?,
					nomor=?,
					tahun=?,
					tentang=?,
					abstrak=?
				WHERE id=?
			",[
				$request->input('jenis'),
				$request->input('nomor'),
				$request->input('tahun'),
				$request->input('tentang'),
				$request->input('abstrak'),
				$request->input('inp-id')
			]);

			if($update){
				return 'success';
			}
			else{
				return 'Data gagal diubah!';
			}
		} catch (\Exception $e) {
			//return $e;
			return 'Terjadi kesalahan lainnya. Hubungi Admin!';
		}
	}
}
