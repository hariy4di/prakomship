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

        dd($arr_bulan);

        $union = "
            UNION ALL

            SELECT(updated_at) as bulan,
                    (select count(status_id)
                    from tb_peraturan
                    where status_id = 4
                    and month(updated_at) = 8) as status_terbit,
                    (select count(status_id)
                    from tb_peraturan
                    where status_id <> 4
                    and month(updated_at) = 8) as status_pengajuan
            from tb_peraturan
            where month(updated_at) = 8
        ";

        if(count())

        $rows = DB::select("
            SELECT  DISTINCT(bulan),
                    status_pengajuan,
                    status_terbit
            FROM(
                SELECT  month(updated_at) AS bulan,
                        (SELECT count(status_id)
                            FROM tb_peraturan
                            WHERE status_id = 4 AND month(updated_at) = 7) AS status_terbit,
                        (select count(status_id)
                        from tb_peraturan
                        where status_id <> 4
                        and month(updated_at) = 7) as status_pengajuan
                FROM tb_peraturan
                WHERE month(updated_at) = 7

                UNION ALL

                select month(updated_at) as bulan,
                        (select count(status_id)
                        from tb_peraturan
                        where status_id = 4
                        and month(updated_at) = 8) as status_terbit,
                        (select count(status_id)
                        from tb_peraturan
                        where status_id <> 4
                        and month(updated_at) = 8) as status_pengajuan
                from tb_peraturan
                where month(updated_at) = 8
            ) z
        ");
    }
}
