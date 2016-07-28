
<!--
<div class="logo"></div>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">DRAMA</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li> 
      <li><a href="#">Page 3</a></li> 
     
    </ul>
  </div>
</nav>-->
<style>
  .active {
    background-color: #1E90FF;
}  
    
</style>    


<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
               
            </button>
            
           
                <?php echo $this->Html->image("globe.png", array( 'url' => '/home' ));?>
            
            

           

           
        </div>
<!--         Collect the nav links, forms, and other content for toggling -->
        
        <div class="navbar-collapse collapse">
            
            
            
            
            <ul class="nav navbar-nav navbar-right"> 
              <li style="float:right">  
               
         </li>
                <?php if($this->Session->check('Auth.User')):?>
           
               
                    <li>
                        <a href="/reports/add">Create Report</a>
                    </li>
             
           
        <?php endif;?>
                    
            <?php if(!$this->Session->check('Auth.User')):?>
            <li><?php echo $this->Html->link(__('Login'),array('controller'=>'users','action'=>'login'))?></li>
            <?php else: ?>
            
<!--            <li >
              <a href="#" ><?php echo $this->Session->read('Auth.User.first_name').', '. $this->Session->read('Auth.User.last_name');?> <b class="caret"></b></a>-->
            
                 <li>
                    <?php echo $this->Html->link(__('Profile'),array('controller'=>'users','action'=>'profile'))?>
                 </li>
                 
                 
   
          <!--Only allow evaluator user to view the evaluation section-->
    //<?php if($this->Session->read('Auth.User.role_id') == 1):?> 
          <li>
                    //<?php echo $this->Html->link(__('Add Evaluator'),array('controller'=>'users','action'=>'add_evaluator'))?>
                 </li>
           //<?php endif;?>
                 
                 <li>
                    <?php echo $this->Html->link(__('Logout'),array('controller'=>'users','action'=>'logout'))?>
                 </li>
                 
             
<!--            </li>-->
            <?php endif;?>
           <li ><a  class="active" href="/Users/about">About</a>
                    </li> 
          </ul>
      </div>

      </div>
   
</div>
