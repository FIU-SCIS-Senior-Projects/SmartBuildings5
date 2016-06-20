<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        Disaster Helper
    </title>
    <?php
        echo $this->Html->meta('icon');
 
        echo $this->Html->css('map');
        //echo $this->Html->css('bootstrap-responsive.min');
 
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
     
    
</head>
<body>
      
    <?php echo $this->element('navigation');?>
   
<!--    <div class="container">
      <?php echo $this->Session->flash(); ?>
 
      <?php echo $this->fetch('content'); ?>
       
      
       
    </div>  /container 
     -->
     
     
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <?php echo $this->Html->script('bootstrap.min'); ?>
</body>
</html>