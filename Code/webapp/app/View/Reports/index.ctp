<div class="reports index">
	<h2><?php echo __('Reports'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('building_condition_id'); ?></th>
			<th><?php echo $this->Paginator->sort('electricity'); ?></th>
			<th><?php echo $this->Paginator->sort('water'); ?></th>
			<th><?php echo $this->Paginator->sort('road_block'); ?></th>
			<th><?php echo $this->Paginator->sort('telecommunication'); ?></th>
			<th><?php echo $this->Paginator->sort('comments'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($reports as $report): ?>
	<tr>
		<td><?php echo h($report['Report']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($report['User']['id'], array('controller' => 'users', 'action' => 'view', $report['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($report['BuildingCondition']['id'], array('controller' => 'building_conditions', 'action' => 'view', $report['BuildingCondition']['id'])); ?>
		</td>
		<td><?php echo h($report['Report']['electricity']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['water']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['road_block']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['telecommunication']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['comments']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['created']); ?>&nbsp;</td>
		<td><?php echo h($report['Report']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $report['Report']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $report['Report']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $report['Report']['id']), null, __('Are you sure you want to delete # %s?', $report['Report']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Report'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Building Conditions'), array('controller' => 'building_conditions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building Condition'), array('controller' => 'building_conditions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Report Images'), array('controller' => 'report_images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report Image'), array('controller' => 'report_images', 'action' => 'add')); ?> </li>
	</ul>
</div>
