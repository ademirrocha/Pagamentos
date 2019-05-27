<?php

namespace App\Http\Controllers\Local\Googlmapper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class MapsController extends Controller
{
    public function index(){
    

    $response = \GoogleMaps::load('geocoding')
                ->setParamByKey('latlng', '40.714224,-73.961452') 
                 ->get('results.formatted_address');

        var_dump($response);
    	
    	//return view('vendor.googlemaps.map', compact('response'));
	}
}
