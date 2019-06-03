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




  public function mapRotas(Request $request){

    $doc = '

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <style>


      #right-panel {
        font-family: "Roboto","sans-serif";
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        float: left;
        width: 63%;
        height: 100%;
      }
      #right-panel {
        float: right;
        width: 34%;
        height: 100%;
      }
      .panel {
        height: 100%;
        overflow: auto;
      }


      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
        
      }
      
      .controls {
        margin-top: 10px;
        margin-bottom: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
       
      }

      #origin-input,
      #destination-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        width: 40%;
      }

      #origin-input:focus,
      #destination-input:focus {
        border-color: #4d90fe;
      }

      #mode-selector {
        color: #fff;
        background-color: #4d90fe;
        margin-left: 12px;
        padding: 5px 11px 0px 11px;
        margin-top: 0px;
      }

      #mode-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

    </style>
  
    <div style="display: none; float: auto;">
      
        <input id="origin-input" class="controls" type="text"
            placeholder="Origem">
            
        <input id="destination-input" class="controls" type="text"
            placeholder="Destino">
           <br>
        <div id="mode-selector" class="controls">
        <label for="changemode-walking" title="A pé">
          <input type="radio" name="type" id="changemode-walking">
          <i class="fas fa-walking"></i></label>
          <label for="changemode-transit" title="Trânsito">
          <input type="radio" name="type" id="changemode-transit">
          <i class="fas fa-road"></i></label>
          <label for="changemode-driving" title="Dirigindo">
          <input type="radio" name="type" id="changemode-driving" checked="checked" >
          <i class="fas fa-car"></i></label>
        </div>

    </div>

    <div id="map"></div>

    <div id="right-panel">
      <p>Total Distance: <span id="total"></span></p>
    </div>

    ';


    $doc = $doc ."

    <script>
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script
//src='https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places'>

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    mapTypeControl: false,
    center: {lat: -33.8688, lng: 151.2195},

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



 

  new AutocompleteDirectionsHandler(map);
}

/**
 * @constructor
 */
function AutocompleteDirectionsHandler(map) {
  this.map = map;
  this.originPlaceId = null;
  this.destinationPlaceId = null;
  this.travelMode = 'WALKING';
  this.directionsService = new google.maps.DirectionsService;
  this.directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: true,
          map: map,
          panel: document.getElementById('right-panel')
        });
  this.directionsDisplay.setMap(map);

  this.directionsDisplay.addListener('directions_changed', function() {
          computeTotalDistance(directionsDisplay.getDirections());
        });

  var originInput = document.getElementById('origin-input');
  var destinationInput = document.getElementById('destination-input');
  var modeSelector = document.getElementById('mode-selector');

  var originAutocomplete = new google.maps.places.Autocomplete(originInput);
  // Specify just the place data fields that you need.
  originAutocomplete.setFields(['place_id']);

  var destinationAutocomplete =
      new google.maps.places.Autocomplete(destinationInput);
  // Specify just the place data fields that you need.
  destinationAutocomplete.setFields(['place_id']);

  this.setupClickListener('changemode-walking', 'WALKING');
  this.setupClickListener('changemode-transit', 'TRANSIT');
  this.setupClickListener('changemode-driving', 'DRIVING');

  this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
  this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(
      destinationInput);
  this.map.controls[google.maps.ControlPosition.LEFT_TOP].push(modeSelector);
}

// Sets a listener on a radio button to change the filter type on Places
// Autocomplete.
AutocompleteDirectionsHandler.prototype.setupClickListener = function(
    id, mode) {
  var radioButton = document.getElementById(id);
  var me = this;

  radioButton.addEventListener('click', function() {
    me.travelMode = mode;
    me.route();
  });
};

AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(
    autocomplete, mode) {
  var me = this;
  autocomplete.bindTo('bounds', this.map);

  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();

    if (!place.place_id) {
      window.alert('Please select an option from the dropdown list.');
      return;
    }
    if (mode === 'ORIG') {
      me.originPlaceId = place.place_id;
    } else {
      me.destinationPlaceId = place.place_id;
    }
    me.route();
  });
};

AutocompleteDirectionsHandler.prototype.route = function() {
  if (!this.originPlaceId || !this.destinationPlaceId) {
    return;
  }
  var me = this;

  this.directionsService.route(
      {
        origin: {'placeId': this.originPlaceId},
        destination: {'placeId': this.destinationPlaceId},
        travelMode: this.travelMode
      },
      function(response, status) {
        if (status === 'OK') {
          me.directionsDisplay.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      });
};  

    function computeTotalDistance(result) {
        var total = 0;
        var myroute = result.routes[0];
        for (var i = 0; i < myroute.legs.length; i++) {
          total += myroute.legs[i].distance.value;
        }
        total = total / 1000;
        document.getElementById('total').innerHTML = total + ' km';
      }

    </script>
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyD_4DuifX8CnPbWbQnH4SSNUlrisXyYGPM&libraries=places&callback=initMap'
        async defer></script>
  

    ";




    

    $response =  response($doc);

    return $response;


    //return array([
      //'map' => 'maps',
    //]);

        //return view('vendor.googlemaps.map3');

  }




  public function mapRotasDisplay(){

     $doc = '



          <style>
      #right-panel {
        font-family: "Roboto","sans-serif";
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        float: left;
        width: 63%;
        height: 100%;
      }
      #right-panel {
        float: right;
        width: 34%;
        height: 100%;
      }
      .panel {
        height: 100%;
        overflow: auto;
      }
    </style>

    <div id="map"></div>
    <div id="right-panel">
      <p>Total Distance: <span id="total"></span></p>
    </div>


     ';

     $doc = $doc . "
          <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: {lat: -24.345, lng: 134.46}  // Australia.
        });

        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: true,
          map: map,
          panel: document.getElementById('right-panel')
        });

        directionsDisplay.addListener('directions_changed', function() {
          computeTotalDistance(directionsDisplay.getDirections());
        });

        displayRoute('Perth, WA', 'Sydney, NSW', directionsService,
            directionsDisplay);
      }

      function displayRoute(origin, destination, service, display) {
        service.route({
          origin: origin,
          destination: destination,
          waypoints: [{location: 'Adelaide, SA'}, {location: 'Broken Hill, NSW'}],
          travelMode: 'DRIVING',
          avoidTolls: true
        }, function(response, status) {
          if (status === 'OK') {
            display.setDirections(response);
          } else {
            alert('Could not display directions due to: ' + status);
          }
        });
      }

      function computeTotalDistance(result) {
        var total = 0;
        var myroute = result.routes[0];
        for (var i = 0; i < myroute.legs.length; i++) {
          total += myroute.legs[i].distance.value;
        }
        total = total / 1000;
        document.getElementById('total').innerHTML = total + ' km';
      }
    </script>
    <script async defer
    src='https://maps.googleapis.com/maps/api/js?key=AIzaSyD_4DuifX8CnPbWbQnH4SSNUlrisXyYGPM&callback=initMap'>
    </script>
     ";

    $response =  response($doc);

    return $response;

  }
  


}
