
<section>
<div>
	<form action="index.php" method="GET">
		<select name='category_id'>
		<?php 
		foreach($categoryList as $cat) { ?>
		
		<option value="<?php echo($cat['category_id']); ?>"> <?php echo($cat['category']); }?> <option>
		</select>
		<input type="submit" name="action" value="updateCategory"></input>
		<input type="submit" name="action" value="deleteCategory"></input>
		<input type="submit" name="action" value="viewCategory"></input>
		
	</form>
	
</div>
</section>

<section>
<div>
	<form action="index.php" method="POST">
		<label for='category'>Category Name: </label> 
		<?php

		if($action == "updateCategory"){
		echo"<input type='text' name='category' id='category' value='" . $cat['category'] . "'/>"; 
		echo"<input id='category_idU' name='category_idU' type='hidden' value='" . $cat['category_id'] . "'/>";
		echo '<input type="submit" name="action" value="update"> </input>'; 
		}
		else{
		echo"<input type='text' name='category' id='category'/>";
		echo '<input type="submit" name="action" value="addCategory"> </input>';
		} ?>
	</form>	
<div>
</section>

<section>
<div>
	<form action="index.php" method="POST" enctype="multipart/form-data">
		<label for='category_id' class="control-label">Category:</label><select class="form-control" name='category_id'>
		<?php 
		foreach($categoryList as $cat) { ?>
		
		<option  value="<?php echo($cat['category_id']); ?>"> <?php echo($cat['category']); } ?> <option>
		</select>
		
		<label for='product' class="control-label">Product: </label> <input class="form-control" type='text' name='product' id='product'/>
		<label for='price' class="control-label">Price: </label> <input class="form-control" type='text' name='price' id='price'/>
		<label for='image' class="control-label">Image: </label> <input class="form-control" type='file' name='image' id='image'/>
		
		<input type='submit' name='action' value='addProduct'/>
		
	</form>
</div>
</section>

<section>
<div>
	<?php
	if($action == "viewCategory") {
		$table = "<table class='table'>\n";  
		$table .= "<tbody>";
		$table .= "<tr>" . "<th>" . "<b>" ."Product ID" . "</th>";//create table categories
		$table .= "<th>" . "<b>" ."Product Name" . "</th>";
		$table .= "<th>" . "<b>" ."Price" . "</th>";
		$table .= "<th>" . "<b>" ."Image" . "</th>";
		$table .= "</tr>";
		
		foreach($productList as $product) 
		{
			$table .= "\t<tr>";
			$table .= "<td>" . $product['product'] . "</td>";
			$table .= "<td>" . $product['product_id'] . "</td>";
			$table .= "<td>" . $product['price'] . "</td>";
			$table .= "<td>" . '<img height="75px" src=images/' . $product['image'] . '>' . '</img>' . "</td>";//make table with all the values
			$table .= "<td> <a href='index.php?product_id=" . $product['product_id'] . "&action=updateProduct'>" . "Update" . "</a> </td>";
			$table .= "<td> <a href='index.php?product_id=" . $product['product_id'] . "&action=deleteProduct'>" . "Delete" . "</a> </td>";			
			$table .= "\t</tr>\n";
		}
		echo $table;
	}
	?>
</div>
</section>