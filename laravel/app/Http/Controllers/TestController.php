<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
//use mPDF as mPDF;

class TestController extends Controller
{
    public function index()
    {
    	$rows = DB::select("
			SELECT *
			FROM tb_peraturan
    	");

    	if(count($rows)>0){
    		$html_out = '
				<table>
					<thead>
						<tr>
							<th>Nomor Peraturan</th>
							<th>Tahun</th>
							<th>Tentang</th>
						</tr>
					</thead>
					<tbody>';
					
			foreach($rows as $row){
				$html_out .= '
					<tr>
						<td>'.$row->nomor.'</td>
						<td>'.$row->tahun.'</td>
						<td>'.$row->tentang.'</td>
					</tr>
				';
			}

			$html_out .= '
					</tbody>
				</table>
	    	';
    	}
    	else{
    		$html_out = '';
    	}

    	require_once 'vendor/autoload.php';

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->SetTitle('Peraturan');
		$mpdf->AddPage('L');
		$mpdf->writeHTML($html_out);
		$mpdf->Output('Peraturan.pdf','I');
    }
}
