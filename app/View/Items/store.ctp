<?php $this->Html->script('tag-input', array('inline' => false)); ?>
<div class="items form">
	<?php echo $this->Form->create('Item'); ?>
    <fieldset>
        <legend><?php echo __('Add Item'); ?></legend>
		<?php
		echo $this->Form->input('name');
		echo $this->Form->input('category_id');
		echo $this->Form->input('tags');
		echo $this->Form->input('notes');
		?>
    </fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('List Items'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
    </ul>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#ItemTags').tagInput();
	});
</script>