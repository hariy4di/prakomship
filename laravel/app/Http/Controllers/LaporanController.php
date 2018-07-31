<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;



class LaporanController extends Controller
{
    public function pengajuan()
    {
        // $tglawal="";
    	// if(isset($_GET['tgl-awal']) && $_GET['tgl-awal']!==''){
    	// 	$tglawal=" AND date(created_at='".$_GET['tgl-awal']."') ";
        // }

        // $tglakhir="";
    	// if(isset($_GET['tgl-akhir']) && $_GET['tgl-akhir']!==''){
    	// 	$tglakhir=" AND date(created_at='".$_GET['tgl-akhir']."') ";
        // }

        $rows = DB::select("
            SELECT
                nomor,
                tahun,
                r_jenis_peraturan.jenis as jenis,
                tentang,
                date_format(created_at, '%d-%m-%Y')as created_at
            FROM
                tb_peraturan INNER JOIN r_jenis_peraturan on tb_peraturan.jenis_id = r_jenis_peraturan.id
            WHERE
                tb_peraturan.aktif = 1 and tb_peraturan.status_id = 4

        ");
        $rows=collect($rows);

        $datatables = Datatables::of($rows)

            ->make(true);

        return $datatables;
    }

    public function penolakan()
    {
        $rows = DB::select("
        SELECT
            a.nomor,
            a.tahun,
            a.tentang,
            b.jenis,
            date_format(a.created_at, '%d-%m-%Y')as created_at,
            date_format(a.updated_at, '%d-%m-%Y')as updated_at,
            c.nama_status,
            c.keterangan
        FROM
            (tb_peraturan a INNER JOIN r_jenis_peraturan b on a.jenis_id = b.id)
            INNER JOIN r_status c ON a.status_id = c.id
        WHERE
            c.id in (5,6)
        ");
        $rows=collect($rows);

        $datatables = Datatables::of($rows)

            ->make(true);

        return $datatables;
    }


    public function cetakLap()
    {
        $rows = DB::select("
            SELECT
                nomor,
                tahun,
                r_jenis_peraturan.jenis as jenis,
                tentang,
                date_format(created_at, '%d-%m-%Y')as created_at
            FROM
                tb_peraturan INNER JOIN r_jenis_peraturan on tb_peraturan.jenis_id = r_jenis_peraturan.id
            WHERE
                tb_peraturan.aktif = 1 and tb_peraturan.status_id = 4 and YEAR(created_at) = YEAR(CURDATE())
        ");

        $data = '';
        foreach($rows as $row){
            $data.='<tr>
                    <td style="border:1px solid #000">'.$row->nomor.'</td>
                    <td style="border:1px solid #000">'.$row->tahun.'</td>
                    <td style="border:1px solid #000">'.$row->jenis.'</td>
                    <td style="border:1px solid #000">'.$row->tentang.'</td>
                    <td style="border:1px solid #000">'.$row->created_at.'</td><br>
                    </tr>';
        }
        echo $data;

        $form1 =
            '
            <p style="font-size:120%; font-weight:bold; text-align: center;">LAPORAN TAHUNAN PENGAJUAN PERATURAN</p>
            <p style="font-size:85%; font-weight:bold; text-align: center;">
            <br>
            SISTEM HARMONISASI DAN INFORMASI PERATURAN<br>
            DIREKTORAT JENDERAL PERBENDAHARAAN<br>
        </p>

                <table id="tabel-ruh" class="table table-hover" style="border:1px solid #000;border-collapse:collapse; width:100%">
                            <thead>
                            <tr>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Nomor</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Tahun</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Jenis</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Tentang</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Tanggal Pengajuan</th>
                            </tr>
                                <tr>
                                    '.$data.'
                                </tr>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>
			</p>
            ';

            $januari = DB::select("
            SELECT
                count(nomor) as jumlah
            FROM
                tb_peraturan
            WHERE
                month(created_at) = 1
            ");

            $februari = DB::select("
            SELECT
                count(nomor) as jumlah
            FROM
                tb_peraturan
            WHERE
                month(created_at) = 2
            ");

            $maret = DB::select("
            SELECT
                count(nomor) as jumlah
            FROM
                tb_peraturan
            WHERE
                month(created_at) = 3
            ");

            $april = DB::select("
            SELECT
                count(nomor) as jumlah
            FROM
                tb_peraturan
            WHERE
                month(created_at) = 4
            ");

            $mei = DB::select("
            SELECT
                count(nomor) as jumlah
            FROM
                tb_peraturan
            WHERE
                month(created_at) = 5
            ");

            $juni = DB::select("
            SELECT
                count(nomor) as jumlah
            FROM
                tb_peraturan
            WHERE
                month(created_at) = 6 and YEAR(created_at) = YEAR(CURDATE())
            ");

            $juli = DB::select("
            SELECT
                count(nomor) as jumlah
            FROM
                tb_peraturan
            WHERE
                month(created_at) = 7 and YEAR(created_at) = YEAR(CURDATE())
            ");

            $agustus = DB::select("
            SELECT
                count(nomor) as jumlah
            FROM
                tb_peraturan
            WHERE
                month(created_at) = 8 and YEAR(created_at) = YEAR(CURDATE())
            ");

            $september = DB::select("
            SELECT
                count(nomor) as jumlah
            FROM
                tb_peraturan
            WHERE
                month(created_at) = 9 and YEAR(created_at) = YEAR(CURDATE())
            ");

            $oktober = DB::select("
            SELECT
                count(nomor) as jumlah
            FROM
                tb_peraturan
            WHERE
                month(created_at) = 10 and YEAR(created_at) = YEAR(CURDATE())
            ");

            $november = DB::select("
            SELECT
                count(nomor) as jumlah
            FROM
                tb_peraturan
            WHERE
                month(created_at) = 11 and YEAR(created_at) = YEAR(CURDATE())
            ");
            $desember = DB::select("
            SELECT
                count(nomor) as jumlah
            FROM
                tb_peraturan
            WHERE
                month(created_at) = 12 and YEAR(created_at) = YEAR(CURDATE())
            ");
            $form2 =
            '
            <p style="font-size:120%; font-weight:bold; text-align: center;">LAPORAN BULANAN PENGAJUAN PERATURAN</p>
            <p style="font-size:85%; font-weight:bold; text-align: center;">
            <br>
            SISTEM HARMONISASI DAN INFORMASI PERATURAN<br>
            DIREKTORAT JENDERAL PERBENDAHARAAN<br>
        </p>

                <table id="tabel-ruh" class="table table-hover" style="border:1px solid #000;border-collapse:collapse; width:100%">
                            <thead>
                            <tr>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Bulan</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Jumlah Pengajuan</th>

                            </tr>
                            <tr>
                                <td style="border:1px solid #000 ">Januari</td>
                                <td style="border:1px solid #000; text-align: center;">'.$januari[0]->jumlah.'</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000">Feburari</td>
                                <td style="border:1px solid #000; text-align: center;">'.$februari[0]->jumlah.'</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000">Maret</td>
                                <td style="border:1px solid #000; text-align: center;">'.$maret[0]->jumlah.'</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000">April</td>
                                <td style="border:1px solid #000; text-align: center;">'.$april[0]->jumlah.'</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000">Mei</td>
                                <td style="border:1px solid #000; text-align: center;">'.$mei[0]->jumlah.'</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000">Juni</td>
                                <td style="border:1px solid #000; text-align: center;">'.$juni[0]->jumlah.'</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000">Juli</td>
                                <td style="border:1px solid #000; text-align: center;">'.$juli[0]->jumlah.'</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000">Agustus</td>
                                <td style="border:1px solid #000; text-align: center;">'.$agustus[0]->jumlah.'</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000">September</td>
                                <td style="border:1px solid #000; text-align: center;">'.$september[0]->jumlah.'</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000">Oktober</td>
                                <td style="border:1px solid #000; text-align: center;">'.$oktober[0]->jumlah.'</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000">November</td>
                                <td style="border:1px solid #000; text-align: center;">'.$november[0]->jumlah.'</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000">Desember</td>
                                <td style="border:1px solid #000; text-align: center;">'.$desember[0]->jumlah.'</td>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
			</p>
			';

        //render PDF
        require_once 'vendor/autoload.php';

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->SetTitle('Peraturan');
		$mpdf->AddPage('L');
        $mpdf->writeHTML($form1);
        $mpdf->AddPage('L');
		$mpdf->writeHTML($form2);
		$mpdf->Output('Peraturan.pdf','I');
		exit;
    }

    public function cetakLapTolak()
    {
        $rows = DB::select("
        SELECT
            a.nomor,
            a.tahun,
            a.tentang,
            b.jenis,
            date_format(a.created_at, '%d-%m-%Y')as created_at,
            c.nama_status,
            c.keterangan
        FROM
            (tb_peraturan a INNER JOIN r_jenis_peraturan b on a.jenis_id = b.id)
            INNER JOIN r_status c ON a.status_id = c.id
        WHERE
            c.id in (5,6)
        ");



        $data = '';
        foreach($rows as $row){
            $data.='<tr>
                    <td style="border:1px solid #000">'.$row->nomor.'</td>
                    <td style="border:1px solid #000">'.$row->tahun.'</td>
                    <td style="border:1px solid #000">'.$row->tentang.'</td>
                    <td style="border:1px solid #000">'.$row->jenis.'</td>
                    <td style="border:1px solid #000">'.$row->created_at.'</td>
                    <td style="border:1px solid #000">'.$row->nama_status.'</td>
                    <td style="border:1px solid #000">'.$row->keterangan.'</td>
                    </tr>';
        }
        echo $data;

        $form1 =
			'<p style="font-size:120%; font-weight:bold; text-align: center;">LAPORAN PENOLAKAN PENGAJUAN PERATURAN</p>
            <p style="font-size:85%; font-weight:bold; text-align: center;">
            <br>
            SISTEM HARMONISASI DAN INFORMASI PERATURAN<br>
            DIREKTORAT JENDERAL PERBENDAHARAAN<br>
            </p>
                <table id="tabel-ruh" class="table table-hover" style="border:1px solid #000;border-collapse:collapse; width:100%">
                            <thead>
                            <tr>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Nomor</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Tahun</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Tentang</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Jenis</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Tanggal Pengajuan</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Status</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Keterangan</th>
                            </tr>
                                <tr>
                                    '.$data.'
                                </tr>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <table id="tabel-ruh" class="table table-hover" style="border:1px solid #000;border-collapse:collapse; width:100%">
                            <thead>
                            <tr>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Nomor</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Tahun</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Tentang</th>
                            <th style="border:1px solid #000; border-collapse:collapse; text-align:center; padding:4px; width:5%;">Jenis</th>

                            </tr>
                            <tr>
                                    <td>'.$januari[0]->jumlah.'</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>


			</p>
			';

        //render PDF
        require_once 'vendor/autoload.php';

		$mpdf = new \Mpdf\Mpdf();
		$mpdf->SetTitle('Penolakan');
		$mpdf->AddPage('L');
        $mpdf->writeHTML($form1);

		$mpdf->Output('Peraturan.pdf','I');
		exit;
    }

}
