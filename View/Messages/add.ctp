<div class="messages form">
<?php echo $this->Form->create('Message');?>
	<fieldset>
		<legend><?php echo __('Add Message'); ?></legend>
	<?php
		echo $this->Form->input('heading');
		echo $this->Form->input('messageType');
		echo $this->Form->input('ingress');
		echo $this->Form->input('messagenumber');
		echo $this->Form->input('version');
		echo $this->Form->input('roadType');
		echo $this->Form->input('roadNumber');
		echo $this->Form->input('validFrom');
		echo $this->Form->input('latitude');
		echo $this->Form->input('longitude');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Messages'), array('action' => 'index'));?></li>
	</ul>
</div>
