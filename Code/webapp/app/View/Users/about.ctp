<?php
//    echo $this->Html->css('card');
    echo $this->Html->css('report-image');
?>
<style>
    
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

p{
    text-align: justify;
}
</style>
    <div class="card card-container" >
        <div class="panel-heading">
                <div class="panel-title text-center">
                    <h2 class="title">DRAMA</h2>
                    <p><b>D</b>isaster <b>R</b>econnaissance <b>A</b>ssessment <b>M</b>apping <b>A</b>pplication</p>                    
                </div>
            </div>
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
                                    Click on a marker on the map. The pop up window will how the date
                                    and name of the person who create report. Click on "View Report" link
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
                                   Double click anywhere on the map start report marker selection. You can
                                   resize and move the selection circle to select report markers in any area.
                                   Click on the "Apply Selection" button in the upper middle of the map. You 
                                   will be able to see the grouped statistics in the form of a pie chart about
                                   the selected reports.
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
                                   In the report page you can evaluate the conditions of the report. Navigate
                                   to the Evaluation section, view the photos uploaded and evaluate the facility's
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
$(".nav a").on("click", function(){
   $(".nav").find(".active").removeClass("active");
   $(this).parent().addClass("active");
});
</script> 