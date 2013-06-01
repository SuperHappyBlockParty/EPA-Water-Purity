<!DOCTYPE html>

<html lang="en">
  <head>
    <title>(U) Maps test for EPA thingy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.ui.map.full.min.js"></script>
    <script src="js/jquery.ui.map.extensions.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false">
    </script>
    <script type="text/javascript">
      $(function(){
        $('#mapcanvas').gmap(
          {'center': '33.5,-82',
           'zoom':   12,
           'callback': function() {
              // Attempt to use viewer's current position.
              var self = this;
              self.getCurrentPosition(function(position, status) {
                if ( status === 'OK' ) {
                  var clientPosition = 
                    new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    self.addMarker({'position': clientPosition});
                    self.get('map').panTo(clientPosition);
                }});
            }
          });
      });
    </script>
    <h1>Foo</h1>
    <div class="container">
      <div id="mapcanvas" style="width: 100%; height: 40em;" />
    </div>
  </body>
</html>
