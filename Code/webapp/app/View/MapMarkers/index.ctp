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
/*      
      #selectionModal {
        
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #0480be;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
     }*/

  
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
      var markerList=[];
      var map;
      var center_loc = {lat: 25.844639, lng: -80.307648};
      var selectionData = {electricity:1, water:2, road_access:3,telecommunication:4};
      var circleSelector = null;
      var circleSelectorInfo = {
          radius: 0,
          lat: 0,
          lng: 0
      };
      
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
            
            $('#filterModal').modal('show');
          
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
        controlUI.title = 'Click to center map';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.style.color = 'rgb(25,25,25)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '16px';
        controlText.style.lineHeight = '38px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = 'Center';
        controlUI.appendChild(controlText);

        // Setup the click event listeners: simply set the map to center.
        controlUI.addEventListener('click', function() {   
            
            map.setCenter(center_loc);

          
        });

      }
      
      function ApplySelectionControl(controlDiv, map) {

        // Set CSS for the control border.
        var controlUI = document.createElement('div');        
        controlUI.setAttribute('id','applySelectionControlDiv');
        controlUI.style.backgroundColor = '#E67164';
        controlUI.style.border = '2px solid #E67164';
        controlUI.style.borderRadius = '3px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginBottom = '22px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Click to apply selection';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.style.color = 'rgb(255,255,255)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '16px';
        controlText.style.lineHeight = '38px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = 'Apply Selection';
        controlUI.appendChild(controlText);

        // Setup the click event listeners: simply set the map to center.
        controlUI.addEventListener('click', function() {

            circleSelector.setMap(null);
            circleSelector = null;            
            var applySelControlDiv = document.getElementById('applySelectionControlDiv');
            map.controls[google.maps.ControlPosition.TOP_CENTER].pop(applySelControlDiv);
                        
            var reports=[];
            for (var i = 0; i < markerList.length; i++) {
                var latLng = new google.maps.LatLng(
                    markerList[i].loc.getPosition().lat(),
                    markerList[i].loc.getPosition().lng());
                if(isInSelectionRadius(latLng)){
                    reports.push(markerList[i].id);
                }                
            }
            
            $.ajax({
              type: 'POST',
              url: 'home',
              data: {reports: reports},
              success: function(result) {
                var data = JSON.parse(result);
                //alert(data.lng + " " + data.lat);
                if(!jQuery.isEmptyObject(data)){
                    selectionData = data;
//                    var head = document.getElementById("clip-wrapper");
//                    var script= document.createElement('script');
//                    script.type= 'text/javascript';
//                    script.src= '<?php echo FULL_BASE_URL.'/js/load-graph.js'?>';
//                    head.appendChild(script);
                    drawChart();
                    $('#selectionModal').modal('show');
                }else
                {
                    alert("Nothing returned");
                }
              }
            });
        });

      }

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {            
        center: center_loc,
        zoom: 8,
        disableDoubleClickZoom: true
          
        });
        var infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
//            var pos = {
//              lat: position.coords.latitude,
//              lng: position.coords.longitude            
//
//            };
            
            //infoWindow.setPosition(pos);
            //infoWindow.setContent('Location found.');           
            
            
            map.setCenter(pos);
            
            var latitude = pos.lat;
            var longitude = pos.lng;
            
            
            center_loc = {lat: latitude, lng: longitude};
             
//            $.ajax({
//              type: 'POST',
//              url: 'home',
//              data: {lat: latitude, lng: longitude},
//              success: function(data) {
//                //alert(data);
//              }
//            });

          }, function() {
            //handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          //handleLocationError(false, infoWindow, map.getCenter());
        }     
        
            //center map on recently created marker
            <?php if(!empty($this->Session->read('Users.showLat'))&&
                     !empty($this->Session->read('Users.showLng'))):?>
                var pos = {
                    lat: <?php echo $this->Session->read('Users.showLat'); ?>,
                    lng: <?php echo $this->Session->read('Users.showLng'); ?>         

                };
                <?php // $this->Session->write('Users.showLat',"dd");
                      // $this->Session->write('Users.showLng',"dd");?>
                              
                map.setCenter(pos);
            <?php endif;?>               
            
        
          //load map markers
            var xmlStr = <?php echo json_encode($xml_markers) ?>;
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
                markerList.push({loc: marker, id: markers[i].getAttribute("id")});

            }
            
            
            // Create the DIV to hold the control and call the CenterControl()
            // constructor passing in this DIV.
            var centerControlDiv = document.createElement('div');
            var filterControlDiv = document.createElement('div');
            
            
            CenterControl(centerControlDiv, map);
            FilterControl(filterControlDiv, map);
            

            //centerControlDiv.index = 1;
            //centerControlDiv.index = 1;
            //map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(centerControlDiv);
            map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(filterControlDiv);
           


