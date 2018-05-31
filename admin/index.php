<?php

require_once('productFunctions.php');
require_once('categoryFunctions.php');
require_once('dbConn.php');

$action = '';
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
	filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_STRING)
?? filter_input(INPUT_GET, 'category_id', FILTER_SANITIZE_STRING) ?? NULL;
$category_idU = filter_input(INPUT_POST, 'category_idU', FILTER_SANITIZE_STRING) ?? NULL;
$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING) ?? NULL;
$product_id = filter_input(INPUT_GET, 'product_id', FILTER_SANITIZE_STRING) ?? NULL;
$product = filter_input(INPUT_POST, 'product', FILTER_SANITIZE_STRING) ?? NULL;
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING) ?? NULL;
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)
?? filter_input(INPUT_GET, 'email', FILTER_SANITIZE_STRING) ?? NULL;
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)
?? filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING) ?? NULL;
$registerEmail = filter_input(INPUT_POST, 'registerEmail', FILTER_SANITIZE_STRING)
?? filter_input(INPUT_GET, 'registerEmail', FILTER_SANITIZE_STRING) ?? NULL;
$registerPassword = filter_input(INPUT_POST, 'registerPassword', FILTER_SANITIZE_STRING)
?? filter_input(INPUT_GET, 'registerPassword', FILTER_SANITIZE_STRING) ?? NULL;




if(isset($_FILES['image']))
{
	$file = $_FILES['image']['name'];
	$fileSize = $_FILES['image']['size'];
	$fileTemp = $_FILES['image']['tmp_name'];
	$fileType = $_FILES['image']['type'];
}


switch($action) {
	
	case "addCategory":
		addCategory($category);
		$categoryList = returnCategories();
		include_once('code/head.php');
		include_once('adminMain.php');
		include_once('code/foot.php');
		break;
		
	case "updateCategory":
		$categoryList = returnCategories();
		include_once('code/head.php');
		include_once('adminMain.php');
		include_once('code/foot.php');
		break;
		
	case "update":
		updateCategory($category_idU, $category);
		$categoryList = returnCategories();
		include_once('code/head.php');
		include_once('adminMain.php');
		include_once('code/foot.php');
		break;	
	
		
	case "deleteCategory":
		deleteCategory($category_id);
		$categoryList = returnCategories();
		include_once('code/head.php');
		include_once('adminMain.php');
		include_once('code/foot.php');
		//function to check if products exist in category before deletion
		
	
		break;
		
	case "viewCategory":
		$categoryList = returnCategories();
		$productList = returnProducts($category_id);
		include_once('code/head.php');
		include_once('adminMain.php');
		include_once('code/foot.php');
		break;
		
	case "addProduct":
		
		addProduct($category_id, $product, $price, $file);
		include_once('code/head.php');
		include_once('adminMain.php');
		include_once('code/foot.php');
		//function to grab categories as assoc array
		
		//display in select drop box, after user selects category allow them to add products
		
		//take data from form including the category they chose in select drop box and add products
		
		break;
		
	case "updateProduct":
		$categoryList = returnCategories();
		$product = returnOneProduct($product_id);
		include_once('code/head.php');
		include_once('productView.php');
		include_once('code/foot.php');
		break;
	
	case "updateP":
		$categoryList = returnCategories();
		updateProduct();
		include_once('code/head.php');
		include_once('adminMain.php');
		include_once('code/foot.php');
		
		
		
	case "deleteProduct":
		$categoryList = returnCategories();
		deleteProduct();
		include_once('code/head.php');
		include_once('adminMain.php');
		include_once('code/foot.php');
		break;

	case "Create Login":
		if(uniqueEmail($email)) {
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			addUser($email, $hashedPassword);
		}
		else {
			echo "Email is already registered!";
		}
		include_once('code/head.php');
		include_once('adminLogin.php');
		include_once('code/foot.php');
		break;
		
	case "Login":
		$passwordCheck = returnPassword($email);
		if(password_verify($password, $passwordCheck)) {
			$_SESSION['AdminLogged'] = 1;
			include_once('code/head.php');
			include_once('adminMain.php');
			include_once('code/foot.php');	
		}
		else {
			echo "Information entered is incorrect!";
		}
		break;
		
	case "Logout":
		$_SESSION['AdminLogged'] = '';
		include_once('code/head.php');
		include_once('adminLogin.php');
		include_once('code/foot.php');
		break;
	
	
	default:
		if($_SESSION['AdminLogged'] == null) {
			include_once('code/head.php');
			include_once('adminLogin.php');
			include_once('code/foot.php');
		}
		
		else{
		//display 3 buttons 
			$categoryList = returnCategories();
		
			include_once('code/head.php');
			include_once('adminMain.php');
			include_once('code/foot.php');
		}
		break;
}

?>