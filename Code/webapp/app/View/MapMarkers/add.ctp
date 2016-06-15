<div class="mapMarkers form">
<?php echo $this->Form->create('MapMarker'); ?>
	<fieldset>
		<legend><?php echo __('Add Map Marker'); ?></legend>
	<?php
		echo $this->Form->input('latitude');
		echo $this->Form->input('longitude');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Map Markers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Reports'), array('controller' => 'reports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reports'), array('controller' => 'reports', 'action' => 'add')); ?> </li>
	</ul>
</div>
