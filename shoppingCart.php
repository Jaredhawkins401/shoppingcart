<?php
$total = 0; 

$table = "<table class='table'>";
$table .= "<th>Product Name </th>"; 
$table .= "<th> Price </th>";
$table .= "<th> Category </th>";
$table .= " <th> Quantity </th>";

foreach($_SESSION['cart'] as $product) {
	var_dump($_SESSION['cart']);
	$table .= "<tr class='table'>";
	$table .= "<td>" . $product['name']. "</td>";
	$table .= "<td>" . "$" . $product['price']. "</td>";
	$table .= "<td>" . $product['category'] . "</td>";
	$table .= "<td><form action='index.php' method='get'>" . $product['quantity'] . "</td>";
	$total .= ($product['price'] * $product['quantity']);
}
$table .= "</tr><tr><td> Total: $". $total ."</td></tr></table>";
?>

<section>
<div>
	<?php echo($table) ?>
</div>
</section>
<form action="index.php" method="get">
	<input type=submit  name="action" value="Clear Cart"> </input>
	<input type=submit  name="action" value="Continue Shopping"> </input>
	<input type=submit name="action" value="Check Out"> </input>
</form>
