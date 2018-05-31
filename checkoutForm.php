<?php 

$table = "<table class='table'>";
$table .= "<th>Product Name </th>"; 
$table .= "<th> Price </th>";
$table .= "<th> Category </th>";
$table .= " <th> Quantity </th>";
foreach($_SESSION['cart'] as $product){
	$table .= "<tr class='table'>";
	$table .= "<td>" . $product['name']. "</td>";
	$table .= "<td>" . "$" . $product['price']. "</td>";
	$table .= "<td>" . returnCategoryName($product['category']) . "</td>";
	$table .= "<td>" . $product['quantity'] . "</td>";
	$total += ($product['price'] * $product['quantity']);
}
$total .= $total * $tax;
$table .= "</tr><tr><td> Total: $". $total ."</td></tr></table>";
if($action=="logged"){
$table .= "<form action='index.php' method='post'>";
$table .= "<label> Address 1 </label><input type='text' name='address' ></input>";
$table .= "<label> Address 2 </label><input type='text' name='address2' ></input>";
$table .= "<label> State </label><input type='text' name='state' ></input>";
$table .= "<label> City </label><input type='text' name='city' ></input>";
$table .= "<label> Credit Card Number </label><input type='text' name='creditCard' ></input>";
$table .= "<input type='submit' name='action' value='Checkout'> </input></form>";
}
?>

<h2> Cart </h2>

<div>
<?php echo $table; ?>
</div>
