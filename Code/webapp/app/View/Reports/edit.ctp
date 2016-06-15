<div class="reports form">
<?php echo $this->Form->create('Report'); ?>
	<fieldset>
		<legend><?php echo __('Edit Report'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('building_condition_id');
		echo $this->Form->input('electricity');
		echo $this->Form->input('water');
		echo $this->Form->input('road_block');
		echo $this->Form->input('telecommunication');
		echo $this->Form->input('comments');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Report.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Report.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Reports'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Building Conditions'), array('controller' => 'building_conditions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building Condition'), array('controller' => 'building_conditions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Report Images'), array('controller' => 'report_images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report Image'), array('controller' => 'report_images', 'action' => 'add')); ?> </li>
	</ul>
</div>
