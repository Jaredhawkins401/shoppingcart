<form action='index.php' method='get'>
	<select name='catForm'>
		<?php 
		foreach($categoryList as $cat) { ?>
		
		<option value="<?php echo($cat['category_id']); ?>"> <?php echo($cat['category']); ?> <option>
	</select>
		<input type='Submit' name='action' value='updateCategory'></input>
</form>
		
