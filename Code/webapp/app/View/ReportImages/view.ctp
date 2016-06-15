<div class="reportImages view">
<h2><?php echo __('Report Image'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($reportImage['ReportImage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Report'); ?></dt>
		<dd>
			<?php echo $this->Html->link($reportImage['Report']['id'], array('controller' => 'reports', 'action' => 'view', $reportImage['Report']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Report Image'); ?></dt>
		<dd>
			<?php echo h($reportImage['ReportImage']['report_image']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Report Image'), array('action' => 'edit', $reportImage['ReportImage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Report Image'), array('action' => 'delete', $reportImage['ReportImage']['id']), null, __('Are you sure you want to delete # %s?', $reportImage['ReportImage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Report Images'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report Image'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reports'), array('controller' => 'reports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report'), array('controller' => 'reports', 'action' => 'add')); ?> </li>
	</ul>
</div>
