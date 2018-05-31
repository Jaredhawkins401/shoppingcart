<?php

function addCategory($category) {
	global $db;
	
	$sql = "INSERT INTO categories (category) VALUES (:category)";
	$statement = $db->prepare($sql);
	$statement->bindParam(':category', $category);
	$result = $statement->execute();
	
	if($result == 1) {
		echo "Category Added Sucessfully!";
	}
	else {
		echo "Category Insert Failed";
	}

}

function updateCategory($category_id, $category) {
	global $db;
	$sql = "UPDATE categories SET category = :category WHERE category_id = :category_id";
	$statement = $db->prepare($sql);
	$statement->bindParam(':category', $category);
	$statement->bindParam(':category_id', $category_id);
	$result = $statement->execute();
	
	
	if($result == 1) {
		echo "Category Updated Sucessfully!";
	}
	else {
		echo "Category Insert Failed";
	}

}

function returnCategories() {
	global $db;
	
	$sql = "SELECT * FROM categories";
	$statement = $db->prepare($sql);
	$statement->execute();
	
	$categoryList = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	return $categoryList;
	
}


function deleteCategory($category_id) {
	global $db;
	
	$sql = "DELETE FROM categories WHERE category_id = :category_id";
	$statement = $db->prepare($sql);
	$statement->bindParam(':category_id', $category_id);
	$result = $statement->execute();

	if($result == 1) {
		echo "Category Deleted Sucessfully!";
	}
	else {
		echo "Category Deletion Failed";
	}
	
}

function returnCategoryName($category_id) {
	global $db; 
	$sql = "SELECT category FROM categories WHERE category_id = :category_id";
	$statement = $db->prepare($sql);
	$statement->bindParam(':category_id', $category_id);
	$statement->execute();
	$categories = $statement->fetchAll();
	return $categories[0][0];
}
?>