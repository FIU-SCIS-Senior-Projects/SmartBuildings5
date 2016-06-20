<?php echo $this->Html->css('register'); ?>


 
    <div class="container">
        <div class="panel-heading">
            <div class="panel-title text-center">
                     <h1 class="title">Please enter the e-mail used during registration</h1>
                     
               <hr />      
             </div>
        </div> 
        
        <?php echo $this->Session->flash(); ?>
        
        <div class="card card-container">
            
            
            <?php  echo $this->Form->create('User',array('class'=>'form-horizontal'));?>
            <?php echo $this->Form->create('User', array('action' => 'forgot_password')); ?>

                    
                    <div class="form-group">

                        <?php echo $this->Form->input('email',array('class'=>'form-control'));?>
                    </div>
                    
                        
                                   
                                
                        
 <button class="btn btn-lg btn-primary btn-block btn-register " type="submit">Send New Password</button>
             <?php  echo $this->Form->end();?>
        </div> 
    </div>





