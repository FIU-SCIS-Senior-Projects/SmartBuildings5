<!DOCTYPE html>
<html>
  <head>
      
    <title>Disaster Helper</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">

    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        width: 100%;
        
      }
      #map {        
        position: absolute;
        margin: 0;
        padding: 0;
        top: 60px;
        width: 100%;
        bottom: 0px;
       padding-right: 1px;
      }
      
      .checkbox-grid li {
        display: block;
        float: right;
        width: 25%;
    }
    
    #legend {
        font-family: Arial, sans-serif;
        background: #fff;
        padding: 10px;
        margin: 10px;
        border: 3px solid #000;
      }
      #legend h3 {
        margin-top: 0;
      }
      #legend img {
        vertical-align: middle;
      }

  
    </style>
  </head>
   

    
    <script>
  
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      
      var customIcons = {
        not_rated: {
          icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
        },
        danger: {
          icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
        },
        neutral: {
          icon: 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png'
        },
        safe: {
          icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
        }
      };
      
      var map;
      var center_loc = {lat: 25.844639, lng: -80.307648};
      
            /**
       * The CenterControl adds a control to the map that recenters the map on
       * Chicago.
       * This constructor takes the control DIV as an argument.
       * @constructor
       */
      function FilterControl(controlDiv, map) {

        // Set CSS for the control border.
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.border = '2px solid #fff';
        controlUI.style.borderRadius = '3px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginBottom = '22px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Click to filter map';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.style.color = 'rgb(25,25,25)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '16px';
        controlText.style.lineHeight = '38px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = 'Filter';
        controlUI.appendChild(controlText);

        // Setup the click event listeners: simply set the map to center.
        controlUI.addEventListener('click', function() {   
            
            $('#myModal').modal('show');
          
        });

      }
      
      function CenterControl(controlDiv, map) {

        // Set CSS for the control border.
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.border = '2px solid #fff';
        controlUI.style.borderRadius = '3px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginBottom = '22px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Click to filter map';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.style.color = 'rgb(25,25,25)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '16px';
        controlText.style.lineHeight = '38px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = 'Filter Markers';
        controlUI.appendChild(controlText);

        // Setup the click event listeners: simply set the map to center.
        controlUI.addEventListener('click', function() {   
            
            map.setCenter(center_loc);

          
        });

      }

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {            
        center: center_loc,
        zoom: 8
          
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude            

            };
            
            //infoWindow.setPosition(pos);
            //infoWindow.setContent('Location found.');
            map.setCenter(pos);
            
            var latitude = pos.lat;
            var longitude = pos.lng;
            
            center_loc = {lat: latitude, lng: longitude};
             
            $.ajax({
              type: 'POST',
              url: 'home',
              data: {lat: latitude, lng: longitude},
              success: function(data) {
                //alert(data);
              }
            });

          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }     
        
          //load map markers
            var xmlStr = <?php echo json_encode($xml_data) ?>;
            xmlDoc = new DOMParser().parseFromString(xmlStr, 'text/xml');
            
            var markers = xmlDoc.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {
              
              //var address = markers[i].getAttribute("address");
                var name = markers[i].getAttribute("name");
                var type = markers[i].getAttribute("type");              
                var point = new google.maps.LatLng(
                    parseFloat(markers[i].getAttribute("lat")),
                    parseFloat(markers[i].getAttribute("lng")));
                var html = "<b>" + name + "</b> <br/>" +
                            "<a href=\"reports/view/" + markers[i].getAttribute("id") + "\"> View Assessment </a>";
                var icon = customIcons[type] || {};
                var marker = new google.maps.Marker({
                  map: map,
                  position: point,
                  icon: icon.icon,
                  title: name
                  
                });
                bindInfoWindow(marker, map, infoWindow, html);
            }
            
            
            // Create the DIV to hold the control and call the CenterControl()
            // constructor passing in this DIV.
            var centerControlDiv = document.createElement('div');
            var filterControlDiv = document.createElement('div');
            CenterControl(centerControlDiv, map);
            FilterControl(filterControlDiv, map);


            centerControlDiv.index = 1;
            centerControlDiv.index = 1;
            //map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(centerControlDiv);
            map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(filterControlDiv);