//            google.maps.event.addListener(map, "doubleclick", function(event) {
//                var lat = event.latLng.lat();
//                var lng = event.latLng.lng();
//                // populate yor box/field with lat, lng
//                alert("Lat=" + lat + "; Lng=" + lng);
//            });
            
            map.addListener("dblclick", function(event) {
                if(circleSelector == null){
                    var lat = event.latLng.lat();
                    var lng = event.latLng.lng();

                    circleSelector = new google.maps.Circle({
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: '#FF0000',
                        fillOpacity: 0.35,
                        editable: true,
                        map: map,
                        center: {lat: lat, lng: lng},
                        radius: 100000
                    }); 
                    
                    circleSelectorInfo.radius = 100000;
                    circleSelectorInfo.lat = lat;
                    circleSelectorInfo.lng = lng;
                        
                    var applySelControlDiv = document.createElement('div');
                    ApplySelectionControl(applySelControlDiv,map);
                    map.controls[google.maps.ControlPosition.TOP_CENTER].push(applySelControlDiv);
                    
                    
                    circleSelector.addListener("radius_changed", function() {
                        circleSelectorInfo.radius = circleSelector.getRadius();
                    });
                    
                    circleSelector.addListener("center_changed", function() {
                        circleSelectorInfo.lat = circleSelector.getCenter().lat();
                        circleSelectorInfo.lng = circleSelector.getCenter().lng();
                    });
                    
                    
                }
            });        
            
             google.maps.Circle.prototype.contains = function(latLng) {
            return this.getBounds().contains(latLng) && 
                   google.maps.geometry.spherical.computeDistanceBetween(this.getCenter(), latLng) <= this.getRadius();
        }
              
      } 
      
        
      
        function isInSelectionRadius(latLng) {
            var center = new google.maps.LatLng(
                    circleSelectorInfo.lat,
                    circleSelectorInfo.lng);
            return google.maps.geometry.spherical.computeDistanceBetween(center, latLng) <= circleSelectorInfo.radius;
        }
      
      function bindInfoWindow(marker, map, infoWindow, html) {
        google.maps.event.addListener(marker, 'click', function() {
          infoWindow.setContent(html);
          infoWindow.open(map, marker);
        });        
        
      }
      
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['id', "Data"], 
          ['Electricity', selectionData.electricity],
          ['Water', selectionData.water],
          ['Road Access', selectionData.road_access],
          ['Telecommunication', selectionData.telecommunication]

        ]);

        var options = {
            backgroundColor: 'transparent',
          title: 'Life Line Systems Disruption', //humatarian needs
          pieHole: 0.4
          //is3D: true
      //                      colors: ['#00FF00', '#FFFF00', '#FF0000']
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
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
    <div id="filterModal" class="modal fade" role="dialog">
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
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Filter</button>
          </div>
        </div>

      </div>
        <?php echo $this->Form->end(); ?>

    </div>   
    
    <!-- Modal -->
    <div id="selectionModal" class="modal fade" role="dialog" >
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Data Statistics</h4>
          </div>
          <div class="modal-body" id="clip-wrapper">   
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"/> </script>
                <script>
                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                </script>
                <div id="donutchart" style="width: 200px; height: 200px;"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" >Close</button>
          </div>
        </div>

      </div>
    </div> 
   
    <div id="map"> </div>
   <script async defer
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNdRsx6x8pcf9Ie90WCrzkk1k8pROMRYI&callback=initMap"> 
	
    </script> 
<!--    <div id="legend"><h3>Legend</h3></div>-->
    </body>
   
</html>

