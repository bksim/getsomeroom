    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      #map_canvas { height: 100% }
      #map_container {height: 100%;}
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFtZJbKg9iT-Bg4zMFR-s0uJSuPwj5BVc&sensor=false"
  type="text/javascript"></script>
    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(-34.397, 150.644),
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
      }
    </script>
  <div id="map_container" onload="initialize()">
    <div id="map_canvas" style="width:100%; height:100%"></div>
  </div>