<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <?php echo $this->Html->image("globe.png", array( 'url' => '/home' ));?>

            <!--<button type="button" class="btn btn-primary-outline" >Create Report</button>-->

            <?php //echo $this->Html->link(__('Create Report'),array('controller'=>'reports','action'=>'add'))?>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <?php if($this->Session->check('Auth.User')):?>
            <div>
                <ul class="nav navbar-nav">
                    <li>
                        <a></a>
                    </li>
                    <li>
                        <a href="/reports/add">Create Assessment</a>
                    </li>
                </ul>
            </div>
        <?php endif;?>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php if(!$this->Session->check('Auth.User')):?>
            <li><?php echo $this->Html->link(__('Login'),array('controller'=>'users','action'=>'login'))?></li>
            <?php else: ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->Session->read('Auth.User.first_name').', '. $this->Session->read('Auth.User.last_name');?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                 <li>
                    <?php echo $this->Html->link(__('Profile'),array('controller'=>'users','action'=>'profile'))?>
                 </li>
                 <li>
                    <?php echo $this->Html->link(__('Logout'),array('controller'=>'users','action'=>'logout'))?>
                 </li>
              </ul>
            </li>
            <?php endif;?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
</div>