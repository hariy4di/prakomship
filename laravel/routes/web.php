<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'GuestController@index');
Route::get('/search', 'SearchController@index');
Route::get('/search-result/{id}', 'SearchController@getResult');

// Authentication Routes...
Route::get('login', 'AuthController@index');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

Route::get('survei', 'SurveiController@index');
Route::get('survei/usiaDropDown', 'SurveiController@dropdown_usia');


Route::middleware(['auth'])->group(function () {
Route::prefix('app')->group(function () {

	Route::get('/', 'AppController@index');
	Route::get('token', 'AppController@token');
	Route::get('cek-level', 'AppController@cek_level');
	Route::get('attach-destroy', 'AppController@attach_destroy');

	//Dashboard
	Route::prefix('dashboard')->group(function () {
		
		Route::get('pengajuan', 'DashboardController@pengajuan');
		Route::get('pengajuan-bar', 'DashboardController@pengajuan_bar');
		Route::get('penolakan', 'DashboardController@penolakan');
		Route::get('peraturan', 'DashboardController@peraturan');
		Route::get('user', 'DashboardController@user');

	});

	
	//Daftar Pengajuan
	Route::get('pengajuan', 'PengajuanController@index');
	Route::get('pengajuan/jenis-dropdown', 'PengajuanController@jenis_dropdown');
	Route::post('pengajuan/file-upload', 'PengajuanController@file_upload');
	Route::post('pengajuan', 'PengajuanController@store');
	Route::put('pengajuan', 'PengajuanController@update');
	Route::delete('pengajuan', 'PengajuanController@destroy');

	Route::put('pengajuan/verifikator', 'PengajuanController@update_verifikator');
	Route::put('pengajuan/administrator', 'PengajuanController@update_administrator');
	Route::put('pengajuan/operator-tolak', 'PengajuanController@update_operator_tolak');
	Route::put('pengajuan/terbit', 'PengajuanController@update_terbit');
	Route::put('pengajuan/verifikator-tolak', 'PengajuanController@update_verifikator_tolak');

	
	//Monitoring Pengajuan
	Route::get('pengajuan/monitoring', 'PengajuanMonitoringController@index');
	Route::get('pengajuan/monitoring/status-dropdown', 'PengajuanMonitoringController@status_dropdown');

	
	//Peraturan
	Route::get('peraturan', 'PeraturanController@index');
	Route::get('jnsPeraturan-dropdown', 'PeraturanController@jenis_dropdown');
	Route::get('thnPeraturan-dropdown', 'PeraturanController@tahun_dropdown');
	Route::get('peraturan/{id}', 'PeraturanController@edit');
	Route::put('peraturan', 'PeraturanController@update');

	
	//Label
	Route::get('label', 'RefLabelController@index');
	Route::post('label', 'RefLabelController@store');
	Route::get('label/{id}', 'RefLabelController@edit');
	Route::put('label', 'RefLabelController@update');
	Route::delete('label', 'RefLabelController@destroy');

	
	//Instansi
	Route::get('instansi', 'RefInstansiController@index');
	Route::post('instansi', 'RefInstansiController@store');
	Route::get('instansi/{id}', 'RefInstansiController@edit');
	Route::put('instansi', 'RefInstansiController@update');
	Route::delete('instansi', 'RefInstansiController@destroy');

    
    //Jenis Peraturan
    Route::get('jnsPeraturan', 'RefJnsPeraturanController@index');
    Route::post('jnsPeraturan', 'RefJnsPeraturanController@store');
    Route::get('jnsPeraturan/{id}', 'RefJnsPeraturanController@edit');
    Route::put('jnsPeraturan', 'RefJnsPeraturanController@update');
	Route::delete('jnsPeraturan', 'RefInstansiController@destroy');
	

	//Pertanyaan Survei
    Route::get('surveiTanya', 'RefSurveiTanyaController@index');
    Route::post('surveiTanya', 'RefSurveiTanyaController@store');
    Route::get('surveiTanya/{id}', 'RefSurveiTanyaController@edit');
    Route::put('surveiTanya', 'RefSurveiTanyaController@update');
	Route::delete('surveiTanya', 'RefSurveiTanyaController@destroy');
	

	//Jawaban Survei
    Route::get('surveiJawab', 'RefSurveiJawabController@index');
    Route::post('surveiJawab', 'RefSurveiJawabController@store');
    Route::get('surveiJawab/{id}', 'RefSurveiJawabController@edit');
    Route::put('surveiJawab', 'RefSurveiJawabController@update');
    Route::delete('surveiJawab', 'RefSurveiJawabController@destroy');

});
});
