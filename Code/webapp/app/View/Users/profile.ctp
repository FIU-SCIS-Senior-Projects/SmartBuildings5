<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Profile'); ?></legend>
	<?php
		echo $this->Form->input('last_name',array('disabled' => 'disabled'));
		echo $this->Form->input('first_name');
		echo $this->Form->input('username');
                echo $this->Form->create('Document', array('type' => 'file'));
                echo $this->Form->file('Document.submittedfile');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>