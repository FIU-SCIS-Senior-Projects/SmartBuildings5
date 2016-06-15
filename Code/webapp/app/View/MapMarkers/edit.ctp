<div class="mapMarkers form">
<?php echo $this->Form->create('MapMarker'); ?>
	<fieldset>
		<legend><?php echo __('Edit Map Marker'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('latitude');
		echo $this->Form->input('longitude');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MapMarker.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MapMarker.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Map Markers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Reports'), array('controller' => 'reports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reports'), array('controller' => 'reports', 'action' => 'add')); ?> </li>
	</ul>
</div>
