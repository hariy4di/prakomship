<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;

class RefInstansiController extends Controller
{
    public function index()
    {
        $rows = DB::select(
               "SELECT id, nama_instansi, kota
                FROM r_instansi"
                );
        $rows = collect($rows);

        $datatables = Datatables::of($rows)
            ->addcolumn('action', function($row) {
                return view('action', ['id'=>$row->id]);  
            })
            ->make(true);
        return $datatables;
    }

    public function store(Request $request)
    {
        try {
            $insert = DB::insert(
                "INSERT INTO r_instansi(nama_instansi, kota, aktif)
                 VALUES(?,?,'1')", [$request -> input('nama_instansi'),
                                    $request -> input('kota')]
            );

            if($insert) {
                return 'success';
            } else {
              return 'Data Gagal Disimpan!';
            }
        } catch(\Exception $e) {
            // return $e;
            return 'Terdapat kesalahan lainnya. Hubungi Admin!';
        }
    }

    public function edit($id)
    {
        $rows = DB::select("SELECT * FROM r_instansi WHERE id=?", [$id]);

        if(isset($rows[0]) && count($rows) > 0) {
            return json_encode($rows[0]);
        }
    }

    public function update(Request $request)
    {
        try {
            $update = DB::update(
                "UPDATE r_instansi
                 SET nama_instansi = ?, kota = ?
                 WHERE id = ?",
                 [$request->input('nama_instansi'),
                  $request->input('kota'),
                  $request->input('inp-id')
                 ]
            );

            if($update) {
                return 'success';
            } else {
                return 'Data gagal diubah!';
            }
        } catch(\Exception $e) {
            // return $e;
            return 'Terdapat kesalahan lainnya. Hubungi Admin!';
        }
    }

    public function destroy(Request $request) 
    {
        try {
            $delete = DB::delete("DELETE FROM r_instansi WHERE id = ?", [$request -> input('id')]);

            if($delete) {
                return 'success';
            } else {
                return 'Data Gagal Dihapus!';
            }
        } catch(\Exception $e) {
            // return $e;
           return 'Terdapat kesalahan lainnya. Hubungi Admin!';
        }
    }
}
