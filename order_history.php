<?php
session_start();
@ $db = new mysqli('localhost', 'root', '','luxe');
$email = $_SESSION['email'];
// $email = "I200010@e.ntu.edu.sg";

if(mysqli_connect_errno()){
		echo 'Error: Could not connect to database. Please try again later.';
		exit;
}
$query = "select product.brandname,product.imagelink, product.productname, orderinfo.quantity,orderinfo.price,orderinfo.orderdate from orderinfo,product where orderinfo.email='".$email."' and product.productid = orderinfo.productid order by orderdate desc";

$result = $db->query($query);
$num_results = $result->num_rows;
$row = $result -> fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>check out</title>
<meta charset="utf-8">
<link rel="stylesheet" href="external.css">
</head>

<body>
		<header>
            <a href="homepage.php" ><img src="assets/logo.png" id = "headerlogo"></a>
            <div style="position: absolute; top: 20px; right: 20px;">
                <a href="check_out.php"><img src="assets/cart.png" id = "icon"></a>
                <a href="order_history.php"><img src="assets/history.png" id = "icon"></a>
                <a href="validateLogin.php"><img src="assets/logout.png" id = "icon"></a>
            </div>
        </header>


<div id="inner_wrapper">
<?php
$i = 1;
while($i <= $num_results){
	
	$orderdate = $row['orderdate'];
	echo '<div style="background-color: #ffffff;padding-left:24px;padding-top:12px;">'.$orderdate.'
</div>';
	$price = 0;
	while($i <= $num_results && $row['orderdate'] == $orderdate){
		$price += $row['price'];
		echo '<div class = "content">
				<img style="padding-right:10px; padding-left: 8px" src="'.$row['imagelink'].'" width="90" height="120" id="floatleft" alt="Logo">
				<div>'.$row['productname'].'</div>
				<p>'.$row['brandname'].'</p>
				<div>x'.$row['quantity'].'</div>
				<p style="text-align: right;color:#FE5654"><strong>S$ '.$row['price'].'</strong></p>
				
</div>';
		$row = $result -> fetch_assoc();
		$i++;
	}
	
	
	echo '
<div style="background-color: #FEAAA9;color:#ffffff; text-align:right; font-size: 20px; padding-right:16px;  padding-top:8px; height:32px">
Total:S$'.$price.'
</div>
<br>';
}


?>



</div>


<footer style=" height: 120px;background-color: #FFE2E0;margin-bottom: 0px;margin-top:30px;  <?php if($num_results < 5) echo "position: fixed; width: 100%; bottom:0;"?>">
<img src="assets/Logo_BW.png" style="height:60px;display: block;margin-left: auto;margin-right: auto;padding-top: 20px;">
<p style = "text-align: center;">&copy; 1996-2023, LuxeEssence.com, Inc. or its affiliates<br></p >
</footer>
</body>


</html>