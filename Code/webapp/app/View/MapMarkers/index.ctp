<!DOCTYPE html>
<html>
  <head>
      
    <title>Disaster ReConnect</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">

    <style>
      html, body {
/*        height: 100%;
        margin: 0;
        padding: 0;
        width: 100%;*/
        
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
    .datepicker{z-index:1151 !important;}
    
    .addspace{
        /*padding-left:50px;*/
        /*padding-right:50px;*/
    }
    
    
/*    #legend {
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
      }*/
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

/*.modal-header-primary {
	color:#fff;
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #428bca;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
}*/

.card {
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
}

.card {
  margin-top: 10px;
  box-sizing: border-box;
  border-radius: 2px;
  background-clip: padding-box;
}
.card span.card-title {
    color: #fff;
    font-size: 24px;
    font-weight: 300;
    text-transform: uppercase;
}

/*.card .card-image {
  position: relative;
  overflow: hidden;
}
.card .card-image img {
  border-radius: 2px 2px 0 0;
  background-clip: padding-box;
  position: relative;
  z-index: -1;
}
.card .card-image span.card-title {
  position: absolute;
  bottom: 0;
  left: 0;
  padding: 16px;
}*/
.card .card-content {
  padding: 16px;
  border-radius: 0 0 2px 2px;
  background-clip: padding-box;
  box-sizing: border-box;
}
.card .card-content p {
  margin: 0;
  color: inherit;
}
.card .card-content span.card-title {
  line-height: 48px;
}
.card .card-action {
  border-top: 1px solid rgba(160, 160, 160, 0.2);
  padding: 16px;
}
.card .card-action a {
  color: #ffab40;
  margin-right: 16px;
  transition: color 0.3s ease;
  text-transform: uppercase;
}
.card .card-action a:hover {
  color: #ffd8a6;
  text-decoration: none;
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
      var markerList=[];
      var map;
      var center_loc;
      var selectionData = {electricity:0, water:0, road_access:0,telecommunication:0,
                           food:0,sanitation:0,first_aid:0,shelter:0};
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
//                    setTimeout(
//                    function() 
//                    {
//                      drawChart();
//                    }, 200);

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
        center_loc = new google.maps.LatLng(0, 0);
        map = new google.maps.Map(document.getElementById('map'), {            
        center: center_loc,
        zoom: 2,
        disableDoubleClickZoom: true,
        mapTypeControlOptions: {
              style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
              position: google.maps.ControlPosition.TOP_RIGHT
          },
          
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
                var date = markers[i].getAttribute("date");
                var type = markers[i].getAttribute("type");              
                var point = new google.maps.LatLng(
                    parseFloat(markers[i].getAttribute("lat")),
                    parseFloat(markers[i].getAttribute("lng")));
                var html = "<b>" + date + "</b> <br/>" +
                            name + "<br/>" +
                            "<a href=\"reports/view/" + markers[i].getAttribute("id") + "\"> View Report </a>";
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
                                        
                    var rad;
                    var zoomVal = map.getZoom();
                    if(zoomVal<4){
                        rad = 1000000;
                    }else if(zoomVal<6){
                        rad = 500000;
                    }else if(zoomVal<9){
                        rad = 100000;
                    }else if(zoomVal<10){
                        rad = 30000;
                    }else if(zoomVal<11){
                        rad = 20000;
                    }else if(zoomVal<12){
                        rad = 10000;
                    }else if(zoomVal<12){
                        rad = 8000;
                    }
                    else if(zoomVal<15){
                        rad = 5000;
                    }
                    
                    circleSelector = new google.maps.Circle({
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: '#FF0000',
                        fillOpacity: 0.35,
                        editable: true,
                        map: map,
                        center: {lat: lat, lng: lng},
                        radius: rad
                    }); 
                    
                    circleSelectorInfo.radius = rad;
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
        
        <?php if(isset($landing_about)):?>
            $('#aboutModal').modal('show');
        <?php endif;?>      
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
        var data_services = google.visualization.arrayToDataTable([
          ['id', "Data"], 
          ['Electricity', selectionData.electricity],
          ['Water', selectionData.water],
          ['Road Access', selectionData.road_access],
          ['Telecommunication', selectionData.telecommunication]

        ]);
        
        var data_needs = google.visualization.arrayToDataTable([
          ['id', "Data"], 
          ['Food', selectionData.food],
          ['Sanitation', selectionData.sanitation],
          ['First Aid', selectionData.first_aid],
          ['Shelter', selectionData.shelter]

        ]);

        var options_services = {
            backgroundColor: 'transparent',
            title: 'Life Line Systems Disruption', //humatarian needs
            pieHole: 0.4,
            width:500,
            height:400,
            pieSliceText: "none"
          //is3D: true
      //                      colors: ['#00FF00', '#FFFF00', '#FF0000']
        };
        
        var options_needs = {
            backgroundColor: 'transparent',
            title: 'Humatarian Needs', //humatarian needs
            pieHole: 0.4,
            width:500,
            height:400,
            pieSliceText: "none"
          //is3D: true
      //                      colors: ['#00FF00', '#FFFF00', '#FF0000']
        };

//        var chart_services = new google.visualization.PieChart(document.getElementById('donutchart_services'));
//
//                     chart_services.draw(data_services, options_services);
//                     
//          var chart_needs = new google.visualization.PieChart(document.getElementById('donutchart_needs'));
//
//                     chart_needs.draw(data_needs, options_needs);
        var chart_services = new google.visualization.PieChart(document.getElementById('donutchart_services'));
        var chart_needs = new google.visualization.PieChart(document.getElementById('donutchart_needs'));
        
        if(selectionData.electricity==0 && selectionData.water==0 &&
           selectionData.road_access==0 && selectionData.telecommunication==0){
            options_services.title = "No service disruptions in this area";
            chart_services.draw(data_services, options_services);
        }else{                    

            chart_services.draw(data_services, options_services);

        }
        
        if(selectionData.food==0 && selectionData.sanitation==0 &&
           selectionData.first_aid==0 && selectionData.shelter==0){
           options_needs.title = "No needs in this area"
           chart_needs.draw(data_needs, options_needs);
//            $("#donutchart_needs").append("There are no needs in this area");
        }else{
                    

            chart_needs.draw(data_needs, options_needs);

        }
            
        
        
      }
      
      function date(){
          var date_input=$('input[name="date"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "modal-body";
                date_input.datepicker({
                    format: 'yyyy-mm-dd',
                    container: container,
                    todayHighlight: true,
                    autoclose: true,
                })            
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
<!--        <style>
        .datepicker{z-index:1151 !important;}
        </style>-->
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header modal-header-info">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Filter Markers By</h3>
          </div>
          <div class="modal-body">
              
            <div class="form-group addspace">
                <div class="row">
                    <div class="col-xs-6">                
                        <h4 class="title">Date</h4>
                        <!--<div class="row">-->
                            <!--<div class="col-xs-6">-->
    <!--                           <div class="input-group">
                                <div class="input-group-addon">
                                 <i class="glyphicon glyphicon-calendar">
                                 </i>
                                </div>
                                <input class="form-control form-date" id="date" name="date" placeholder="YYYY-MM-DD" type="text"/>
                                   <input type="text" name="reportrange" />
                               </div>-->
                              <!--</div>-->
                        <!--</div>-->
                        <div class="pull-right">
                        <div class="input-group">
                            <!--<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;-->
                            <!--<span class="glyphicon glyphicon-calendar fa fa-calendar"></span>-->
                            <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                </span> 
                            <input class="form-control" id="reportrange" name="reportrange" type="text"/>                                               
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-3 ">
                        <h4 class="title">Lack of</h4>           
                        <?php echo $this->Form->input('electricity',array('type'=>'checkbox'));?>
                        <?php echo $this->Form->input('water',array('type'=>'checkbox'));?>
                        <?php echo $this->Form->input('road_access',array('type'=>'checkbox'));?>
                        <?php echo $this->Form->input('telecommunication',array('type'=>'checkbox','label'=>'Telecom'));?>
                    </div>


                    <div class="col-xs-3 ">                
                        <h4 class="title">Need of</h4>
                        <?php echo $this->Form->input('food',array('type'=>'checkbox'));?>
                        <?php echo $this->Form->input('sanitation',array('type'=>'checkbox'));?>
                        <?php echo $this->Form->input('first_aid',array('type'=>'checkbox'));?>
                        <?php echo $this->Form->input('shelter',array('type'=>'checkbox'));?>

                    </div>  
                    
<!--                    <div class="col-xs-6">                
                        <h4 class="title">Date</h4>
                        <div class="row">
                            <div class="col-xs-6">
                               <div class="input-group">
                                <div class="input-group-addon">
                                 <i class="glyphicon glyphicon-calendar">
                                 </i>
                                </div>
                                <input class="form-control form-date" id="date" name="date" placeholder="YYYY-MM-DD" type="text"/>
                                   <input type="text" name="reportrange" />
                               </div>
                              </div>
                        </div>
                        <div class="pull-right">
                        <div class="input-group">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                            <span class="glyphicon glyphicon-calendar fa fa-calendar"></span>
                            <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                </span> 
                            <input class="form-control" id="reportrange" name="reportrange" type="text"/>                                               
                            </div>
                        </div>

                    </div>-->

                </div>
            </div>
          </div>
          <div class="modal-footer">
              
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
            <button type="submit" class="btn btn-info" >Filter</button>
          </div>
        </div>     

      </div>
        <?php echo $this->Form->end(); ?>
        
        <?php echo $this->Html->script('jquery.min'); ?>
        <?php // echo $this->Html->script('bootstrap-datetimepicker.min'); ?>
<!--        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>-->

<!--        <script>
            $(document).ready(function(){
                var date_input=$('input[name="date"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "modal-body";
                date_input.datepicker({
                    format: 'yyyy-mm-dd',
                    container: container,
                    todayHighlight: true,
                    autoclose: true,
                })
            })
        </script>-->
        
        <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>-->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        
        <script type="text/javascript">
        $(function() {
            
//            $('#reportrange').daterangepicker({
//                autoUpdateInput: false,
//                locale: {
//                    cancelLabel: 'Clear'
//                }
//            });

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
            
            $('#reportrange').daterangepicker({
                 autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                },
                startDate: start,
                endDate: end,
                ranges: {
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                   'Last 2 Months': [moment().subtract(2, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                   'Last 3 Months': [moment().subtract(3, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });
            
             $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

        });
        </script>

    </div>   
    
    <!-- Modal -->
    <div id="selectionModal" class="modal fade" role="dialog" >
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header modal-header-info">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Data Statistics</h3>
          </div>
          <div class="modal-body-chart" id="clip-wrapper">   
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"/> </script>
                <script>
                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                </script>
                <div id="donutchart_services" style="width: 200px; height: 300px;"></div>
                <div id="donutchart_needs" style="width: 200px; height: 300px;"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
          </div>
        </div>

      </div>
    </div>    
    
    <!-- Modal -->
    <div id="aboutModal" class="modal fade" role="dialog" >
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header modal-header-info" >
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Welcome to <abbr title="Disaster Reconnaissance and Response Mapping and Assessment App">Disaster ReConnect</abbr></h3>
          </div>
          <div class="modal-body-about">
            <div class="panel-heading">
                <div class="panel-title text-center">
                    <h3 class="title">How To Use</h3>
                    <!--<p><b>D</b>isaster <b>R</b>econnaissance <b>A</b>ssessment <b>M</b>apping <b>A</b>pplication</p>-->                    
                </div>
            </div>
            <div>
                <div class="row">
                    <!-- Card Projects -->
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-content">
                                <h4> Create Mapping Report </h4>
                                <small><em>Create a mapper account to use this feature</em></small>
                            </div>

                            <div class="card-action">
                                <p>
                                   Click on the "Create Report" tab to start a mapping report. 
                                   You will be able to provide information about lifeline services conditions
                                   and emergency response needs. Also you can upload photos of the building 
                                   or damaged facilities related to the report. Please make sure that the photos
                                   contain GPS information. Uploaded photos should be from a single building facility,
                                   if you wish to report other areas or building create a separate report.

                                </p>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-content">
                                <h4> View Mapping Report </h4>
                            </div>

                            <div class="card-action">
                                <p> 
                                    Click on a marker on the map. The pop up window will the date
                                    and name of the person who created the report. Click on "View Report" link
                                    to open the full report.
                                </p>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <h4> Filter Report Markers</h4>
                                <!--<small><em>Create a mapper account to use this feature</em></small>-->
                            </div>

                            <div class="card-action">
                                <p>
                                   Click on the "Filter" button in the bottom middle section of the map
                                   to screen the type of reports you would like to see. You may filter by 
                                   date range and categories.
                                </p>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <h4> Select Report Markers</h4>
                                <!--<small><em>Create a mapper account to use this feature</em></small>-->
                            </div>

                            <div class="card-action">
                                <p>
                                   Double click anywhere on the map to start marker selection. You can
                                   resize and move the selection circle to select report markers.
                                   Click on the "Apply Selection" button in the upper middle of the map. You 
                                   will be able to see the grouped statistics about the selected reports
                                   in the form of a pie chart.
                                </p>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-content">
                                <h4> Evaluate Mapping Report </h4>
                                <small><em>Create an evaluator account to use this feature</em></small>
                            </div>

                            <div class="card-action">
                                <p>
                                   In the view report page you can evaluate the conditions of the report. Navigate
                                   to the evaluation section. You may view the photos uploaded and evaluate the facility's
                                   condition by choosing safe, minor damage, major damage, or Insufficient Information.
                                </p>
                            </div>                            
                        </div>
                    </div>
<!--                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-content">
                                <h4> Create Mapping Report <h4>
                                <small><em>Create a mapper account to use this feature</em></small>
                            </div>

                            <div class="card-action">
                                <p>Click on the "Create Report" tab to start a mapping report. 
                                   You will be able to provide information about lifeline services conditions
                                   and emergency response needs. Also you can upload photos of the building 
                                   or damaged facilities related to the report. Please make sure that the photos
                                   contain GPS information. Uploaded photos should be from a single building facility,
                                   if you wish to report other areas or building create a separate report

                                </p>
                            </div>                            
                        </div>
                    </div>-->
<!--                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-content">
                                <h4> Create Mapping Report <h4>
                                <small><em>Create a mapper account to use this feature</em></small>
                            </div>

                            <div class="card-action">
                                <p>Click on the "Create Report" tab to start a mapping report. 
                                   You will be able to provide information about lifeline services conditions
                                   and emergency response needs. Also you can upload photos of the building 
                                   or damaged facilities related to the report. Please make sure that the photos
                                   contain GPS information. Uploaded photos should be from a single building facility,
                                   if you wish to report other areas or building create a separate report

                                </p>
                            </div>                            
                        </div>
                    </div>-->
                </div>
            </div>
          </div> 
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
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

