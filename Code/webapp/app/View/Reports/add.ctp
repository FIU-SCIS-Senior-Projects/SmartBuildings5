
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

    <h3>Life Services Conditions</h3>
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
                                <span class="glyphicon glyphicon-warning-sign"></span>
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
                        <span class="glyphicon glyphicon-shower"></span>
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
        
        
        <div class="row">
            <div class='col-sm-6'>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker1'>
                        
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        
                        <input type='text' class="form-control" />
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('.datetimepicker').datetimepicker()
                });
            </script>
        </div>
        
                
<!--<div class="well">
  <div id="datetimepicker2" class="input-append">
    <input data-format="MM/dd/yyyy HH:mm:ss PP" type="text"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
</div>
<script type="text/javascript">
  $(function() {
    $('#datetimepicker2').datetimepicker({
      language: 'en',
      pick12HourFormat: true
    });
  });
</script>-->
        
        
        <hr/>

        <div class="form-group">
            <label for="ReportComments">Comments:</label>
            <textarea class="form-control" rows="5" name="data[Report][comments]" id="ReportComments"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Next</button>
        
        <br><br><br>
</div>
<?php echo $this->Form->end(); ?>

<?php echo $this->Html->script('bootstrap-datetimepicker.min'); echo $this->Html->script('jquery.min');     ?>
