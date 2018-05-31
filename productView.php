	<?php

		$table = "<table class='table'>\n";  
		$table .= "<tbody>";
		$table .= "<tr>" . "<th>" . "<b>" ."Product ID" . "</th>";
		$table .= "<th>" . "<b>" ."Product Name" . "</th>";
		$table .= "<th>" . "<b>" ."Price" . "</th>";
		$table .= "<th>" . "<b>" ."Image" . "</th>";
		$table .= "</tr>";
		
		foreach($productList as $product) 
		{
			$table .= "\t<tr>";
			$table .= "<td>" . $product['product_id'] . "</td>";
			$table .= "<td>" . $product['product'] . "</td>";
			$table .= "<td>" . $product['price'] . "</td>";
			$table .= "<td>" . '<img height="75px" src=admin/images/' . $product['image'] . '>' . '</img>' . "</td>";
			$table .= "<td> <a href='index.php?product_id=" . $product['product_id'] . "&action=Add+To+Cart'>" . "Add To Cart" . "</a> </td>";
			$table .= "<td> <a href='index.php?product_id=" . $product['product_id'] . "&action=viewProduct'>" . "View More" . "</a> </td>";			
			$table .= "\t</tr>\n";
		}
		echo $table;
	
	?>