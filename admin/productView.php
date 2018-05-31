<div>
	<h2> Update Product </h2>
		<form action ="index.php" method="post" enctype="multipart/form-data">
		<label class="control-label"> Product Name </label>
		<input class="form-control" type="text" name="productname" value='<?php echo($product["product"]);?>'> </input>
		<label class="control-label"> Price </label>
		<input class="form-control" type="text" name="price" value='<?php echo($product["price"]);?>'> </input>
		<label class="control-label"> Category</label>
		<select class="form-control" style="color:black;" name="category_id">
			<?php foreach($categoryList as $category):?>
				<option value="<?php echo($category['category_id']); ?>" <?php  echo $product['category_id'] == $category['category_id'] ? 'selected = "selected "' : ''?>><?= $category['category']; ?></option>
				<?php endforeach; ?> 
		</select>
	<input type="hidden" name="product_id" value=<?php echo($product["product_id"]) ?>> </input>
	<input type="hidden" name="old_image" value=<?php echo($product["image"]) ?>> </input>
	<label class="control-label"> Image:</label>
	<input type="file" name="image" />
	<button type="submit" name="action" value="updateP">Update</button>

	</form>
</div>