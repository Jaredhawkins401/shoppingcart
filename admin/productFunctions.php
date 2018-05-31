<?php

function addProduct($category_id, $product, $price, $image) {
	global $db;
	var_dump($category_id, $product, $price, $image);
	$sql = "INSERT INTO products (category_id, product, price, image) VALUES (:category_id, :product, :price, :image)";
	$statement = $db->prepare($sql);
	$statement->bindParam(':category_id', $category_id);
	$statement->bindParam(':product', $product);
	$statement->bindParam(':price', $price);
	$statement->bindParam(':image', $image);
	
	$result = $statement->execute();
	if($result == 1) {
		echo "Added Successfully!";
		
	}
	else {
		echo "Insertion Failed";
	}
	
}

function updateProduct($product_id, $category_id, $product, $price, $image) {
	global $db;
	
	$sql = "UPDATE products SET category_id = :category_id, product = :product, price = :price, image = :image WHERE product_id = :product_id";
	
	$statement = $db->prepare($sql);
	$statement->bindParam('product_id', $product_id);
	$statement->bindParam(':category_id', $category_id);
	$statement->bindParam(':product', $product);
	$statement->bindParam(':price', $price);
	$statement->bindParam(':image', $image);
	
	$result = $statement->execute();
    if($result == 1)
    {
        echo "Updated successfully!";
    }
    else
    {
        echo "Update failed";
    }
}

function deleteProduct($product_id) {
	global $db;
	
	$sql = "DELETE FROM products WHERE product_id = :product_id";
	
	$statement = $db->prepare($sql);
	$statement->bindParam('product_id', $product_id);
	
    $result = $statement->execute();
    if($result == 1)
    {
        echo "Deleted successfully!";
    }
    else
    {
        echo "Deletion failed";
	}
	
}


function returnProducts($category_id) {
	global $db;
	
	$sql = "SELECT * from products WHERE category_id = :category_id";
	$statement = $db->prepare($sql);
	$statement->bindParam('category_id', $category_id);
	$statement->execute();
	
	$productList = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	return $productList;
}

function returnOneProduct($product_id) {
	global $db;	
		
	$sql = "SELECT * FROM products WHERE product_id = :product_id";
	$statement = $db->prepare($sql);
	$statement->bindParam(':product_id', $product_id);
	$statement->execute();
	$result = $statement->fetchAll();
	return $result[0];
}
	
?>