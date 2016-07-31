<?php
//    echo $this->Html->css('card');
    echo $this->Html->css('report-image');
    echo $this->Html->css('register');
?>
<style>
    
.ev.card-container.card {
    max-width: 800px;
    padding: 40px 60px;
}
    
.card {
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
}

.card {
  margin-top: 10px;
  box-sizing: border-box;
  border-radius: 2px;
  background-clip: padding-box;
}
.card span.card-title {
    color: #fff;
    font-size: 24px;
    font-weight: 300;
    text-transform: uppercase;
}

/*.card .card-image {
  position: relative;
  overflow: hidden;
}
.card .card-image img {
  border-radius: 2px 2px 0 0;
  background-clip: padding-box;
  position: relative;
  z-index: -1;
}
.card .card-image span.card-title {
  position: absolute;
  bottom: 0;
  left: 0;
  padding: 16px;
}*/
.card .card-content {
  padding: 16px;
  border-radius: 0 0 2px 2px;
  background-clip: padding-box;
  box-sizing: border-box;
}
.card .card-content p {
  margin: 0;
  color: inherit;
}
.card .card-content span.card-title {
  line-height: 48px;
}
.card .card-action {
  border-top: 1px solid rgba(160, 160, 160, 0.2);
  padding: 16px;
}
.card .card-action a {
  color: #ffab40;
  margin-right: 16px;
  transition: color 0.3s ease;
  text-transform: uppercase;
}
.card .card-action a:hover {
  color: #ffd8a6;
  text-decoration: none;
}

p{
    text-align: justify;
}

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

</style>
    <?php echo $this->Form->create('User',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false)));?>
    <div class="card card-container ev" >
        <div class="panel-heading">
                <div class="panel-title text-center">
                    <h2 class="title">Review Pending Evaluators</h2>
                    <!--<p><b>D</b>isaster <b>R</b>econnaissance <b>A</b>ssessment <b>M</b>apping <b>A</b>pplication</p>-->                    
                </div>
            </div>
                <div class="row">
                    <!-- Card Projects -->
                    
                <?php $cbr=0; foreach ($this->request->data as $User): ?>
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-content">
                                <h4> <?php echo ucfirst(strtolower($User['User']['first_name']))?> <?php echo ucfirst(strtolower($User['User']['last_name'])) ?> </h4>
                                <!--<small><em>Create a mapper account to use this feature</em></small>-->
                            </div>

                            <div class="card-action">
                                <!--info-->
                                <form class="form-horizontal" role="form">
                                    <div class="form-group">
                                      <label class="col-lg-3 control-label">Company:</label>
                                      <div class="col-lg-8">
                                          <input type="text" class="form-control" value="<?php echo $User['User']['company'] ?>" readonly>
                                        <?php //  echo $this->Form->input('company',array('class'=>'form-control','readonly' => 'readonly'));?>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-lg-3 control-label">Position:</label>
                                      <div class="col-lg-8">
                                          <input type="text" class="form-control" value="<?php echo $User['User']['position'] ?>" readonly>
                                        <?php //  echo $this->Form->input('position',array('class'=>'form-control','readonly' => 'readonly'));?>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-lg-3 control-label">Company Url:</label>
                                      <div class="col-lg-8">
                                          <input type="text" class="form-control" value="<?php echo $User['User']['company_url'] ?>" readonly>
                                        <?php //  echo $this->Form->input('company_url',array('class'=>'form-control','readonly' => 'readonly'));?>
                                      </div>
                                    </div>
                                  </form>
                                <!--info-->                                
                                <div class="row">
                                    <div class="funkyradio">
                                        <div class="funkyradio-success">
                                            <div class="col-xs-6 ">
                                                <input type="radio" name="<?php echo $User['User']['id'] ?>" id="<?php echo $User['User']['id'].'_approved'?>" value="approved" checked/>
                                                <label for="<?php echo $User['User']['id'].'_approved'?>">Approved</label>
                                            </div>
                                        </div>
                                        <div class="funkyradio-danger">
                                            <div class="col-xs-6 ">
                                            <input type="radio" name="<?php echo $User['User']['id'] ?>" id="<?php echo $User['User']['id'].'_decline'?>" value="decline"/>
                                            <label for="<?php echo $User['User']['id'].'_decline'?>">Decline</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div> <!-- Card Projects -->
                <?php endforeach;?>
           </div>
        <br>
        <?php if(!empty($this->request->data)): ?>
            <center>
                <?php echo $this->Form->submit(__('Submit'),array('class'=>'btn btn-success','onclick' =>'startLoading()')); ?>
            </center>
        <?php else: ?>
            <center>
                <h3>No evaluators pending for approval!</h3>
            </center>
        <?php endif ?>
        </div>
 <?php echo $this->Form->end();?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<div id="divLoading"></div>
</div>
<script>
function startLoading() {
    $("div#divLoading").addClass('show');
}
</script>
