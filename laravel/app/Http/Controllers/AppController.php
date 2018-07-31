<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AppController extends Controller
{
    public function index()
    {
    	$menus = DB::select("
			SELECT a.*
			FROM d_menu a
			LEFT OUTER JOIN d_menu_level b ON(a.id=b.menu_id)
			WHERE a.aktif = '1'
			  AND a.parent_id = 0
			  AND b.kd_level = ?
			ORDER BY a.no_urut
		",[
			session('kdlevel')
		]);

		$html_out='';

		$angular = '
			var app = angular.module("spa", ["ui.router","chieffancypants.loadingBar"]);
			app.config(function($stateProvider, $urlRouterProvider){
				$urlRouterProvider.otherwise("/");
				$stateProvider
				.state("app", {
					url: "/app",
					templateUrl: "partials/home.html",
					controller: function($scope){
						$scope.items = ["A", "List", "Of", "Items"];
					}
				})
				.state("/", {
					url: "/",
					templateUrl: "partials/dashboard.html"
				})
		';

		foreach($menus as $menu) {

			//jika is_parent == 0, tidak perlu buat sub menu
			if($menu->is_parent=='0'){

				if($menu->url == ''){
					$html_out .= '<li>
									<a ui-sref="/">
										<i class="'.$menu->icon.'"></i> <span>'.$menu->title.'</span>
									</a>
								</li>';
					$angular .= '.state("/", {
									url: "/",
									templateUrl: "partials/'.$menu->nama_file.'"
								})';
				}
				else{
					$html_out .= '<li>
									<a ui-sref="'.$menu->url.'">
										<i class="'.$menu->icon.'"></i> '.$menu->title.'
									</a>
								</li>';
					$angular .= '.state("'.$menu->url.'", {
									url: "/'.$menu->url.'",
									templateUrl: "partials/'.$menu->nama_file.'"
								})';
				}
			}

			//jika is_parent != 0, perlu buat sub menu dengan parameter parent_id ybs
			else{
				$html_out .= '<li class="treeview">
								<a href="#" >
									<i class="'.$menu->icon.'"></i>
									<span>'.$menu->title.'</span>
									<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
								</a>
								<ul class="treeview-menu">';

				$sub_menus = DB::select("
					SELECT a.*
					FROM d_menu a
					LEFT OUTER JOIN d_menu_level b ON(a.id=b.menu_id)
					WHERE a.aktif = '1'
					  AND a.parent_id = ?
					  AND b.kd_level = ?
					ORDER BY a.no_urut
				",[
					$menu->id, session('kdlevel')
				]);

				//bentuk sub menu
				foreach($sub_menus as $sub_menu){

					if($sub_menu->is_parent == '0' && $sub_menu->new_tab == '0'){
						$html_out .= '<li>
										<a ui-sref="'.$sub_menu->url.'">
											<i class="'.$sub_menu->icon.'"></i> '.$sub_menu->title.'
										</a>
									</li>';
						$angular .= '.state("'.$sub_menu->url.'", {
										url: "/'.$sub_menu->url.'",
										templateUrl: "partials/'.$sub_menu->nama_file.'"
									})';
					}
					else{
						$html_out .= '<li>
										<a href="'.$sub_menu->url.'" target="_blank">
											<i class="'.$sub_menu->icon.'"></i> '.$sub_menu->title.'
										</a>
									</li>';
					}
				}

				$html_out .= '	</ul>
							</li>';
			}
		}

		$angular .= '});';

		return view('app',
			[
				'menu' => $html_out,
				'angular' => $angular,
				'info_username' => session('username'),
				'info_nama' => session('nama'),
				'info_nip' => session('nip'),
				'info_instansi' => session('nm_instansi'),
				'info_nmlevel' => session('nmlevel'),
				'info_foto' => session('foto'),
				'info_email' => session('email'),
			]
		);
    }

    public function token()
	{
		return csrf_token();
	}

	public function cek_level()
	{
		return session('kdlevel');
	}

	public function attach_destroy(Request $request)
	{
		session(['upload_lampiran' => null]);
		setcookie('upload_lampiran', '', time() + 3600, "/");

		return 'Sesi upload berhasil dihapus!';
	}
}
