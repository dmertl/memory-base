<h1>Memory Base</h1>
<fieldset id="dashboard-lists">
	<legend>Lists</legend>
	<ul>
	<?php foreach($categories as $category): ?>
		<li>
			<?php echo $this->Html->link($category['Category']['name'], '/categories/view/' . $category['Category']['id']); ?>
			<ul>
				<?php foreach($category['Item'] as $item): ?>
					<li>
						<?php echo $this->Html->link($item['name'], '/items/view/' . $item['id']); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</li>
	<?php endforeach; ?>
	</ul>
</fieldset>
