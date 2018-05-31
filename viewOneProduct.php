<?php

$table = "<table class='table'>";

$table .= "<th>Product Name </th>";
$table .= "<th> Price </th>";
$table .= "<th> Category </th>";
$table .= " <th> Image </th>";
$table .= "<tr class='table'>";
$table .= "<td>" . $product['product']. "</td>";
$table .= "<td>" .'$'. $product['price']. "</td>";
$table .= "<td>" . $category . "</td>";
$table .= "<td><img height='50px' width='50px' src='admin/images/" . $product['image']  . "'</img></td><td><form action='index.php' method='get'><input type=submit name='action' value='Add To Cart'></input><input type=hidden name='product_id' value='".$product['product_id']."' </td></tr></table>";
echo $table;
?>