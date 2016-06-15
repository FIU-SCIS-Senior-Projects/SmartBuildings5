<div> 
     
<?php
    echo $this->Html->css('blueimp-gallery.min');
    echo $this->Html->css('blueimp-gallery-indicator');
    echo $this->Html->css('report-image');
    
    echo $this->Form->create('ReportImage',array('inputDefaults'=>array('label'=>false),'enctype'=>'multipart/form-data'));
?>
            
     

<h1>Report Images</h1>

<!-- The container for the list of example images -->
<div id="links" >
    
    <?php $cbr=0; foreach ($images as $image): ?>
        <a href="<?php echo FULL_BASE_URL.'/img/Report/img/'.$image['ReportImage']['report_image']?>" title="<?php echo $image['ReportImage']['report_image'] ?>" data-gallery>
            <img src="<?php echo FULL_BASE_URL.'/img/Report/thumbnail/'.$image['ReportImage']['report_image']?>" alt="<?php echo $image['ReportImage']['report_image'] ?>">
        </a>
        
        <?php $cbr=$cbr+1; if($cbr == 6):?>
            <br>
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

<br>
<div>
    <div class="left"><?php echo $this->Form->input('report_image', array('type'=>'file'));?></div>
    <div class="right"><?php echo $this->Form->submit(__('Upload'), array('name' => 'btn')); ?></div>
</div>

<br><br><br>
<div class="r">
    <?php echo $this->Form->submit(__('Complete'),array('name' => 'btn','class'=>'btn btn-primary')); ?>
</div>
    
    
<?php echo $this->Form->end()?>

    <?php 
        echo $this->Html->script('blueimp-helper');
        echo $this->Html->script('blueimp-gallery.min');
        echo $this->Html->script('blueimp-gallery-fullscreen');
        echo $this->Html->script('blueimp-gallery-indicator');
        echo $this->Html->script('jquery.min');
        echo $this->Html->script('jquery.blueimp-gallery.min');
    ?>
</div>


<!--
div class="reportImages form"
    <?php //echo $this->Html->css('blueimp-gallery.min'); ?>
    <?php //echo $this->Html->css('bootstrap-image-gallery.min'); ?>
    <link rel="stylesheet" href="https://github.com/blueimp/Gallery/blob/master/css/blueimp-gallery.min.css">
    <link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery-indicator.css">
<?php //echo $this->Form->create('ReportImage'); ?>
    
    <div id="links" class="links">
        
        <a href="<?php //echo FULL_BASE_URL.'/img/User/yonicel_leyva.jpg'?>" title="Banana" data-gallery>
            <img src="<?php //echo FULL_BASE_URL.'/img/User/yonicel_leyva.jpg'?>" alt="Banana">
        </a>
        <a href="<?php //echo FULL_BASE_URL.'/img/User/yonicel_leyva.jpg'?>" title="Banana" data-gallery>
            <img src="<?php //echo FULL_BASE_URL.'/img/User/yonicel_leyva.jpg'?>" alt="Banana">
        </a>
    </div>
    
   <div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
    
    
    
    
    <?php //echo $this->Html->script('blueimp-gallery.min'); ?>
    <?php //echo $this->Html->script('bootstrap-image-gallery.min'); ?>    
    
    <script src="https://blueimp.github.io/Gallery/js/blueimp-helper.js"></script>
    <script src="https://github.com/blueimp/Gallery/blob/master/js/blueimp-gallery.min.js"></script>
    <script src="https://blueimp.github.io/Gallery/js/blueimp-gallery-fullscreen.js"></script>
    <script src="https://blueimp.github.io/Gallery/js/blueimp-gallery-indicator.js"></script>
    <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.js"></script>
    <script src="https://blueimp.github.io/Gallery/js/demo.js"></script>
    
    
    <script>
        document.getElementById('links').onclick = function (event) {
            event = event || window.event;
            var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {index: link, event: event},
                links = this.getElementsByTagName('a');
            blueimp.Gallery(links, options);
        };
    </script>
    
    <?php //echo $this->Form->submit(__('Add'), array('name' => 'btn')); ?>
    
    <?php //echo $this->Form->submit(__('Complete'),array('name' => 'btn')); ?>
<?php //echo $this->Form->end()?>
/div-->
