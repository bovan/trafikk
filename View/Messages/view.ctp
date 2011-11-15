<div class="messages view">
<h2><?php  echo __('Message');?></h2>
	<dl>
		<dt><?php echo __('Heading'); ?></dt>
		<dd>
			<?php echo h($message['Message']['heading']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MessageType'); ?></dt>
		<dd>
			<?php echo h($message['Message']['messageType']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ingress'); ?></dt>
		<dd>
			<?php echo h($message['Message']['ingress']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Messagenumber'); ?></dt>
		<dd>
			<?php echo h($message['Message']['messagenumber']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Version'); ?></dt>
		<dd>
			<?php echo h($message['Message']['version']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('RoadType'); ?></dt>
		<dd>
			<?php echo h($message['Message']['roadType']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('RoadNumber'); ?></dt>
		<dd>
			<?php echo h($message['Message']['roadNumber']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ValidFrom'); ?></dt>
		<dd>
			<?php echo h($message['Message']['validFrom']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latitude'); ?></dt>
		<dd>
			<?php echo h($message['Message']['latitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Longitude'); ?></dt>
		<dd>
			<?php echo h($message['Message']['longitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($message['Message']['id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Message'), array('action' => 'edit', $message['Message']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Message'), array('action' => 'delete', $message['Message']['id']), null, __('Are you sure you want to delete # %s?', $message['Message']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Messages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message'), array('action' => 'add')); ?> </li>
	</ul>
</div>
