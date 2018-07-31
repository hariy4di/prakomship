<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Share;

class GuestController extends Controller
{
    public function index()
    {
    	$facebook = Share::load(url('/'), 'Prakomship')->facebook();
    	$twitter = Share::load(url('/'), 'Prakomship')->twitter();

    	return view('welcome', [
    		'facebook'=>$facebook,
    		'twitter'=>$twitter
    	]);
    }
}
