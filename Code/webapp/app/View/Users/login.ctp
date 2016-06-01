<!DOCTYPE html>
<html lang="en">
  <?php echo $this->Html->css('myStyle'); ?>  
<head>
    <title>Disasters Helper - <?php echo $title_for_layot;?>  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="yabba.css">
  
</head>
<body style="background-color:#B6DCF3;">


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Disasters Helper</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <a href="add">
                                <button type="button" class="btn btn-primary">Register</button>
				
		  </a>
           <a href="register.html">
				<button type="button" class="btn btn">Map</button>
				
		  </a>
      </ul>
    </div>
  </div>
</nav>
   
<div class="users form">
    
    <?php echo $this->fetch('content'); ?> 
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend class='box'>
            
            <div class='hdr'style="background-color:white;"> <?php echo __('Please enter your username and password'); ?></div>
        </legend>
       <div class="hdr2">  <?php echo $this->Form->input('username');    

        echo $this->Form->input('password');
    ?></div>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>
   
      
	<div> 
           
            <?php echo $this->Html->image('picture.jpg', array('width'=>'445px', 'height'=>'445px' )); ?>
   

 </div>	
		 
      
    
	

  
    <div> 
           
            <?php echo $this->Html->image('map.jpg', array('width'=>'1860px', 'height'=>'502px' )); ?>
   

 </div>



</body>
</html>