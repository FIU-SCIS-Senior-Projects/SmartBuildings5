<?php echo $this->Html->css('report'); ?>

<?php echo $this->Form->create('Report', array('inputDefaults' => array('label' => false))); ?>


<div class="col-lg-12 col-lg-offset-3">
    <h2>Create Report</h2>

    <div class="col-md-4">

        <div class="col-md-6">
            <div class="funkyradio">
                <div class="funkyradio-success">
                    <input type="checkbox" name="data[Report][electricity]" id="ReportElectricity" />
                    <label for="ReportElectricity">Electricity</label>
                </div>
                <div class="funkyradio-success">
                    <input type="checkbox" name="data[Report][water]" id="ReportWater"/>
                    <label for="ReportWater">Water</label>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="funkyradio">
                <div class="funkyradio-success">
                    <input type="checkbox" name="data[Report][road_block]" id="ReportRoad_block" />
                    <label for="ReportRoad_block">Road Block</label>
                </div>
                <div class="funkyradio-success">
                    <input type="checkbox" name="data[Report][telecommunication]" id="ReportTelecommunication"/>
                    <label for="ReportTelecommunication">Media</label>
                </div>

            </div>
        </div>

        <h1>h</h1>

        <div class="form-group">
            <label for="ReportComments">Comments:</label>
            <textarea class="form-control" rows="5" name="data[Report][comments]" id="ReportComments"></textarea>
        </div>

        <h1></h1>
        <button type="submit" class="btn btn-primary">Next</button>
    </div>

    <!--                <div class="well">                   
    <?php //echo $this->Form->create('Report',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false)));?>
                           
                            <div class="form-group">
                                <label for="electricity" class="col-sm-1 control-label">electricity</label>
                                <div class="col-sm-10">
    <?php // echo $this->Form->input('electricity',array('class'=>'form-control'));?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="water" class="col-sm-2 control-label">water</label>
                                <div class="col-sm-10">
    <?php // echo $this->Form->input('water',array('class'=>'form-control'));?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="road_block" class="col-sm-2 control-label">road_block</label>
                                <div class="col-sm-10">
    <?php // echo $this->Form->input('road_block',array('class'=>'form-control'));?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="telecommunication" class="col-sm-2 control-label">telecommunication</label>
                                <div class="col-sm-10">
    <?php // echo $this->Form->input('telecommunication',array('class'=>'form-control'));?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="comments" class="col-sm-2 control-label">comments</label>
                                <div class="col-sm-10">
    <?php // echo $this->Form->input('comments',array('class'=>'form-control','type' => 'textarea'));?>
                                </div>
                              </div>
                    </div>-->
</div>
<?php echo $this->Form->end(); ?>
