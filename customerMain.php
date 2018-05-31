<?php
?>
<section>
<div>
	<form action="index.php" method="POST" enctype="multipart/form-data">
		<label for='category_id'>Category:</label><select name='category_id'>
		<?php 
		foreach($categoryList as $cat) { ?>
		
		<option value="<?php echo($cat['category_id']); ?>"> <?php echo($cat['category']); } ?> <option>
		</select>
		
		<input type="submit" name="action" value="viewCategory"> </input>
		
	</form>
</div>
</section>

