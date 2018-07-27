<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;

class RefLabelController extends Controller
{
    public function index()
    {
    	$rows = DB::select("
			SELECT id,nama_label
			FROM r_label
    	");
    	$rows=collect($rows);
    	
        $datatables = Datatables::of($rows)
            ->addColumn('action', function($row){
				return view('action', [
                    'id'=>$row->id
                ]);
			})
    		->make(true);

    	return $datatables;
    }

    public function store(Request $request)
    {
    	try {
            $insert = DB::insert("
                INSERT INTO r_label(nama_label)
                VALUES(?)
            ", [
                $request->input('nama_label')
            ]);

            if($insert){
                return 'success';
            }
            else{
                return 'Data gagal disimpan!';
            }
        } catch (\Exception $e) {
            //return $e;
            return 'Terdapat kesalahan lainnya. Hubungi Admin!';
        }
    }

    public function edit($id)
    {
        $rows=DB::select("SELECT * FROM r_label WHERE id=?", [$id]);

        if(isset($rows[0]) && count($rows)>0){
            return json_encode($rows[0]);
        }
    }

    public function update(Request $request)
    {
        try {
            $update = DB::update("
                UPDATE r_label
                SET nama_label=?
                WHERE id=?
            ",[
                $request->input('nama_label'),
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
            return 'Terdapat kesalahan lainnya. Hubungi Admin!';
        }
    }

    public function destroy(Request $request)
    {
        try {
            $delete=DB::delete("DELETE FROM r_label WHERE id=?", [$request->input('id')]);

            if($delete){
                return 'success';
            }
            else{
                return 'Data gagal dihapus!';
            }
        } catch (\Exception $e) {
            //return $e;
            return 'Terdapat kesalahan lainnya. Hubungi Admin!';
        }
    }
}
