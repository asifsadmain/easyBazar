<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions Service</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 110px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
  </head>
  <body>
    @include('layouts.appdm')
    <div id="floating-panel">
    <b>Start: </b>
    <select id="start">
      <option value="{{ Auth::guard('dm')->user()->address }}">{{ Auth::guard('dm')->user()->address }}</option>
    </select>
    <b>End: </b>
    <select id="end">
      <option value="{{ $seller->address }}">{{ $seller->address }}</option>
    </select>
    <button id="route">Show Route</button>
    </div>
    <div id="map" style="height: 50%; top:20px;"></div>
    <br>
    <div class="text-center">
      <div class="row container">
        <div class="col-md-2"></div>
        <div class="col-md-4">
          <h3 id="distance"></h3>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4 ml-auto">
          <h3 id="time"></h3>
        </div>
      </div>
    </div>
    <div style="margin-left:20px;">
      @if (!$order->dm_id)
        <a href="/acceptOrder/{{$order->id}}" class="btn btn-success">Accept Order</a>
      @else
        <a href="" class="btn btn-secondary">Accepted</a>
      @endif
    </div>
    <script>
      var map;
      function initMap() {
        var directionsService = new google.maps.DirectionsService();
        var directionsRenderer = new google.maps.DirectionsRenderer();
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: {lat: 23.8103, lng: 90.4125}
        });
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            var marker = new google.maps.Marker({position: pos, map: map});
            // infoWindow.setPosition(pos);
            // infoWindow.setContent('Location found.');
            // infoWindow.open(map);
            map.setCenter(pos);
            }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
        directionsRenderer.setMap(map);

        var onChangeHandler = function() {
          calculateAndDisplayRoute(directionsService, directionsRenderer);
          calculateDistance();
        };
        document.getElementById('route').addEventListener('click', onChangeHandler);
        //document.getElementById('end').addEventListener('change', onChangeHandler);
      }

      function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        directionsService.route(
            {
              origin: {query: document.getElementById('start').value},
              destination: {query: document.getElementById('end').value},
              travelMode: 'DRIVING'
            },
            function(response, status) {
              if (status === 'OK') {
                directionsRenderer.setDirections(response);
              } else {
                window.alert('Directions request failed due to ' + status);
              }
            });
      }
      function calculateDistance() {
            var origin = document.getElementById('start').value;
            var destination = document.getElementById('end').value;
            var service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix(
                {
                    origins: [origin],
                    destinations: [destination],
                    travelMode: google.maps.TravelMode.DRIVING,
                    unitSystem: google.maps.UnitSystem.IMPERIAL, // miles and feet.
                    // unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
                    avoidHighways: false,
                    avoidTolls: false
                }, callback);
      }
      function callback(response, status) {
                var origin = response.originAddresses[0];
                var destination = response.destinationAddresses[0];
                var distance = response.rows[0].elements[0].distance;
                var duration = response.rows[0].elements[0].duration;
                console.log(response.rows[0].elements[0].distance);
                var distance_in_kilo = distance.value / 1000; // the kilom
                var distance_in_mile = distance.value / 1609.34; // the mile
                var duration_text = duration.text;
                var duration_value = duration.value;
                console.log(distance_in_kilo);
                console.log(duration_text);
                console.log(duration_value);
                document.getElementById('distance').innerHTML = "Distance: " +  distance_in_kilo + "km";
                document.getElementById('time').innerHTML = "Arrival Time: " + duration_text;
        }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCICVFZg9PawAeVO5oH_BRdE7IEu93eG8E&callback=initMap">
    </script>
  </body>
</html>