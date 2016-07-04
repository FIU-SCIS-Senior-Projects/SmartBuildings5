<?php echo $this->Html->css('register'); ?>


<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    <div class="container">
        <div class="panel-heading">
            <div class="panel-title text-center">
                     <h1 class="title">Create an Account</h1>
                     <hr />
             </div>
        </div> 
        

        
        <div class="card card-container">
        <?php echo $this->Session->flash(); ?>


            <?php  echo $this->Form->create('User',array('class'=>'form-horizontal',));?>
<!--            <form class="form-register" id="UserAddForm" method="post" action="/users/add">
            <input type="hidden" name="_method" value="POST"/>-->
                    <div class="form-group">
<!--                        <label for="UserFirst_name" class="cols-sm-2 control-label">First Name</label>-->
                        <?php echo $this->Form->input('first_name',array('class'=>'form-control'));?>
                    </div>
                    <div class="form-group">
<!--                        <label for="UserLast_name" class="cols-sm-2 control-label">Your Name</label>
                        <input type="text" name="data[User][last_name]" id="UserLast_name" class="form-control" placeholder="Last Name">-->
                         <?php echo $this->Form->input('last_name',array('class'=>'form-control'));?>
                    </div>
                    <div class="form-group">
<!--                        <label for="UserEmail" class="cols-sm-2 control-label">Email</label>
                        <input type="text" name="data[User][email]" id="UserEmail" class="form-control" placeholder="Email">-->
                        <?php echo $this->Form->input('email',array('class'=>'form-control'));?>
                    </div>
                    <div class="form-group">
<!--                        <label for="UserPassword" class="cols-sm-2 control-label">Password</label>
                        <input type="text" name="data[User][password]" id="UserPassword" class="form-control" placeholder="Password">-->
                        <?php echo $this->Form->input('password',array('class'=>'form-control'));?>
                    </div>
                    <div class="form-group">
<!--                        <label for="UserPassword_repeat" class="cols-sm-2 control-label">Repeat Password</label>
                        <input type="text" name="data[User][password_repeat]" id="UserPassword_repeat" class="form-control" placeholder="Repeat Password">-->
                        <?php echo $this->Form->input('password_repeat',array('class'=>'form-control','type' => 'Password'));?>
                    </div>
                    <div class="form-group">
                        <label>Choose a Role</label>
<!--                        <div class="col-md-4">
                        <div class="col-md-6">-->
                        <?php if(isset($user_role)):?>
                            <?php if($user_role == 'mapper'):?>
                            <div class="row">

                                <div class="funkyradio">
                                    <div class="funkyradio-primary">
                                        <div class="col-xs-6 ">
                                        <input type="radio" name="user_role" id="mapper" value="mapper" checked/>
                                        <label for="mapper">Mapper</label>
                                        </div>                                    
                                    </div>
                                    <div class="funkyradio-primary">
                                        <div class="col-xs-6 ">
                                        <input type="radio" name="user_role" id="evaluator" value="evaluator" />
                                        <label for="evaluator">Evaluator</label>
                                        </div>                                    
                                    </div>
                                </div> 
                            </div>

                            <?php else: ?>
                            <div class="row">
                                <div class="funkyradio">
                                    <div class="funkyradio-primary">
                                        <div class="col-xs-6 ">
                                        <input type="radio" name="user_role" id="mapper" value="mapper" />
                                        <label for="mapper">Mapper</label>
                                        </div>
                                    </div>
                                    <div class="funkyradio-primary">
                                        <div class="col-xs-6 ">
                                        <input type="radio" name="user_role" id="evaluator" value="evaluator" checked/>
                                        <label for="evaluator">Evaluator</label>
                                        </div>
                                    </div>
                                </div>                                
                            </div>

                            <?php endif;?>
                        <?php else: ?>
                        <div class="row">
                            <div class="funkyradio">
                                <div class="funkyradio-primary">
                                    <div class="col-xs-6 ">
                                        <input type="radio" name="user_role" id="mapper" value="mapper" checked/>
                                        <label for="mapper">Mapper</label>
                                    </div>
                                </div>
                                <div class="funkyradio-primary">
                                    <div class="col-xs-6 ">
                                    <input type="radio" name="user_role" id="evaluator" value="evaluator"/>
                                    <label for="evaluator">Evaluator</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                            
<!--                        </div>
                        </div>-->
                    </div>

                    <div class="form-group">
<!--                        <label for="UserPassword_repeat" class="cols-sm-2 control-label">Repeat Password</label>
                        <input type="text" name="data[User][password_repeat]" id="UserPassword_repeat" class="form-control" placeholder="Repeat Password">-->
                        <?php echo $this->Form->input('company',array('class'=>'form-control'));?>
                    </div>
                    <div class="form-group">
<!--                        <label for="UserPassword_repeat" class="cols-sm-2 control-label">Repeat Password</label>
                        <input type="text" name="data[User][password_repeat]" id="UserPassword_repeat" class="form-control" placeholder="Repeat Password">-->
                        <?php echo $this->Form->input('position',array('class'=>'form-control'));?>
                    </div>
                    <div class="form-group">
<!--                        <label for="UserPassword_repeat" class="cols-sm-2 control-label">Repeat Password</label>
                        <input type="text" name="data[User][password_repeat]" id="UserPassword_repeat" class="form-control" placeholder="Repeat Password">-->
                        <?php echo $this->Form->input('company_url',array('class'=>'form-control'));?>
                    </div>

                         
                
                    <button class="btn btn-lg btn-primary btn-block btn-register" type="submit">Register</button>
            <!--</form>-->
             <?php  echo $this->Form->end();?>
        </div> 
    </div>


<!--
<div class="row">
          <div class="col-lg-7 col-lg-offset-3">
             
                <h2>Registration</h2>
           
                <div class="well">                   
                    <?php // echo $this->Form->create('User',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false)));?>
                          <div class="form-group">
                            <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10">
                              <?php // echo $this->Form->input('last_name',array('class'=>'form-control'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="first_name" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10">
                              <?php // echo $this->Form->input('first_name',array('class'=>'form-control'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <?php // echo $this->Form->input('password',array('class'=>'form-control'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="password_repeat" class="col-sm-2 control-label">Repeat-Password</label>
                            <div class="col-sm-10">
                              <?php // echo $this->Form->input('password_repeat',array('class'=>'form-control','type' => 'Password'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                              <?php // echo $this->Form->input('email',array('class'=>'form-control'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="role_id" class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-10">
                              <?php // echo $this->Form->input('role_id',array('class'=>'form-control'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="company" class="col-sm-2 control-label">Company</label>
                            <div class="col-sm-10">
                              <?php // echo $this->Form->input('company',array('class'=>'form-control'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="position" class="col-sm-2 control-label">Position</label>
                            <div class="col-sm-10">
                              <?php // echo $this->Form->input('position',array('class'=>'form-control'));?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="company_url" class="col-sm-2 control-label">Company Url</label>
                            <div class="col-sm-10">
                              <?php // echo $this->Form->input('company_url',array('class'=>'form-control'));?>
                            </div>
                          </div>                   
                          
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <?php // echo $this->Form->submit('Submit',array('class'=>'btn btn-primary'))?>
                            </div>
                          </div>
                    <?php // echo $this->Form->end();?>
                </div>
          </div>
</div>-->
