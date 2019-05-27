<?php

namespace App\Http\Controllers\Api\Googlmapper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Mapper;

class MapsController extends Controller
{
    public function index(){

    	Mapper::map(53.381128999999990000, -1.470085000000040000);

    	return view('map');
	}
}
