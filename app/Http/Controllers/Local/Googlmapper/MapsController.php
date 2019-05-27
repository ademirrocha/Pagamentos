<?php

namespace App\Http\Controllers\Local\Googlmapper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MapsController extends Controller
{
    public function index(){
    
    
    	
    	return view('vendor.googlemaps.map');
	}
}
