
<div class="row">
    <div class="col-lg-7 col-lg-offset-3">

          <h2>Profile</h2>

          <div class="well">                   
              <?php echo $this->Form->create('User',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false),'enctype'=>'multipart/form-data'));?>
                    
                        <style >
                            .center {
                                margin: auto;
                                width: 50%;
                                padding: 10px;
                            }
                        </style>
                  
                        <?php if(!empty($image['User']['profile_image'])) {                               
                            echo 
                                
                                '<div class="center">
                                    <div class="container">                                            
                                        <img src="'.FULL_BASE_URL.'/img/User/'.$image['User']['profile_image'].'" class="img-rounded" > 
                                    </div>
                                </div>';
                        }?>
                    <center>
                        <div class="form-group">
                          <label for="profile_image" class="col-sm-2 control-label">Image</label>
                          <div class="col-sm-10">
                            <?php echo $this->Form->input('profile_image', array('type'=>'file'));?>
                          </div>
                        </div>
                    </center>
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
                    <div class="form-group">
                        <label for="company" class="col-sm-2 control-label">Company</label>
                        <div class="col-sm-10">
                              <?php echo $this->Form->input('company',array('class'=>'form-control','readonly' => 'readonly'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position" class="col-sm-2 control-label">Position</label>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('position',array('class'=>'form-control','readonly' => 'readonly'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_url" class="col-sm-2 control-label">Company Url</label>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('company_url',array('class'=>'form-control','readonly' => 'readonly'));?>
                        </div>
                    </div> 
                        
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <?php echo $this->Form->submit('Save',array('class'=>'btn btn-primary'))?>
                        </div>
                    </div>
                    
              <?php echo $this->Form->end();?>
          </div>
    </div>
</div>
