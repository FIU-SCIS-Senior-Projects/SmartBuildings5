<font face="Times New Roman"><div class="reports view">
 <?php 
   echo $this->Html->css('reportView'); 
   echo $this->Html->css('blueimp-gallery.min');
    echo $this->Html->css('blueimp-gallery-indicator');
    echo $this->Html->css('report-image-view');
    echo $this->Html->css('register'); ?>

  <div class="container">
        <div class="panel-heading">
            <div class="panel-title text-center">
                   <h1 class="title">View Report</h1>
                     <hr />
             </div>
        </div> 
     
        <?php echo $this->Session->flash(); ?>
      
      
      
      
      
      
     <nav> 
          <h2 class="title text-center ">Life Line Services Conditions: </h2> 
           <div class="card card-container" >
                 
            <strong> <?php echo __('Electricity:')   ?></strong> <?php echo h($report['Report']['electricity']); ?>
			&nbsp;
                        <br>
                <strong> <?php echo __('Water:') ?> </strong> <?php echo h($report['Report']['water']); ?>
			&nbsp;
                         <br>
                <strong>  <?php echo __('Road Access:')  ?>  </strong><?php echo h($report['Report']['road_access']); ?>
			&nbsp;
                         <br>
                <strong>  <?php echo __('Telecommunication:')  ?>  </strong><?php echo h($report['Report']['telecommunication']); ?>
			&nbsp;  
                         <br>
                        
                </div>
          </nav>
          <article>
          <h2 class="title text-center">Emergency Response Needs:</h2> 
           <div class="card card-container">
          <strong> <?php echo __('Food:')  ?> </strong> <?php echo h($report['Report']['food']); ?>
			&nbsp;
                        <br>
               <strong>  <?php echo __('Sanitation:') ?>  </strong><?php echo h($report['Report']['sanitation']); ?>
			&nbsp;
                         <br>
              <strong>    <?php echo __('First Aid:')  ?>  </strong><?php echo h($report['Report']['first_aid']); ?>
			&nbsp;
                         <br>
              <strong>    <?php echo __('Shelter:')  ?>  </strong><?php echo h($report['Report']['shelter']); ?>
			&nbsp;  
                         <br>
          
                </div>
          </article>
          <hr />
          <nav>
          <h2 class="title text-center">Comments:</h2> 
           <div class="card card-container">
               <?php echo h($report['Report']['comments']); ?>
			&nbsp;
                </div>
          <h2 class="title text-center">Date of the Assessment: </h2> 
           <div class="card card-container" >
                 
            <strong> <?php echo __('Date:')   ?></strong> <?php echo h($report['Report']['created']); ?>
          
                    </nav>

          <article>
          <h2 class="title text-center">Pictures:</h2> 
           <div class="card card-container">
               <?php

?>
       
       

<!-- The container for the list of example images -->
<div id="links" >
    
    
        <?php $cbr=0; foreach ($images as $image): ?>
        <a href="<?php echo FULL_BASE_URL.'/img/Report/img/'.$image['ReportImage']['report_image']?>" title="<?php echo $image['ReportImage']['report_image'] ?>" data-gallery>
            <img src="<?php echo FULL_BASE_URL.'/img/Report/thumbnail/'.$image['ReportImage']['report_image']?>" alt="<?php echo $image['ReportImage']['report_image'] ?>">
        </a>
        
        <?php $cbr=$cbr+1; if($cbr == 6):?>
            <!--<br>-->
            <?php $cbr=0; ?>
        <?php endif;?>
    <?php endforeach;?>
        
        
            
</div>
<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->    
</div>

    <style type="text/css">
        div.left, div.right {
            float: left;   
        }  
    </style>

<?php 
        echo $this->Html->script('blueimp-helper');
        echo $this->Html->script('blueimp-gallery.min');
        echo $this->Html->script('blueimp-gallery-fullscreen');
        echo $this->Html->script('blueimp-gallery-indicator');
        echo $this->Html->script('jquery.min');
        echo $this->Html->script('jquery.blueimp-gallery.min');
    ?>


  
</div>
          </article>
            <br>  <br>  <br>  <br>  <br>  <br>
            <hr /> 
     
        
        <!--Only allow logged in user to view the evaluation section-->
<?php if($this->Session->check('Auth.User')):?>    
          <!--Only allow evaluator user to view the evaluation section-->
    <?php if($this->Session->read('Auth.User.role_id') == 2):?> 
          
          
         <div>
                <br>   <br>   <br>    <br>   <br>
          <h2 class="title text-center">Evaluation:</h2> 
           <div class="card card-container">

        </head>
        <body>
        <?php  echo $this->Form->create('Report');?> 

        <?php echo $this->Form->input('id', array('type' => 'hidden')); 

        ?>
         <div class="row">
            <div class="funkyradio">
                <div class="funkyradio-success">
                    <div class="col-xs-10 ">
                        <input type="radio" name="evaluation" id="safe" value="safe" checked/>
                        <label for="safe"> <span class="glyphicon glyphicon-ok-circle"></span>Safe</label>
                    </div>
                    <br><br><br><br>
                </div>

                <div class="funkyradio-warning">
                    <div class="col-xs-10 ">
                    <input type="radio" name="evaluation" id="minor damage" value="minor damage"/>
                    <label for="minor damage"> <span class="glyphicon glyphicon-warning-sign"></span>Minor Damage</label>

                    </div>
                     <br><br><br><br>
                     </div>

                    <div class="funkyradio-danger">
                    <div class="col-xs-10 ">
                    <input type="radio" name="evaluation" id="major damage" value="major damage"/>
                    <label for="major damage"> <span class="glyphicon glyphicon-ban-circle"></span>Major Damage</label>

                    </div>
                         <br><br><br><br>
                        </div>


                <div class="funkyradio-primary">
                    <div class="col-xs-10 ">
                    <input type="radio" name="evaluation" id="insufficient information" value="insufficient information"/>
                    <label for="insufficient information"> <span class="glyphicon glyphicon-question-sign"></span>Insufficient Information </label>
                    </div>

                </div>



           <br><br><br><br>     
        </div>

             <div class="r">
                 <br><br>
            <?php echo $this->Form->submit(__('Evaluate'),array('id'=>'evaluate','name' => 'btn','class'=>'btn btn-primary')); 
                  echo $this->Form->end();
            ?>

        </div>

        </div>
 </div>
            </div>  
          
                  </div> 

        </body>
    <?php endif;?>
<?php endif;?>
        
<?php if($safe!==0 || $minorDamage!==0 || $majorDamage!==0 || $insufficient!==0):?> 
<div> 
    
<hr /> 
          <h2 class="title text-center">Statistics:</h2>
          
          <div class="card card-container">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"> </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
  
      
      function drawChart() {
         // print_r($safe);
         var safe =  <?php echo $safe ?>;
          var minorDamage =  <?php echo $minorDamage ?>;
           var majorDamage =  <?php echo $majorDamage ?>;
            var insufficient =  <?php echo $insufficient ?>;
            
        var data = google.visualization.arrayToDataTable([
            
          ['id', 'Evaluation'],
          ['Unsuffient Information',insufficient],
        ['Major Damage',majorDamage],
          ['Minor Damage',minorDamage],
           ['Safe ',safe]
         
          
        ]);

        var options = {
          backgroundColor: 'transparent',
//          title: '',
          pieHole: 0.4
          //colors: ['#00FF00', '#FFFF00', '#FF0000']
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
 
  <body>
    <div id="donutchart" style="width: 400px; height: 400px;"></div>
  </body>
</div>  
          </div>
<?php endif;?>    
</div> </font>
 







