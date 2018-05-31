<?php

require_once('admin/productFunctions.php');
require_once('admin/categoryFunctions.php');
require_once('admin/dbConn.php');
require_once('admin/userFunctions.php');
require_once('admin/orderFunctions.php');

$action = '';
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
	filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_STRING)
?? filter_input(INPUT_GET, 'category_id', FILTER_SANITIZE_STRING) ?? NULL;
$category_idU = filter_input(INPUT_POST, 'category_idU', FILTER_SANITIZE_STRING) ?? NULL;
$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING) ?? NULL;
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_STRING)
?? filter_input(INPUT_GET, 'product_id', FILTER_SANITIZE_STRING) ?? NULL;
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING) ?? NULL;
$quantity = filter_input(INPUT_GET, 'quantity', FILTER_SANITIZE_STRING) ?? NULL;
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING) ?? NULL;
$address2 = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING) ?? NULL;
$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING) ?? NULL;
$state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING) ?? NULL;
$zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING) ?? NULL;
$order_id = filter_input(INPUT_GET, 'order_id', FILTER_SANITIZE_STRING) ?? NULL;
$creditCard = filter_input(INPUT_POST, 'creditCard', FILTER_SANITIZE_STRING) ?? NULL;
$customer_id = filter_input(INPUT_GET, 'customer_id', FILTER_SANITIZE_STRING) ?? NULL;
$customerEmail = filter_input(INPUT_POST, 'customerEmail', FILTER_SANITIZE_STRING) ?? NULL;
$customerPassword = filter_input(INPUT_POST, 'customerPassword', FILTER_SANITIZE_STRING) ?? NULL;
$customerEmailRegister = filter_input(INPUT_POST, 'customerEmailRegister', FILTER_SANITIZE_STRING)
?? filter_input(INPUT_GET, 'category_id', FILTER_SANITIZE_STRING) ?? NULL;
$customerPasswordRegister = filter_input(INPUT_POST, 'customerPasswordRegister', FILTER_SANITIZE_STRING)
?? filter_input(INPUT_GET, 'CustomerPasswordRegister', FILTER_SANITIZE_STRING) ?? NULL;



session_start();

if(isset($_FILES['image']))
{
	$file = $_FILES['image']['name'];
	$fileSize = $_FILES['image']['size'];
	$fileTemp = $_FILES['image']['tempName'];
	$fileType = $_FILES['image']['type'];
	$fileExtension = strtolower(end(explode('.', $FILES['image']['name'])));
}

switch($action) {
	
	case "Register":
		if(empty(uniqueEmailCustomer($customerEmailRegister))) {
			$hashedPassword = password_hash($customerPasswordRegister, PASSWORD_DEFAULT);
			addCustomer($customerEmailRegister, $hashedPassword);
			include_once("customerHead.php");
			include_once('checkoutForm.php');
			include_once("admin/code/foot.php");
		}
		else {
			echo "Email is already taken!";
		}

		break;
		
	case "viewCategory":
		$categoryList = returnCategories();
		$productList = returnProducts($category_id);
		include_once('customerHead.php');
		include_once('productView.php');
		include_once('admin/code/foot.php');
		break;
	
	case "viewProduct":
		$product = returnOneProduct($product_id);
		$category = returnCategoryName($product['category_id']);
		include_once("customerHead.php");
		include_once("viewOneProduct.php");
		include_once("admin/code/foot.php");
		break;
	
	case "Add To Cart":

		$product = returnOneProduct($product_id);
		$productString = strval($product_id);
		
		if(isset($_SESSION['cart'][$productString])) {
			$_SESSION['cart'][$productString]['quantity'] = $_SESSION['cart'][$productString]['quantity'] + 1;
		}

		
		else {
			$_SESSION['cart'][$productString]['name'] = $product['product'];
			$_SESSION['cart'][$productString]['price'] = $product['price'];
			$_SESSION['cart'][$productString]['category'] = $product['category_id'];
			$_SESSION['cart'][$productString]['id'] = $productString;
			$_SESSION['cart'][$productString]['quantity'] = 1;
		}

		include_once("customerHead.php");
		include_once('shoppingCart.php');
		include_once("admin/code/foot.php");

		break;
		
	case "View Cart":
		include_once("customerHead.php");
		include_once('shoppingCart.php');
		include_once("admin/code/foot.php");
		break;
		
	case "Change Quantity":
		
		include_once('customerHead.php');
		include_once('shoppingCart.php');
		include_once('admin/code/foot.php');
		break;
		
	case "Orders":
		$orders = returnOrder($_SESSION['customer_id']);
		include_once('customerHead.php');
		include_once('orderView.php');
		include_once('admin/code/foot.php');
		break;
		
	case "View Order":
		$orderItems = returnOrderItems($order_id);
		include_once('customerHead.php');
		include_once('viewOrder.php');
		include_once('admin/code/foot.php');
		break;
		
	case "Login":
		$hashedPassword = returnCustomerPassword($email);
		if(password_verify($password, $hashedPassword)) {
			$_SESSION['customer_id'] = returnCustomer($email);
			$action = "logged";
			$_SESSION['logged'] = TRUE;
			include_once('customerHead.php');
			include_once('checkoutForm.php');
			include_once('admin/code/foot.php');
		}
		break;
			
	case "Check Out":
		if($_SESSION['logged'] == NULL) {
			include_once("customerHead.php");
			include_once("customerRegisterLogin.php");
			include_once("admin/code/foot.php");
		}
		else {
			include_once('customerHead.php');
			include_once('checkoutForm.php');
			include_once('admin/code/foot.php');
		}
		break;
	
	case "Confirm":
		$customer_id = $_SESSION['customer_id'];
		$order_id = addToOrders($customer_id, $_SESSION['tax']);
		foreach($_SESSION['cart'] as $product) {
			addOrderItems($order_id, $product['id'], $product['price'], $product['quantity']);
		}
		session_destroy();
		echo "Your order has been placed";
		break;
		
		
	default:
		$categoryList = returnCategories();
		
		include_once('customerHead.php');
		include_once('customerMain.php');
		include_once('admin/code/foot.php');
		break;
}

?>