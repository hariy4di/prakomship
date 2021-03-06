<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Share;

class SearchController extends Controller
{
    public function index(Request $request)
	{
		/*
		|--------------------------------------------------------------------------
		| GET KATA KUNCI - INPUT DARI USER
		|--------------------------------------------------------------------------
		*/
		//Kata Kunci
		$q = $request->get('q');
		$search = htmlspecialchars($q);

		/*
		|--------------------------------------------------------------------------
		| DINAMIC QUERY KATA KUNCI - DINAMIC QUERY KATEGORI
		|--------------------------------------------------------------------------
		*/
		// Kata Kunci
		$search_exploded = explode(" ", $search);
		$firsttime=true;
		$construct="";
		foreach ($search_exploded as $search_each) {
			if($firsttime){
				$construct .= "WHERE";
				$firsttime  = false;
			}
			else{
				$construct .= "AND";
			}
			$construct .= " (
				UPPER(nomor) LIKE UPPER('%".$search_each."%') OR
				UPPER(tahun) LIKE UPPER('%".$search_each."%') OR
				UPPER(tentang) LIKE UPPER('%".$search_each."%') OR
				UPPER(abstrak) LIKE UPPER('%".$search_each."%')
			) ";
		}
		
		/*
		|--------------------------------------------------------------------------
		| TAMPILKAN PERATURAN DENGAN STATUS_ID = 4 (TERBIT)
		|--------------------------------------------------------------------------
		*/
		$rows = DB::select("
			SELECT 	id,
					nomor,
					tahun,
					tentang,
					abstrak,
					nama_file,
					date_format(updated_at, '%d-%m-%Y') as updated_at
			FROM tb_peraturan
			".$construct." AND status_id='4' AND aktif='1'
			ORDER BY jenis_id
		");

		$jml=count($rows);

		$new_peraturan = DB::select("
			SELECT 	id,
					nomor,
					tentang,
					nama_file,
					date_format(updated_at, '%d %M %Y') AS tgl_update
			FROM tb_peraturan
			WHERE status_id='4' AND aktif='1'
			ORDER BY updated_at DESC
			LIMIT 5
		");
		
		return view('search', compact('rows','jml','new_peraturan'));
	}

	public function getResult($id)
	{
		$row = DB::select("
			SELECT 	a.id,
					a.nomor,
					a.tahun,
					a.tentang,
					a.abstrak,
					b.jenis,
					a.nama_file,
					date_format(a.updated_at, '%d-%m-%Y') AS updated_at
			FROM tb_peraturan a
			LEFT OUTER JOIN r_jenis_peraturan b ON(a.jenis_id=b.id)
			WHERE a.id=? AND a.status_id='4' AND a.aktif='1'
		",[
			$id
		]);

		$new_peraturan = DB::select("
			SELECT 	id,
					nomor,
					tentang,
					nama_file,
					date_format(updated_at, '%d %M %Y') as tgl_update
			FROM tb_peraturan
			WHERE status_id='4' AND aktif='1'
			ORDER BY updated_at DESC
			LIMIT 5
		");

		$facebook = Share::load(url('/search-result/'.$id), $row[0]->nomor.' tentang '.$row[0]->tentang)->facebook();
    	$twitter = Share::load(url('/search-result/'.$id), $row[0]->nomor.' tentang '.$row[0]->tentang)->twitter();
    	//$gplus = Share::load(url('/search-result/'.$id), $row[0]->nomor.' tentang '.$row[0]->tentang)->gplus();

		return view('search-result', compact('row','new_peraturan','facebook','twitter'));
	}
}
