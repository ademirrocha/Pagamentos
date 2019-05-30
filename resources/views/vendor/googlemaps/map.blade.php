@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Myzzy Maps</h1>
@stop

@section('content')
   
    


    <div id="map" style="width: 500px; height: 500px;"></div>

    

@stop

@section('js')

<!-- Scripts -->


 <script type="text/javascript">
     // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
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

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_4DuifX8CnPbWbQnH4SSNUlrisXyYGPM&callback=initMap"
    async defer></script>


@endsection