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

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
               
            </button>
            
           
                <?php echo $this->Html->image("globe.png", array( 'url' => '/home' ));?>
            
            

           

           
        </div>
         <!--Collect the nav links, forms, and other content for toggling--> 
        
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
              <a href="#" ><?php // echo $this->Session->read('Auth.User.first_name').', '. $this->Session->read('Auth.User.last_name');?> <b class="caret"></b></a>
            -->
                 <li>
                    <?php echo $this->Html->link(__('Profile'),array('controller'=>'users','action'=>'profile'))?>
                 </li>
                 
                 
   
          <!--Only allow evaluator user to view the evaluation section-->
    <?php if($this->Session->read('Auth.User.role_id') == 1):?> 
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