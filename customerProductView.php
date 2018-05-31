<section>
<div>
<form action="index.php" method="get">
<select style="color:black;" name="category_id">
<option value='All' <?php  echo $category_id == $category['category_id'] ? 'selected = "selected "' : ''?>> All </option>
<?php foreach($categoryDropDown as $category):?>
       <option value='<?php echo($category['category_id']); ?>'<?php  echo $category_id == $category['category_id'] ? 'selected = "selected "' : ''?>> <?php echo($category['category']); ?> </option>
    <?php endforeach; ?> 
	</select>
	<input type="submit" name="action" value="View"> </input>
</form>
</div>
<section>