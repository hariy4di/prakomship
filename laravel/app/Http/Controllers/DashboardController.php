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

    public function pengajuan_bar()
    {
        $rows = DB::select("
            
        ");

        return json_encode($rows);
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
}
