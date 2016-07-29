<<<<<<< HEAD

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
.topleft {
    position: absolute;
    top: 8px;
    right: 16px;
    font-size: 18px;
}
    
</style>    

<!--<div align="top">
    
   
                  
                  <center>  
=======
<style>
/*header[role="banner"] {
  #logo-main {
    display: block;
    margin: 20px auto;
  }
}

#navbar-primary.navbar-default {
  background: transparent;
  border: none;
  .navbar-nav { 
    width: 100%;
    text-align: center;
    > li {
      display: inline-block;
      float: none;
      > a {
        padding-left: 30px;
        padding-right: 30px;
        }
    }
  }
}*/
</style>   
>>>>>>> f082fbc053e8b6e0adc667d892d36addbbc9b878

 
                      
                      <br>
                      <h2> <font color="white">
                       Disaster Reconnaissance Assessment Mapping Application 
                       </font>
                   </h2>
                  
                
                      </center>
                  
                
               
        

    
    </div>-->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
               
            </button>
            
          <div class="topleft"> <?php echo $this->Html->image("logo.png", array( 'url' => '/home','class'=> 'img-circle' ));?></div>
                <?php // echo $this->Html->image("globe.png", array( 'url' => '/home' ));?>
            
            
            

           

           
        </div>
         <!--Collect the nav links, forms, and other content for toggling--> 
        
        <div class="navbar-collapse collapse">
            
           
            
            <ul class="nav navbar-nav navbar-left"> 
             
                
                <?php if($this->Session->check('Auth.User')):?>
           
               
                    <li>

                        <a href="/reports/add">Create Report</a>

                    </li>
             
           
        <?php endif;?>
                    
            <?php if(!$this->Session->check('Auth.User')):?>
            <li><?php echo $this->Html->link(__('Login'),array('controller'=>'users','action'=>'login'))?></li>
            <?php else: ?>
            
<!--            <li >
              <a href="#" ><?php // echo $this->Session->read('Auth.User.first_name').', '. $this->Session->read('Auth.User.last_name');?> <b class="caret"></b></a>
            -->
                 <li>
                    <?php echo $this->Html->link(__('Profile'),array('controller'=>'users','action'=>'profile'))?>
                 </li>
                 
                 
   
          <!--Only allow evaluator user to view the evaluation section-->

    <?php if($this->Session->read('Auth.User.role_id') == 3):?> 

          <li>
                    <?php // echo $this->Html->link(__('Add Evaluator'),array('controller'=>'users','action'=>'add_evaluator'))?>
                 </li>
           <?php endif;?>
                 
                 <li>
                    <?php echo $this->Html->link(__('Logout'),array('controller'=>'users','action'=>'logout'))?>
                 </li>
                 
             
            </li>
            <?php endif;?>
           <li ><a   href="/Users/about">About</a>
                    </li> 
          </ul>
            
            
      </div>

      </div>
   
</div>

<!--<header role="banner">
  <img id="logo-main" src="http://webapp/img/logos.png" width="200" alt="Logo Thing main logo">
<nav id="navbar-primary" class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
     Brand and toggle get grouped for better mobile display 
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-primary-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-primary-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link</a></li>
        <li class="active"><a href="#">Link</a></li>
        <li class="active"><a href="#">Link</a></li>
        <li class="active"><a href="#">Link</a></li>
        <li class="active"><a href="#">Link</a></li>
      </ul>
    </div> /.navbar-collapse 
  </div> /.container-fluid 
</nav>
</header> header role="banner" -->