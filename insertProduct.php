<?php

@ $db = new mysqli('localhost', 'root', '','luxe');

if(mysqli_connect_errno()){
		echo 'Error: Could not connect to database. Please try again later.';
		exit;
}
if(isset($_POST['submit'])){
	$product_name = $_POST['product_name'];
	$price = $_POST['price'];
	$category_id = $_POST['category_id'];
	
	$color_id = $_POST['color_id'];
	$quantity = $_POST['quantity'];
	$brand_name = $_POST['brand_name'];
	$sale = $_POST['sale'];
	
	$image = $_POST['image'];
	if(!$product_name || !$price || !$category_id || !$color_id || !$quantity || !$brand_name || !$sale || !$image){
		echo "You have not entered all the required details.";
		exit;
	}
	
	$query = "insert into product values
	(NULL, '".$color_id."','".$brand_name."', '0','".$sale."', '".$price."', '".$image."', '".$product_name."', '".$category_id."', '".$quantity."')";
	$result = $db->query($query);
	echo '<script>alert("Success!")</script>'; 
	$db->close();

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Insert product info</title>
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
<form action="insertProduct.php" method="post">
<table style="width:800px">
<caption style="padding-bottom: 20px"><strong>Insert new product</strong></caption>
	<tr>
		<div style="text-align:left;">
			<td style="text-align:right;height: 30px;">Product name: </td>
			<td style="padding-left: 10px;height: 30px;"> 
				
				<input required type="text" name="product_name"  id="product_name" style="width:200px;"><br>
					
			</td>
		</div>
				
		<div style="text-align:right;">
			<td style="text-align:right;height: 30px;">Price: </td>
			<td style="padding-left: 10px;height: 30px;"> 
				
				<input required type="text" name="price"  id="price" style="width:50px;"><br>
					
			</td>
		</div>
	</tr>
	
	<tr>
		<div style="text-align:left;">
			<td style="text-align:right; height: 30px;">Category ID: </td>
			<td style="padding-left: 10px;height: 30px;"> 
				
				<input required type="text" name="category_id"  id="category_id" style="width:50px;"><br>
					
			</td>
		</div>
				
		<div style="text-align:left;">
			<td style="text-align:right; height: 30px;">Color ID: </td>
			<td style="padding-left: 10px;height: 30px;"> 
				
				<input required type="text" name="color_id"  id="color_id" style="width:50px;"><br>
					
			</td>
		</div>
	</tr>
	
	<tr>
		<div style="text-align:left;">
			<td style="text-align:right; height: 30px;">Quantity: </td>
			<td style="padding-left: 10px;height: 30px;"> 
				
				<input required type="text" name="quantity"  id="quantity" style="width:50px;"><br>
					
			</td>
		</div>
				
		<div style="text-align:right;">
			<td style="text-align:right;height: 30px;">Brand name: </td>
			<td style="padding-left: 10px;height: 30px;"> 
				
				<input required type="text" name="brand_name"  id="brand_name" style="width:80px;"><br>
					
			</td>
		</div>
		
		
	</tr>
	
	<tr>
		<div style="text-align:left;">
			<td style="text-align:right; height: 30px;">On sale or not: </td>
			<td style="padding-left: 10px;height: 30px;"> 
				
				<input required type="text" name="sale"  id="sale" style="width:50px;"><br>
					
			</td>
		</div>
				
				<div style="text-align:left;">
			<td style="text-align:right; height: 30px;">Image: </td>
			<td style="padding-left: 10px;height: 30px;"> 
				
				<input required type="text" name="image"  id="image" style="width:200px;"><br>
					
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
