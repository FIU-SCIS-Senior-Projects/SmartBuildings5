<?php echo $this->Html->css('login'); ?>
<?php // echo $this->Form->create('User',array('inputDefaults'=>array('label'=>false)));?>
<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    
    <?php echo $this->Session->flash(); ?>
    <div class="container">
        <div class="panel-heading">
            <div class="panel-title text-center">
                 <font >     
                <h1 class="title">
                         
                        
                         Login</h1> </font>
                     <hr />
             </div>
        </div>
        <div class="card card-container">

            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" id="UserLoginForm" method="post" action="login">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" name="data[User][email]" id="UserEmail" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" name="data[User][password]" id="UserPassword" class="form-control" placeholder="Password" required>
                
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" id="Login" >Login</button>
                
            </form><!-- /form -->
            <form action="add">
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" id="Register" >Register</button>
            </form>
            
            <a href="forgot_password" class="forgot-password">
                Forgot password?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
<?php // echo $this->Form->end();?>    






<!--<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        ?php echo $this->Session->flash();?
          <h2>Login</h2>

          <div class="well">
              
              <?php // echo $this->Form->create('User',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false)));?>
                    <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <?php // echo $this->Form->input('email',array('class'=>'form-control'));?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                         <?php // echo $this->Form->input('password',array('class'=>'form-control'));?>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <?php // echo $this->Form->submit('Login',array('class'=>'btn btn-primary'))?>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <?php // echo $this->Html->link(__('Register'),array('controller'=>'users','action'=>'add'))?>
                      </div>
                    </div>
              <?php // echo $this->Form->end();?>
          </div>
    </div>
</div>-->