<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    protected $administrator='00';
    protected $operator 	='01';
    protected $verifikator 	='02';

    public function pengajuan()
    {
    	$status="";
    	if(session('kdlevel')==$this->administrator){ //administrator
    		$status = " WHERE status_id='3' ";
    	}
    	elseif(session('kdlevel')==$this->operator){ //operator
    		$status = " WHERE user_id='".session('id_user')."' AND status_id='1' ";
    	}
    	elseif(session('kdlevel')==$this->verifikator){ //verifikator
    		$status = " WHERE status_id in('2') ";
    	}

    	$rows = DB::select("
			SELECT 	COUNt(id) AS jml
			FROM tb_peraturan
			".$status."
    	");

    	return $rows[0]->jml;
    }

    public function penolakan()
    {
    	$status="";
        if(session('kdlevel')==$this->administrator){ //administrator
            $status = " WHERE status_id in('5','6') ";
        }
    	elseif(session('kdlevel')==$this->operator){ //operator
    		$status = " WHERE user_id='".session('id_user')."' AND status_id='5' ";
    	}
    	elseif(session('kdlevel')==$this->verifikator){ //verifikator
    		$status = " WHERE status_id='6' ";
    	}

    	$rows = DB::select("
			SELECT 	COUNt(id) AS jml
			FROM tb_peraturan
			".$status."
    	");

    	return $rows[0]->jml;
    }

    public function peraturan()
    {
    	$rows = DB::select("
			SELECT 	COUNt(id) AS jml
			FROM tb_peraturan
			WHERE status_id='4' AND aktif='1'
    	");

    	return $rows[0]->jml;
    }

    public function user()
    {
    	$rows = DB::select("
			SELECT 	COUNt(id) AS jml
			FROM tb_user
			WHERE aktif='1'
    	");

    	return $rows[0]->jml;
    }

    public function bar_chart()
    {
        $row_bulan = DB::select("
            SELECT DISTINCT(MONTH(updated_at)) AS bulan FROM tb_peraturan
        ");
        $arr_bulan  = (array)$row_bulan;
        $arr_key    = array_keys($arr_bulan);

        $query_union="";
        for ($i=1; $i < count($arr_key); $i++) { 
            $query_union .= "
                UNION ALL

                SELECT  MONTH(updated_at) as bulan,
                        (   SELECT count(status_id)
                            FROM tb_peraturan
                            WHERE status_id = 4 and MONTH(updated_at) = ".$arr_bulan[$arr_key[$i]]->bulan."
                        ) AS jml_terbit,
                        (   SELECT count(status_id)
                            FROM tb_peraturan
                            WHERE status_id <> 4 and MONTH(updated_at) = ".$arr_bulan[$arr_key[$i]]->bulan."
                        ) AS jml_pengajuan
                FROM tb_peraturan
                WHERE month(updated_at) = ".$arr_bulan[$arr_key[$i]]->bulan."
            ";
        }

        $rows = DB::select("
            SELECT  DISTINCT(bulan) AS bulan,
                    jml_pengajuan,
                    jml_terbit
            FROM(
                SELECT  month(updated_at) AS bulan,
                        (SELECT count(status_id)
                            FROM tb_peraturan
                            WHERE status_id = 4 AND month(updated_at) = ".$arr_bulan[$arr_key[0]]->bulan."
                        ) AS jml_terbit,
                        (SELECT count(status_id)
                            FROM tb_peraturan
                            WHERE status_id <> 4 AND month(updated_at) = ".$arr_bulan[$arr_key[0]]->bulan."
                        ) AS jml_pengajuan
                FROM tb_peraturan
                WHERE month(updated_at) = ".$arr_bulan[$arr_key[0]]->bulan."
                
                ".$query_union."
            ) z
            ORDER by z.bulan
        ");

        return json_encode($rows);
    }

    public function donut_chart()
    {
        $rows = DB::select("
            SELECT b.singkatan as label,count(a.id) AS value
            FROM tb_peraturan a
            LEFT OUTER JOIN r_jenis_peraturan b on(a.jenis_id=b.id)
            WHERE a.jenis_id='5' and a.status_id='4'
            GROUP BY label

            UNION ALL

            SELECT b.singkatan as label,count(a.id) AS value
            FROM tb_peraturan a
            LEFT OUTER JOIN r_jenis_peraturan b on(a.jenis_id=b.id)
            WHERE a.jenis_id='7' and a.status_id='4'
            GROUP BY label

            UNION ALL

            SELECT REPLACE(b.singkatan, 'UU', 'Lainnya') AS label,a.value
            FROM(
                SELECT min(jenis_id) as id_jenis,count(id) AS value
                FROM tb_peraturan
                WHERE jenis_id not IN(5,7) and status_id='4'
            ) a
            LEFT OUTER JOIN r_jenis_peraturan b on(a.id_jenis=b.id)
        ");

        return json_encode($rows);
    }
}
