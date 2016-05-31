<div class="row">
          <div class="col-lg-7 col-lg-offset-3">
             
                <h2>Registration</h2>
           
                <div class="well">
                    <div class="text-danger"><?php echo $this->Session->flash(); ?></div>                    
                    <?php echo $this->Form->create('User',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false)));?>
                          <div class="form-group">
                            <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10">
                              <?php echo $this->Form->input('last_name',array('class'=>'form-control'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="first_name" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10">
                              <?php echo $this->Form->input('first_name',array('class'=>'form-control'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                              <?php echo $this->Form->input('username',array('class'=>'form-control'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <?php echo $this->Form->input('password',array('class'=>'form-control'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="password_repeat" class="col-sm-2 control-label">Repeat-Password</label>
                            <div class="col-sm-10">
                              <?php echo $this->Form->input('password_repeat',array('class'=>'form-control','type' => 'Password'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                              <?php echo $this->Form->input('email',array('class'=>'form-control'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="role_id" class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-10">
                              <?php echo $this->Form->input('role_id',array('class'=>'form-control'));?>
                            </div>
                          </div>
                    
                          
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <?php echo $this->Form->submit('Submit',array('class'=>'btn btn-primary'))?>
                            </div>
                          </div>
                    <?php echo $this->Form->end();?>
                </div>
          </div>
</div>
