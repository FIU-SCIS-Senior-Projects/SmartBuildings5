<!DOCTYPE html>
<html>
<head>
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <?php echo $this->Html->charset(); ?>
    <title>
        Disaster ReConnect
    </title>
    <?php
    
        echo $this->Html->meta('icon');
        
        //use different bootstrap css for home
        $action_request = $this->params['controller'] . $this->action;
        if($action_request == 'map_markersindex'){
            echo $this->Html->css('bootstrap.min');
        }else{
            echo $this->Html->css('bootstrap.min');
        }
        
        
 
        
 
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
     
    <style>
        body {
          padding-top: 80px;
        }
    </style>
</head>
<body>
      
    <?php echo $this->element('top_navigation');?>
    
    <?php
//    //use different bootstrap css for home
//        $action_request = $this->params['controller'] . $this->action;
//        if($action_request == 'mapmarkersindex'){
//            echo $this->element('side_navigation');
//        }else{
//        }
//    ?>
   <?php if($action_request == 'map_markersindex'):?>
    
          <?php echo $this->Session->flash(); ?>

          <?php echo $this->fetch('content'); ?>
    
    <?php else:?>
        
        <div class="container">
            
          <?php echo $this->Session->flash(); ?>

          <?php echo $this->fetch('content'); ?>

        </div> <!-- /container -->
    
    <?php endif?>
     
     
     
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php echo $this->Html->script('jquery.min'); ?>
    <?php echo $this->Html->script('bootstrap.min'); ?>
</body>
</html>
