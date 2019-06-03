<?php

namespace App\Http\Controllers\Local\Googlmapper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MapsController extends Controller
{
    public function mapa(){

    	return view('vendor.googlemaps.map');

	}


    public function mapAutoComplete(){

        return view('vendor.googlemaps.map3');

    }

    public function mapRotas(){
    	 return view('vendor.googlemaps.rotas_maps');
    }



}
