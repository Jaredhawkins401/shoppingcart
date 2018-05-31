<?php

function uniqueEmail($email) {
	global $db;
	
	$sql = "SELECT * from users WHERE email = :email";;
	$statement = $db->prepare($sql);
	$statement->bindParam(':email', $email);
	$statement->execute();
	$result = $statement->fetchAll();
	return $result;
}

function addUser($email, $password) {
	global $db;
	$sql = "INSERT INTO users (user_id, email, password, created) VALUES (NULL, :email, :password, NOW())";
	$statement = $db->prepare($sql);
	$statement->bindParam(':email', $email);
	$statement->bindParam(':password', $password);
	$statement->execute();
}

function returnPassword($email) {
	global $db;
	
	$sql = "SELECT password from users WHERE email = :email";;
	$statement = $db->prepare($sql);
	$statement->bindParam(':email', $email);
	$statement->execute();
	$result = $statement->fetchAll();
	return $result;
	
}	

function addCustomer($email, $password) {
	global $db;
	
	$sql = "INSERT INTO customers (email, password, created) VALUES (:email, :password, NOW())";
	$statement = $db->prepare($sql);
	$statement->bindParam(':email', $email);
	$statement->bindParam(':password', $password);
	
	$statement->execute();
}

function returnCustomer($email){
	global $db;
	
	$sql = "SELECT customer_id from customers WHERE email = :email";;
	$statementt = $db->prepare($sql);
	$statement->bindParam(':email', $email);
	$statement->execute();
	$results = $statement->fetchAll();
	return $results;	
	
}

function returnCustomerPassword($email) {
	global $db;
	
	$sql = "SELECT password from customers WHERE email = :email";;
	$statement = $db->prepare($sql);
	$statement->bindParam(':email', $email);
	$statement->execute();
	$results = $statement->fetchAll();
	return $results;
}

function uniqueEmailCustomer($email) {
	global $db;
	
	$sql = "SELECT * from customers WHERE email = :email";
	$statement = $db->prepare($sql);
	$statement->bindParam(':email', $email);
	$statement->execute();
	$result = $statement->fetchAll();
	return $result;
}
	
	
	

?>