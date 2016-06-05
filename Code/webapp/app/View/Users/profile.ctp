<div class="row">
    <div class="col-lg-7 col-lg-offset-3">

          <h2>Profile</h2>

          <div class="well">
              <?php echo $this->Session->flash(); ?>                    
              <?php echo $this->Form->create('User',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false)));?>
                    <div class="form-group">
                      <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                      <div class="col-sm-10">
                        <?php echo $this->Form->input('last_name', array('class'=>'form-control','readonly' => 'readonly'));?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="first_name" class="col-sm-2 control-label">First Name</label>
                      <div class="col-sm-10">
                        <?php echo $this->Form->input('first_name',array('class'=>'form-control','readonly' => 'readonly'));?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <?php echo $this->Form->input('email',array('class'=>'form-control','readonly' => 'readonly'));?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="role_id" class="col-sm-2 control-label">Role</label>
                      <div class="col-sm-10">
                        <?php echo $this->Form->input('role_id',array('class'=>'form-control','disabled' => 'disabled'));?>
                      </div>
                    </div>
              <?php echo $this->Form->end();?>
          </div>
    </div>
</div>
