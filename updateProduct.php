<?php

@ $db = new mysqli('localhost', 'root', '','luxe');

if(mysqli_connect_errno()){
		echo 'Error: Could not connect to database. Please try again later.';
		exit;
}
if(isset($_POST['submit'])){
	$product_id = $_POST['product_id'];
	$price = $_POST['price'];
	
	$sale = $_POST['sale'];
	$quantity = $_POST['quantity'];
	
	if(!($product_id && ($price || $sale || $quantity))){
		echo "You have not entered all the required details.";
		exit;
	}
	
	$query = "update product set ";
	
	if($price){
		$query.= "price = ".$price;
		if($sale){
		$query.= ",sale = ".$sale;
		}
		if($quantity){
			$query.= ",quantity = ".$quantity;
		}
	
	}else if($sale){
		$query.= "sale = ".$sale;
		if($quantity){
			$query.= ",quantity = ".$quantity;
		}
	}else if($quantity){
		$query.= "quantity = ".$quantity;
	}
	
	$query.= " where productid = ".$product_id;
	

	
	if(mysqli_query($db, $query)){
		echo '<script>alert("Records were updated successfully.")</script>';
	}
	
	
	$db->close();

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Update product info</title>
<meta charset="utf-8">
<link rel="stylesheet" href="external.css">

</head>

<body>
<header>
            <img src="assets/logo.png" id = "headerlogo">
          
        </header>

<br>
<br>
<div style="position: absolute; margin-top:0px; background-color:#FFE2E0;">
<nav>
    <ul>
      <li style="padding-bottom:15px"><a href="insertProduct.php"><strong>Insert Product</strong></a></li>
      <li style="padding-bottom:15px;padding-right:20px"><a href="updateProduct.php"><strong>Update Product</strong></a></li>
      <li><a href="admin.php"><strong>View Product</strong></a></li>
	</ul>
  </nav>	
</div>
<form action="updateProduct.php" method="post">

<table style="width:800px">
<caption style="padding-bottom: 20px"><strong>Update product information</strong></caption>
	<tr>
		<div style="text-align:left;">
			<td style="text-align:right;height: 30px;">Product ID: </td>
			<td style="padding-left: 10px;height: 30px;"> 
				
				<input required type="text" name="product_id"  id="product_id" style="width:50px;"><br>
					
			</td>
		</div>
				
		<div style="text-align:right;">
			<td style="text-align:right;height: 30px;">Price: </td>
			<td style="padding-left: 10px;height: 30px;"> 
				
				<input type="text" name="price"  id="price" style="width:50px;"><br>
					
			</td>
		</div>
	</tr>
	
	<tr>
		<div style="text-align:left;">
			<td style="text-align:right; height: 30px;">On sale or not: </td>
			<td style="padding-left: 10px;height: 30px;"> 
				
				<input type="text" name="sale"  id="sale" style="width:50px;"><br>
					
			</td>
		</div>
				
		<div style="text-align:right;">
			<td style="text-align:right;height: 30px;">Stock: </td>
			<td style="padding-left: 10px;height: 30px;"> 
				
				<input type="text" name="quantity"  id="quantity" style="width:50px;"><br>
					
			</td>
		</div>
	</tr>

</table>

<div style="text-align:center;margin-top: 20px;">
<button type="submit" name="submit" class="button" style = "font-size: 24px;width: 240px;height: 40px">Confirm</button>
</div>

</form>
</body>
</html>
