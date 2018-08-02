<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SurveiController extends Controller
{
	public $rowsTanya;
	public $rowsJawab;

	public function index()
    {
		$this->rowsTanya = DB::select(
			"SELECT id, deskripsi, jenis
			 FROM r_survei_tanya"
			 );
		
        $this->rowsJawab = DB::select(
            "SELECT id, deskripsi
			 FROM r_survei_jawab"
             );
            
        return view('survei', [
			'rowsTanya' => $this->rowsTanya,
			'rowsJawab' => $this->rowsJawab
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

		$data = "";
		foreach($rows as $row){
			$data.='<div class="radio">
						<label class="radio">
							<input type="radio" value='.$row->id.' name="jawaban" id="radio-'.$row->id.'">
							'.$row->deskripsi.'
						</label>
					</div>';
		}
		echo $data;
	}

	public function store(Request $request)
	{   

		$ipAddress = $_SERVER['REMOTE_ADDR'];
		$ipCheck = DB::select("SELECT id FROM tb_ip_client WHERE ip_address = '".$ipAddress."'");

		if(count($ipCheck) > 0) {
			return "Gagal rekam. Anda sudah pernah melakukan survei";
		} else {
			try {
				DB::beginTransaction();
				$ip_id = DB::table('tb_ip_client')->insertGetId([
						'ip_address'=>$ipAddress
						]);		
				for($i=1; $i<=20; $i++) {
					DB::insert(
						"INSERT INTO tb_survei(ip_id, pertanyaan, jawaban)
						 VALUES(?,?,?)
						",[
						$ip_id, $i, $_POST[$i]
						]);
				}
				DB::commit();
				return "Anda Berhasil Melakukan Survei";

			} catch(\Exception $e) {
				return $e;
				//return 'Terjadi kesalahan lainnya. Hubungi Admin!';
			}
		}
	}

}
