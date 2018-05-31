<?php 

function addToOrders($customer_id, $tax){
	global $db;
	$sql = "INSERT INTO orders(customer_id, tax, order_date, ship_date) VALUES(:customer_id, :tax, NOW(), NOW())";
	
	$statement = $db->prepare($sql);
	$statement->bindParam(':customer_id', $customer_id[0]["customer_id"]);
	$statement->bindParam(':tax', $tax);
	$statement->execute();
	$order_id = $db->lastInsertId();
	
	return $order_id;
	
}

function returnOrder($customer_id) {
	$sql = "SELECT * FROM orders WHERE customer_id = :customer_id";
	$statement = $db ->prepare($sql);
	$statement->bindParam(':customer_id', $customer_id[0]['customer_id']);
	$statement->execute();
	$result = $statement->fetchAll();
	
	return $result;
	
}

function returnAllOrders() {
	$sql = "SELECT * FROM orders";
	$statement = $db ->prepare($sql);
	$statement->execute();
	$result = $statement->fetchAll();
	
	return $result;
	
}

function addOrderItems($order_id, $product_id, $price, $quantity){
global $db;
	$sql = "INSERT INTO orderitems(order_id, product_id, price_paid, quantity) VALUES(:order_id, :product_id, :price_paid, :quantity)";
	
	$statement = $db->prepare($sql);
	$statement->bindParam(':order_id', $order_id);
	$statement->bindParam(':product_id', $product_id);
	$statement->bindParam(':price_paid', $price);
	$statement->bindParam(':quantity', $quantity);
	$statement->execute();
	
}

function returnOrderItems($order_id){
	global $db;
	
$sql = "SELECT * FROM orderitems WHERE order_id = :order_id";
$statement = $db ->prepare($sql);
$statement->bindParam(':order_id', $order_id);
$statement->execute();
$results = $statement->fetchAll();
return $results;
	
}

?>