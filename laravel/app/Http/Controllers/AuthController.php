<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class AuthController extends Controller
{
    public function index()
    {
    	if(!session('authenticated')){
    		return view('login');
    	}
    	else{
    		return redirect('/app');
    	}
    }

    public function login(Request $request)
    {
    	try{
			$username = $request->input('username');
			$password = $request->input('password');
			
			if($username!='' && $password!=''){
				
				$rows = DB::select("
					SELECT	a.id,
							a.username,
							a.password,
							a.nama,
							a.nip,
							a.email,
							a.foto,
							a.aktif,
							a.kd_level,
							b.nama_level,
							a.instansi_id,
							c.nama_instansi
					FROM tb_user a
					LEFT OUTER JOIN r_level b ON(a.kd_level=b.kd_level)
					LEFT OUTER JOIN r_instansi c ON(a.instansi_id=c.id)
					WHERE a.username=?
				",[
					$username
				]);
				
				if(isset($rows[0]) && $rows[0]->password){
				
					if($rows[0]->password==md5($password)){
					
						if($rows[0]->aktif=='1'){
						
							session([
								'authenticated' => true,
								'id_user' => $rows[0]->id,
								'username' => $username,
								'nama' => $rows[0]->nama,
								'nip' => $rows[0]->nip,
								'email' => $rows[0]->email,
								'kdlevel' => $rows[0]->kd_level,
								'nmlevel' => $rows[0]->nama_level,
								'instansi_id' => $rows[0]->instansi_id,
								'nm_instansi' => $rows[0]->nama_instansi,
								'foto' => $rows[0]->foto,
							]);

							return response()->json(['error' => false,'message' => 'Login berhasil!</br>Selamat Datang']);
						}
						else{
							return response()->json(['error' => true,'message' => 'User tidak aktif!']);
						}
					}
					else{
						return response()->json(['error' => true,'message' => 'Password salah!']);
					}
				}
				else{
					return response()->json(['error' => true,'message' => 'Username tidak terdaftar!']);
				}
			}
			else{
				return response()->json(['error' => true,'message' => 'Parameter tidak valid!']);
			}
		}
		catch(\Exception $e){
			//return $e;
			return response()->json(['error' => true,'message' => 'Terdapat kesalahan lainnya!'], 503);
		}
    }

    public function logout()
	{
		Session::flush();
		return redirect()->guest('/');
	}
}
