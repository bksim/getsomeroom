
    <style type="text/css">
      #map_canvas { height: 100% }
      #map_container {height: 100%;}
    </style>

    <!-- MAPS FEATURE -->

    <!--
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFtZJbKg9iT-Bg4zMFR-s0uJSuPwj5BVc&sensor=false" type="text/javascript"></script>-->

    <script type="text/javascript">
      var geocoder;
      function initialize() {
        console.log("maps initialized."); 

        var mapOptions = {
          center: new google.maps.LatLng(-34.397, 150.644),
          zoom: 6,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);

        geocoder = new google.maps.Geocoder();

        geocoder.geocode( { 'address': 'United States of America'}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            map.setZoom(6);
            /*var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });*/
          } else {
            alert("Geocode was not successful for the following reason: " + status);
          }
        });
      }

      $(document).ready(function() {
        initialize();
      });
    </script>

  <div id="map_container">
    <div id="map_canvas" style="width:100%; height:100%"></div>
  </div>