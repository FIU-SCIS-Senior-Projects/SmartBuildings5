<?php echo $this->Html->css('profile'); ?>  

<div class="container" >
  <h1 class="page-header">Edit Profile</h1>
  <div class="row">
    <?php echo $this->Form->create('User',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false),'enctype'=>'multipart/form-data'));?>
    <!-- left column -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">
          <?php if(!empty($image['User']['profile_image'])):?>
             <img src="<?php echo FULL_BASE_URL.'/img/User/'.$image['User']['profile_image']?>" class="avatar img-circle img-thumbnail" alt="avatar" >
          <?php endif;?>        
        <h6>Upload a different photo...</h6>
        <?php echo $this->Form->input('profile_image', array('class'=>'text-center center-block well well-sm','type'=>'file'));?>
      </div>
    </div>
            
    <!-- edit form column -->
    <!--<div class="card card-container">-->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
      <?php echo $this->Session->flash(); ?>
      <h3>Personal info</h3>
      <form class="form-horizontal" role="form">
        <div class="form-group">
          <label class="col-lg-3 control-label">First name:</label>
          <div class="col-lg-8">
            <?php echo $this->Form->input('first_name', array('class'=>'form-control'));?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Last name:</label>
          <div class="col-lg-8">
            <?php echo $this->Form->input('last_name', array('class'=>'form-control'));?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Email:</label>
          <div class="col-lg-8">
            <?php  echo $this->Form->input('email',array('class'=>'form-control','disabled' => 'disabled'));?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Role:</label>
          <div class="col-lg-8">
            <?php  echo $this->Form->input('role_id',array('class'=>'form-control','disabled' => 'disabled'));?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Company:</label>
          <div class="col-lg-8">
            <?php  echo $this->Form->input('company',array('class'=>'form-control'));?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Position:</label>
          <div class="col-lg-8">
            <?php  echo $this->Form->input('position',array('class'=>'form-control'));?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Company Url:</label>
          <div class="col-lg-8">
            <?php  echo $this->Form->input('company_url',array('class'=>'form-control'));?>
          </div>
        </div>
<!--        <div class="form-group">
          <label class="col-md-3 control-label">Password:</label>
          <div class="col-md-8">
            <?php //  echo $this->Form->input('password',array('class'=>'form-control'));?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Confirm password:</label>
          <div class="col-md-8">
            <?php //  echo $this->Form->input('password_repeat',array('class'=>'form-control'));?>
          </div>
        </div>-->
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
            <?php echo $this->Form->submit('Save',array('class'=>'btn btn-success'))?>
          </div>
        </div>
      </form>
    </div>
  <!--</div>-->
    <?php echo $this->Form->end();?>
  </div>
</div>






<!--
<div class="row">
    <div class="col-lg-7 col-lg-offset-3">

          <h2>Profile</h2>

          <div class="well">                   
              <?php // echo $this->Form->create('User',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false),'enctype'=>'multipart/form-data'));?>
                    
                        <style >
                            .center {
                                margin: auto;
                                width: 50%;
                                padding: 10px;
                            }
                        </style>
                  
                        <?php // if(!empty($image['User']['profile_image'])) {                               
//                            echo 
                                
//                                '<div class="center">
//                                    <div class="container">                                            
//                                        <img src="'.FULL_BASE_URL.'/img/User/'.$image['User']['profile_image'].'" class="img-rounded" > 
//                                    </div>
//                                </div>';
//                        }?>
                    <center>
                        <div class="form-group">
                          <label for="profile_image" class="col-sm-2 control-label">Image</label>
                          <div class="col-sm-10">
                            <?php // echo $this->Form->input('profile_image', array('type'=>'file'));?>
                          </div>
                        </div>
                    </center>
                    <div class="form-group">
                      <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                      <div class="col-sm-10">
                        <?php // echo $this->Form->input('last_name', array('class'=>'form-control','readonly' => 'readonly'));?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="first_name" class="col-sm-2 control-label">First Name</label>
                      <div class="col-sm-10">
                        <?php // echo $this->Form->input('first_name',array('class'=>'form-control','readonly' => 'readonly'));?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <?php // echo $this->Form->input('email',array('class'=>'form-control','readonly' => 'readonly'));?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="role_id" class="col-sm-2 control-label">Role</label>
                      <div class="col-sm-10">
                        <?php // echo $this->Form->input('role_id',array('class'=>'form-control','disabled' => 'disabled'));?>
                      </div>
                    </div>                 
                    <div class="form-group">
                        <label for="company" class="col-sm-2 control-label">Company</label>
                        <div class="col-sm-10">
                              <?php // echo $this->Form->input('company',array('class'=>'form-control','readonly' => 'readonly'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position" class="col-sm-2 control-label">Position</label>
                        <div class="col-sm-10">
                            <?php // echo $this->Form->input('position',array('class'=>'form-control','readonly' => 'readonly'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_url" class="col-sm-2 control-label">Company Url</label>
                        <div class="col-sm-10">
                            <?php // echo $this->Form->input('company_url',array('class'=>'form-control','readonly' => 'readonly'));?>
                        </div>
                    </div> 
                        
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <?php // echo $this->Form->submit('Save',array('class'=>'btn btn-primary'))?>
                        </div>
                    </div>
                    
              <?php // echo $this->Form->end();?>
          </div>
    </div>
</div>-->
