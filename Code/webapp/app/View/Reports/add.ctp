<body>
<?php 

    echo $this->Html->css('report'); 
//    echo $this->Html->css('bootstrap-datetimepicker.min');
    
    
    
?>
<?php echo $this->Form->create('Report', array('inputDefaults' => array('label' => false))); ?>


<div class="container-fluid">
        <div class="panel-heading">
            <div class="panel-title text-center">
                     <h1 class="title">Create Assessment</h1>
                     <!--<hr />-->
             </div>
        </div>

    <h3>Lifeline Services Conditions</h3>
        <span >
        Please select the conditions of your building
        </span>
        <div class="row">
            <div class="funkyradio">
                <div class="funkyradio-success">
                    <div class="col-xs-6 ">                    
                        <input type="checkbox" name="data[Report][electricity]" id="ReportElectricity" />
                        <label for="ReportElectricity">
                            <span class="glyphicon glyphicon-flash"></span>
                            Electricity</label>
                    </div>
                </div>
                <div class="funkyradio-success">
                    <div class="col-xs-6 ">
                            <input  type="checkbox" name="data[Report][water]" id="ReportWater"/>
                            <label for="ReportWater">
                                <span class="glyphicon glyphicon glyphicon-tint"></span>
                                Water</label>                                            
                        
                    </div>
                </div>
            </div>    
        </div>
        <div class="row">
            <div class="funkyradio">
                <div class="funkyradio-success">
                    <div class="col-xs-6 ">                    
                        <input type="checkbox" name="data[Report][road_access]" id="ReportRoad_block" />
                        <label for="ReportRoad_block">
                            <span class="glyphicon glyphicon-road"></span>                            
                            Road Access</label>
                    </div>
                </div>
                <div class="funkyradio-success">
                    <div class="col-xs-6">                
                    <input type="checkbox" name="data[Report][telecommunication]" id="ReportTelecommunication"/>
                    <label for="ReportTelecommunication">
                        <span class="glyphicon glyphicon-earphone"></span>
                        Telecommunication</label>
                    </div>
                </div>
            </div>    
        </div>
    
        <hr/>
        
        <h3>Emergency Response Needs</h3>
        <span >
            Please select the emergency needs in your community
        </span>
        <div class="row">
            <div class="funkyradio">
                <div class="funkyradio-success">
                    <div class="col-xs-6 ">           
                        
                        <input type="checkbox" name="data[Report][food]" id="ReportFood" />
                        <label for="ReportFood">
                            <span class="glyphicon glyphicon-apple"></span>
                            Food</label>
                    </div>
                </div>
                <div class="funkyradio-success">
                    <div class="col-xs-6 ">                
                    <input type="checkbox" name="data[Report][sanitation]" id="ReportSanitation"/>
                    <label for="ReportSanitation">
                        <span class="glyphicon glyphicon glyphicon-tint"></span>
                        Sanitation</label>
                    </div>
                </div>
            </div>    
        </div>
        <div class="row">
            <div class="funkyradio">
                <div class="funkyradio-success">
                    <div class="col-xs-6 ">                    
                        <input type="checkbox" name="data[Report][first_aid]" id="ReportFirst_aid" />
                        <label for="ReportFirst_aid">
                            <span class="glyphicon glyphicon-plus-sign"></span>
                            First Aid</label>
                    </div>
                </div>
                <div class="funkyradio-success">
                    
                    <div class="col-xs-6">
                      
                    <input type="checkbox" name="data[Report][shelter]" id="ReportShelter"/>
                    <label for="ReportShelter">
                        <span class="glyphicon glyphicon-tent"></span>    
                        Shelter</label>
                    </div>
                </div>
            </div>    
        </div>
        
        <hr/>
        
        <!--<div class="bootstrap-iso">-->
        <h3>Date of Mapping</h3>
        <span >
            Select the date of the disaster (if applicable) 
        </span>
         <div class="row">
          <div class="col-xs-6">
             <div class="input-group">
              <div class="input-group-addon">
               <i class="glyphicon glyphicon-calendar">
               </i>
              </div>
              <input class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" type="text"/>
             </div>
            </div>
            </div>
         <!--</div>-->
        
        
        <hr/>

        <div class="form-group">
            <label for="ReportComments">Comments:</label>
            <textarea class="form-control" rows="5" name="data[Report][comments]" id="ReportComments"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Next</button>
        
        <br><br><br>
</div>
<?php echo $this->Form->end(); ?>

<?php echo $this->Html->script('jquery.min'); ?>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
</body>
<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>

