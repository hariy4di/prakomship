<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;

class PengajuanMonitoringController extends Controller
{
    public function index()
    {
    	$status=" WHERE a.status_id NOT IN('4') ";
    	if(isset($_GET['status']) && $_GET['status']!==''){
    		$status=" WHERE a.status_id='".$_GET['status']."' ";
    	}

    	$rows = DB::select("
			SELECT 	a.id,
					b.jenis,
					a.nomor,
					a.tahun,
					a.tentang,
					a.nama_file,
					a.status_id,
					c.nama_status,
					d.kd_level,
					ifnull(a.keterangan,'-') AS keterangan,
					a.created_at,
					a.updated_at
			FROM tb_peraturan a
			LEFT OUTER JOIN r_jenis_peraturan b ON(a.jenis_id=b.id)
			LEFT OUTER JOIN r_status c ON(a.status_id=c.id)
			LEFT OUTER JOIN tb_user d ON(a.user_id=d.id)
			".$status."
			ORDER BY a.status_id
    	");
    	$rows=collect($rows);
    	
        $datatables = Datatables::of($rows)
            ->addIndexColumn()
    		->make(true);

    	return $datatables;
    }

    public function status_dropdown()
	{
		$rows = DB::select("
			SELECT *
			FROM r_status
			WHERE id NOT IN('4')
			ORDER BY 1
		");
		
		$data = '
			<option value="" style="display:none;">Pilih Status</option>
			<option value="" style="font-weight:bold;">Semua</option>
		';
		foreach($rows as $row){
			$data.='<option value="'.$row->id.'">'.$row->nama_status.'</option>';
		}
		
		echo $data;
	}
}
