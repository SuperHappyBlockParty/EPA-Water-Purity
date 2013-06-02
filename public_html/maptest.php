<?php
    include 'inc/header.php';
?>
    <style type="text/css">
      /* Bootstrap Css Map Fix*/
      #mapcanvas img { 
        max-width: none;
        }
        /* Bootstrap Css Map Fix*/
        #mapcanvas label { 
          width: auto; display:inline; 
          } 
    </style>
    <script src="js/jquery.ui.map.full.min.js"></script>
    <script src="js/jquery.ui.map.extensions.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false">
    </script>
    <script type="text/javascript">
      $(function(){
        $('#mapcanvas').gmap(
          {'center': '33.5,-82',
           'zoom':   12,
           'scaleControl': true,
           'callback': function() {
              // Attempt to use viewer's current position.
              var self = this;
              self.getCurrentPosition(function(position, status) {
                if ( status === 'OK' ) {
                  var clientPosition =
                    new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    self.addMarker({'position': clientPosition, 'bounds': false});
                    self.get('map').panTo(clientPosition);
                }});
            }
          });
      });
    </script>
    <div class="container" style="margin-bottom: 1em;">
      <div id="mapcanvas" style="width: 100%; height: 40em;">
      </div>
    </div>
<?php
    include 'inc/footer.php';
?>
