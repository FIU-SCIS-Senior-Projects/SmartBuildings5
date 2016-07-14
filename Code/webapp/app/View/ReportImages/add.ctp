<div class="container-fluid"> 
     
<?php
    echo $this->Html->css('blueimp-gallery.min');
    echo $this->Html->css('blueimp-gallery-indicator');
    echo $this->Html->css('report-image');
    
    echo $this->Form->create('ReportImage',array('inputDefaults'=>array('label'=>false),'type' => 'file'));
?>
    <style>
        #divLoading
        {
            display : none;
        }
        #divLoading.show
        {
            display : block;
            position : fixed;
            z-index: 100;
            background-image : url('<?php echo FULL_BASE_URL.'/img/loading.gif'?>');
            background-color: #000000;
            opacity : 0.6;
            background-repeat : no-repeat;
            background-position : center;
            left : 0;
            bottom : 0;
            right : 0;
            top : 0;
        }
        #loadinggif.show
        {
            left : 50%;
            top : 50%;
            position : absolute;
            z-index : 101;
            width : 32px;
            height : 32px;
            margin-left : -16px;
            margin-top : -16px;
        }
        div.content {
            width : 1000px;
            height : 1000px;
        }
    </style>
    <center>
        <div class="panel-heading">
            <!--<div class="panel-title text-center">-->
                     <h1 class="title">Assessment Images</h1> 
                     <!--<hr />-->
             <!--</div>-->
        </div> 
    </center>           

<?php if(!empty($images)): ?>    
<div class="card card-container">
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
<?php endif;?>

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
</div>
<br>
<div class="card card-container-input">
<div>
   <div class="left"><?php echo $this->Form->input('report_image.', array('type'=>'file','multiple'=>true));?></div>
   <div class="right"><?php echo $this->Form->submit(__('Upload'), array('id'=>'upload','name' => 'btn','onclick' =>'startLoading()')); ?></div>
</div>
<br><br><br>
<?php if($this->Session->read('Users.showLocForm')):?>
    <?php echo $this->Form->input('lat',array('placeholder' => 'latitude'));?>
    <?php echo $this->Form->input('lng',array('placeholder' => 'longitude'));?>
<?php endif;?>
</div>
<br><br><br>
<center>
    <div class="r">
        <?php echo $this->Form->submit(__('Complete'),array('id'=>'complete','name' => 'btn','class'=>'btn btn-primary')); ?>
    </div>
</center>   

<div id="divLoading"></div>

<script>
function startLoading() {
    $("div#divLoading").addClass('show');
}
</script>

<br><br><br>

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
