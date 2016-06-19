<?php  echo $this->Html->css('register'); ?>

<div class="container">
        <div class="panel-heading">
            <div class="panel-title text-center">
                     <h1 class="title">Please enter the new password</h1>
                     
               <hr />      
             </div>
        </div> 


<div class="forgot_password form">

 

<div class="card card-container">
 <?php  echo $this->Form->create('User',array('class'=>'form-horizontal',));?>
    
                    <div class="form-group">
                        <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                        <?php echo $this->Form->input('password',array('class'=>'form-control'));?>
                    </div>
                    <div class="form-group">

                        <?php echo $this->Form->input('password_repeat',array('class'=>'form-control','type' => 'Password'));?>
                    </div>
    


 <button class="btn btn-lg btn-primary btn-block btn-register" type="submit">Reset</button>
 
<?php echo $this->Form->end();?>
</div>
</div>
    </div>

