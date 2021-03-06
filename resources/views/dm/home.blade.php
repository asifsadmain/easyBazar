<!DOCTYPE html>
<html>
<head>
    <title>DeliveryMan Home</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
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
    </style>
</head>
<body>
    @include('layouts.appdm')
    <div id="map" style="height: 50%;"></div>
    <br>
    <div style="margin-left:20px;">
        <h5>Current status: 
            @if (Auth::guard('dm')->user()->availability == 1)
                <strong class="text-success">available</strong>
            @else
                <strong class="text-danger">unavailable</strong>
            @endif
        </h5>
        <a href="/dm/changeStatus" class="btn btn-primary">Change Status</a>
    </div>
    <script>
        // Note: This example requires that you consent to location sharing when
        // prompted by your browser. If you see the error "The Geolocation service
        // failed.", it means you probably did not give permission for the browser to
        // locate you.
        var map, infoWindow;
        function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 23.8103, lng: 90.4125},
            zoom: 16
        });
        //infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
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
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                                'Error: The Geolocation service failed.' :
                                'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
        }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCICVFZg9PawAeVO5oH_BRdE7IEu93eG8E&callback=initMap">
    </script>
</body>
</html>