<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Registration'); ?></legend>
	<?php
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
                echo $this->Form->input('password_repeat',array('label' => __('Repeat-Password'),'type' => 'Password'));
                echo $this->Form->input('email');
                echo $this->Form->input('role_id');                
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
