<?php echo $this->Html->css('report'); ?>

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
                        <label for="ReportElectricity">Electricity</label>
                    </div>
                </div>
                <div class="funkyradio-success">
                    <div class="col-xs-6 ">                
                    <input type="checkbox" name="data[Report][water]" id="ReportWater"/>
                    <label for="ReportWater">Water</label>
                    </div>
                </div>
            </div>    
        </div>
        <div class="row">
            <div class="funkyradio">
                <div class="funkyradio-success">
                    <div class="col-xs-6 ">                    
                        <input type="checkbox" name="data[Report][road_access]" id="ReportRoad_block" />
                        <label for="ReportRoad_block">Road Access</label>
                    </div>
                </div>
                <div class="funkyradio-success">
                    <div class="col-xs-6">                
                    <input type="checkbox" name="data[Report][telecommunication]" id="ReportTelecommunication"/>
                    <label for="ReportTelecommunication">Telecommunication</label>
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
                        <label for="ReportFood">Food</label>
                    </div>
                </div>
                <div class="funkyradio-success">
                    <div class="col-xs-6 ">                
                    <input type="checkbox" name="data[Report][sanitation]" id="ReportSanitation"/>
                    <label for="ReportSanitation">Sanitation</label>
                    </div>
                </div>
            </div>    
        </div>
        <div class="row">
            <div class="funkyradio">
                <div class="funkyradio-success">
                    <div class="col-xs-6 ">                    
                        <input type="checkbox" name="data[Report][first_aid]" id="ReportFirst_aid" />
                        <label for="ReportFirst_aid">First Aid</label>
                    </div>
                </div>
                <div class="funkyradio-success">
                    <div class="col-xs-6">                
                    <input type="checkbox" name="data[Report][shelter]" id="ReportShelter"/>
                    <label for="ReportShelter">Shelter</label>
                    </div>
                </div>
            </div>    
        </div>
        
        <hr/>

        <div class="form-group">
            <label for="ReportComments">Comments:</label>
            <textarea class="form-control" rows="5" name="data[Report][comments]" id="ReportComments"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Next</button>

</div>
<?php echo $this->Form->end(); ?>
