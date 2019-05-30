<?php

namespace App\Http\Controllers\Api\Googlmapper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class MapsController extends Controller
{
    public function mapa(){

    	
	}

	public function mapAutoComplete(Request $request){

		$doc = '<div id="map" style="width: 400px; height: 450px;"></div>';

		echo " <script>
     
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},

          /*
          origin: LatLng | String | google.maps.Place,
		  destination: LatLng | String | google.maps.Place,
		  travelMode: TravelMode,
		  transitOptions: TransitOptions,
		  drivingOptions: DrivingOptions,
		  unitSystem: UnitSystem,
		  waypoints[]: DirectionsWaypoint,
		  optimizeWaypoints: Boolean,
		  provideRouteAlternatives: Boolean,
		  avoidFerries: Boolean,
		  avoidHighways: Boolean,
		  avoidTolls: Boolean,
		  region: String
			*/

          zoom: 16
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Você está Aqui!');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>

    <script  src='https://maps.googleapis.com/maps/api/js?key=AIzaSyD_4DuifX8CnPbWbQnH4SSNUlrisXyYGPM&callback=initMap'
    async defer></script>";




		

		$response =  response($doc);

		return $response;


		//return array([
			//'map' => 'maps',
		//]);

        //return view('vendor.googlemaps.map3');

    }
}
