<div class="mapMarkers view">
<h2><?php echo __('Map Marker'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mapMarker['MapMarker']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latitude'); ?></dt>
		<dd>
			<?php echo h($mapMarker['MapMarker']['latitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Longitude'); ?></dt>
		<dd>
			<?php echo h($mapMarker['MapMarker']['longitude']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Map Marker'), array('action' => 'edit', $mapMarker['MapMarker']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Map Marker'), array('action' => 'delete', $mapMarker['MapMarker']['id']), null, __('Are you sure you want to delete # %s?', $mapMarker['MapMarker']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Map Markers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Map Marker'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reports'), array('controller' => 'reports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reports'), array('controller' => 'reports', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Reports'); ?></h3>
	<?php if (!empty($mapMarker['reports'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $mapMarker['reports']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
	<?php echo $mapMarker['reports']['user_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Building Condition Id'); ?></dt>
		<dd>
	<?php echo $mapMarker['reports']['building_condition_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Electricity'); ?></dt>
		<dd>
	<?php echo $mapMarker['reports']['electricity']; ?>
&nbsp;</dd>
		<dt><?php echo __('Water'); ?></dt>
		<dd>
	<?php echo $mapMarker['reports']['water']; ?>
&nbsp;</dd>
		<dt><?php echo __('Road Block'); ?></dt>
		<dd>
	<?php echo $mapMarker['reports']['road_block']; ?>
&nbsp;</dd>
		<dt><?php echo __('Telecommunication'); ?></dt>
		<dd>
	<?php echo $mapMarker['reports']['telecommunication']; ?>
&nbsp;</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
	<?php echo $mapMarker['reports']['comments']; ?>
&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
	<?php echo $mapMarker['reports']['created']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
	<?php echo $mapMarker['reports']['modified']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Reports'), array('controller' => 'reports', 'action' => 'edit', $mapMarker['reports']['id'])); ?></li>
			</ul>
		</div>
	</div>
	