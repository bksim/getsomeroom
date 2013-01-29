
    <style type="text/css">
      #map_canvas { height: 100% }
      #map_container {height: 100%;}
    </style>

    <!-- MAPS FEATURE -->

    <!--
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFtZJbKg9iT-Bg4zMFR-s0uJSuPwj5BVc&sensor=false" type="text/javascript"></script>-->

    <script type="text/javascript">
      $('#main').css({opacity:1.0}); //makes map easier to read
      var geocoder;

      var neighborhoods = [
        new google.maps.LatLng(42.3583, 71.0603),
        new google.maps.LatLng(52.549061, 73),
        new google.maps.LatLng(52.497622, 75),
        new google.maps.LatLng(52.517683, 3)
      ];
      var markers = [];
      var iterator = 0;
      var map;

      function initialize() {
        console.log("initializing..."); 

        var mapOptions = {
          center: new google.maps.LatLng(-34.397, 150.644),
          zoom: 4,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);

        geocoder = new google.maps.Geocoder();

        // set center to USA
        geocoder.geocode( { 'address': 'United States of America'}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            map.setZoom(4);
            /*var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });*/
          } else {
            alert("Geocode was not successful for the following reason: " + status);
          }
        });
      }

      //drop pins
      function drop() {
        for (var i =0; i < neighborhoods.length; i++) {
          setTimeout(function() {
            addMarker();
          }, i * 200);
        }
      }

      //adds markers
      function addMarker() {
      markers.push(new google.maps.Marker({
        position: neighborhoods[iterator],
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP
        }));
      iterator++;
      }

      $(document).ready(function() {
        initialize();
      });
    </script>

  <div id="map_container" style="opacity:">
    <div id="map_canvas" style="width:100%; height:100%"></div>
  </div>