//            var legend = document.getElementById('legend');
//            for (var key in customIcons) {
//              var type = customIcons[key];
//              var name = "name";//type.name;
//              var icon = type.icon;
//              var div = document.createElement('div');
//              div.innerHTML = '<img src="' + icon + '"> ' + name;
//              legend.appendChild(div);
//            }
//    
//            map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
              
      } 
      
      function bindInfoWindow(marker, map, infoWindow, html) {
        google.maps.event.addListener(marker, 'click', function() {
          infoWindow.setContent(html);
          infoWindow.open(map, marker);
        });        
        
      }


//      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
//        infoWindow.setPosition(pos);
//        infoWindow.setContent(browserHasGeolocation ?
//                              'Error: The Geolocation service failed.' :
//                              'Error: Your browser doesn\'t support geolocation.');
//      }
    </script>
    
    
 <body>
   
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <?php echo $this->Form->create('MapMarker'); ?> 
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Filter Markers By</h4>
          </div>
          <div class="modal-body">
              <div class="form-group">


            <!--<ul class="checkbox-grid">-->
                <!--<div class="panel-heading">-->
                <!--<div class="panel-title text-center">-->

                         <!--<hr />-->
                 <!--</div>-->
            <!--</div>-->
                <!--<li><input type="checkbox" name="text1" value="value1" /><label for="text1">Text 1</label></li>-->
            <div class="row">
                <div class="col-xs-4 ">
                    <h4 class="title">Lack of</h4>           
                    <?php echo $this->Form->input('electricity',array('type'=>'checkbox'));?>
                    <?php echo $this->Form->input('water',array('type'=>'checkbox'));?>
                    <?php echo $this->Form->input('road_access',array('type'=>'checkbox'));?>
                    <?php echo $this->Form->input('telecommunication',array('type'=>'checkbox'));?>
                </div>


                <div class="col-xs-4 ">                
                    <h4 class="title">Need of</h4>
                    <?php echo $this->Form->input('food',array('type'=>'checkbox'));?>
                    <?php echo $this->Form->input('sanitation',array('type'=>'checkbox'));?>
                    <?php echo $this->Form->input('first_aid',array('type'=>'checkbox'));?>
                    <?php echo $this->Form->input('shelter',array('type'=>'checkbox'));?>

                </div>

                <div class="col-xs-4 ">                
                    <h4 class="title">Media</h4>
                    <?php echo $this->Form->input('images',array('type'=>'checkbox'));?>

                </div>

            </div>
    <!--            <li><input type="checkbox" name="text2" value="value2" /><label for="text2">Text 2</label></li>
                <li><input type="checkbox" name="text3" value="value3" /><label for="text3">Text 3</label></li>
                <li><input type="checkbox" name="text4" value="value4" /><label for="text4">Text 4</label></li>-->
                <!--<hr>-->
                <!--<div class="panel-title text-center">-->

                         <!--<hr />-->
                 <!--</div>-->
    <!--            <li><input type="checkbox" name="text5" value="value5" /><label for="text5">Text 5</label></li>
                <li><input type="checkbox" name="text6" value="value6" /><label for="text6">Text 6</label></li>
                <li><input type="checkbox" name="text7" value="value7" /><label for="text7">Text 7</label></li>
                <li><input type="checkbox" name="text8" value="value8" /><label for="text8">Text 8</label></li>
                <br>
                <br>-->
            <!--</ul>-->
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Filter</button>
          </div>
        </div>

      </div>
        <?php echo $this->Form->end(); ?>

    </div>    
   
    <div id="map"> </div>
   <script async defer
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNdRsx6x8pcf9Ie90WCrzkk1k8pROMRYI&callback=initMap"> 
	
    </script> 
    
<!--    <div id="legend"><h3>Legend</h3></div>-->
    </body>
   
</html>

