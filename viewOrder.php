<?php

$table = "<table class='table'>" ;
$table .= "<th> Product ID </th>";
$table .= "<th>Price Paid</th>";
$table .= "<th>Quantity</th>";
foreach($orderItems as $orderItem){ // same as with orders
// read in data to a string to format as table using bootstrap
	$table .= "<tr class='table'>";
	$table .= "<td>" . $orderItem['product_id']. "</td>";
	$table .= "<td>" . $orderItem['price_paid']. "</td>";	
	$table .= "<td>" . $orderItem['quantity']. "</td>";	
	
}
$table .= "</tr></table>";
?>

<section>
<div>
<form action="index.php" method="get">
<input type="submit" name="action" value="Back to Orders"></input>
</form>
<h2> Order Items</h2>
<?php echo $table ?> 

</div>
</section>

