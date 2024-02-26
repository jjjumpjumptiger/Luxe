<?php
session_start();

// $productid = 4;
$email = $_SESSION['email'];
// $email = "I200010@e.ntu.edu.sg";
@ $db = new mysqli('localhost', 'root', '','luxe');

if(mysqli_connect_errno()){
		echo 'Error: Could not connect to database. Please try again later.';
		exit;
}
if(isset($_POST['submit'])){
	$productid = $_POST['productid'];
	$quantity = $_POST['quantity_1'];
	$size = $_POST['size'];
	$size_val = "m";
	if($size == "xs"){
		$size_val = "XS";
	}else if($size == "s"){
		$size_val = "S";
	}else if($size == "m"){
		$size_val = "M";
	}else if($size == "l"){
		$size_val = "L";
	}else{
		$size_val = "XL";
	}
	
	$insert_query = "insert into itemincart values (NULL,'".$productid."','".$email."','".$quantity."','".$size_val."')";
	$insert_result = $db->query($insert_query);
	
	if($insert_result){
		echo '<script>alert("Add to cart successfully!")</script>';
	}
	header('Location:category.php');
}
$productid = $_GET['productid'];
$query = "select brandname, price, imagelink, productname, quantity as item_quantity from product where productid=".$productid;
// $query = "select brandname, price, imagelink, productname from product where productid=4";
$result = $db->query($query);

$row = $result -> fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>check out</title>
<meta charset="utf-8">
<link rel="stylesheet" href="external.css">
<script type="text/javascript" src="js_files/quantity.js"></script>
</head>

<body>
<div id="outer_wrapper">
		
		  <header>
            <a href="homepage.php" ><img src="assets/logo.png" id = "headerlogo"></a>
            <div style="position: absolute; top: 20px; right: 20px;">
                <a href="check_out.php"><img src="assets/cart.png" id = "icon"></a>
                <a href="order_history.php"><img src="assets/history.png" id = "icon"></a>
                <a href="validateLogin.php"><img src="assets/logout.png" id = "icon"></a>
            </div>
        </header>
		
		<div style="padding-top:14px">
			<p style="text-align:center;"><a href="homepage.php" style="text-decoration: none;">Homepage</a> ><a href="category.php" style="text-decoration: none;"> Category </a>> Cloth Details</p>
		</div>
		
<div id="inner_wrapper">
<form action="item_detail.php" method="post">
		<img style="padding-right:10px; width:40%" src="<?php echo $row['imagelink'] ?>" id="floatleft" alt="Logo">
				
			<div id="rightcolumn" style="background-color:#FFF3F2; width:55%;margin-top:0">
				
				<div style="font-size:24px;"><?php echo $row['productname'] ?></div>
				<div style="padding-top:8px;font-size:16px"><?php echo $row['brandname'] ?></div>
				<div style="color:#FE5654;padding-top:8px;font-size:24px">S$ <?php echo $row['price'] ?></div>
				<div style="padding-top:24px">Size</div>
				
				<div class="radio-toolbar" style="margin-left:0px">
					<input type="radio" id="xs" name="size" value="xs">
					<label for="xs">XS</label>
					
					<input type="radio" id="s" name="size" value="s">
					<label for="s">S</label>
					
					<input type="radio" id="m" name="size" value="m" checked>
					<label for="m">M</label>
					
					<input type="radio" id="l" name="size" value="l">
					<label for="l">L</label>
					
					<input type="radio" id="xl" name="size" value="xl">
					<label for="xl">XL</label>
				</div>
				
				<div style="padding-top: 16px;margin-bottom:8px">Quantity</div>
				
				<div style="text-align: center; padding-top: 4px;background-color:white; width:36%">
					<img style="width:28px; height:28px" src="assets/minus.png" onclick="minus(1)">	
					<input type="text" id="quantity_1" name="quantity_1" style="border:none; text-align:center;vertical-align: top;height:24px; width:60px;font-size:16px" value="1">
					<img style="width:28px; height:28px" src="assets/plus.png" onclick="plus(1,<?php echo $row['item_quantity'] ?>)">	

				</div>
				<input type="hidden" id="productid" name="productid" value=<?php echo $productid ?> >
				<div style="width:97%; text-align:left;margin-left:0;padding-top:24px">
					<button class="button" name = "submit" type = "submit" style = "margin-left:0;height:30px; width:100%; font-size: 16px">ADD TO CART</button>
					
				</div>
			</div>
</form>
</div>
		
</div>

<?php

$result->free();
$db->close();



?>

<footer style=" height: 120px;background-color: #FFE2E0;margin-bottom: 0px;">
<img src="assets/Logo_BW.png" style="height:60px;display: block;margin-left: auto;margin-right: auto;padding-top: 20px;">
<p style = "text-align: center;">&copy; 1996-2023, LuxeEssence.com, Inc. or its affiliates<br></p >
</footer>
</body>

</html>