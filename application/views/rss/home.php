<?php echo form_open('rss/create'); ?>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>selecionado</th>
			<th>informações</th>
		</tr>
		</thead>
		<tbody>
	
		
<?php foreach ($content as $key => $news_item): ?>
			<tr>
			<td><input id="$key" type="checkbox"></td>
			<td><?php echo $news_item['description'] ?></td>
			</tr>

<?php endforeach; ?>
		</tbody>
	</table>
</form>

	



