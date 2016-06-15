<div class="reports view">
<h2><?php echo __('Report'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($report['Report']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($report['User']['id'], array('controller' => 'users', 'action' => 'view', $report['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Building Condition'); ?></dt>
		<dd>
			<?php echo $this->Html->link($report['BuildingCondition']['id'], array('controller' => 'building_conditions', 'action' => 'view', $report['BuildingCondition']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Electricity'); ?></dt>
		<dd>
			<?php echo h($report['Report']['electricity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Water'); ?></dt>
		<dd>
			<?php echo h($report['Report']['water']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Road Block'); ?></dt>
		<dd>
			<?php echo h($report['Report']['road_block']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telecommunication'); ?></dt>
		<dd>
			<?php echo h($report['Report']['telecommunication']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($report['Report']['comments']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($report['Report']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($report['Report']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Report'), array('action' => 'edit', $report['Report']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Report'), array('action' => 'delete', $report['Report']['id']), null, __('Are you sure you want to delete # %s?', $report['Report']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Reports'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Building Conditions'), array('controller' => 'building_conditions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building Condition'), array('controller' => 'building_conditions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Report Images'), array('controller' => 'report_images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report Image'), array('controller' => 'report_images', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Report Images'); ?></h3>
	<?php if (!empty($report['ReportImage'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Report Id'); ?></th>
		<th><?php echo __('Report Image'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($report['ReportImage'] as $reportImage): ?>
		<tr>
			<td><?php echo $reportImage['id']; ?></td>
			<td><?php echo $reportImage['report_id']; ?></td>
			<td><?php echo $reportImage['report_image']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'report_images', 'action' => 'view', $reportImage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'report_images', 'action' => 'edit', $reportImage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'report_images', 'action' => 'delete', $reportImage['id']), null, __('Are you sure you want to delete # %s?', $reportImage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Report Image'), array('controller' => 'report_images', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
