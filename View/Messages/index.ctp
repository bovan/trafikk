<div class="messages index">
	<h2><?php echo __('Messages');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('heading');?></th>
			<th><?php echo $this->Paginator->sort('messageType');?></th>
			<th><?php echo $this->Paginator->sort('ingress');?></th>
			<th><?php echo $this->Paginator->sort('messagenumber');?></th>
			<th><?php echo $this->Paginator->sort('version');?></th>
			<th><?php echo $this->Paginator->sort('roadType');?></th>
			<th><?php echo $this->Paginator->sort('roadNumber');?></th>
			<th><?php echo $this->Paginator->sort('validFrom');?></th>
			<th><?php echo $this->Paginator->sort('latitude');?></th>
			<th><?php echo $this->Paginator->sort('longitude');?></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($messages as $message): ?>
	<tr>
		<td><?php echo h($message['Message']['heading']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['messageType']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['ingress']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['messagenumber']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['version']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['roadType']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['roadNumber']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['validFrom']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['latitude']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['longitude']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $message['Message']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $message['Message']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $message['Message']['id']), null, __('Are you sure you want to delete # %s?', $message['Message']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Message'), array('action' => 'add')); ?></li>
	</ul>
</div>
