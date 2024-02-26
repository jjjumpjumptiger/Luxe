<?php
session_start();
@ $db = new mysqli('localhost', 'root', '','luxe');
// $email = "I200010@e.ntu.edu.sg";
$email = $_SESSION['email'];
if(mysqli_connect_errno()){
		echo 'Error: Could not connect to database. Please try again later.';
		exit;
}
$date = date('Y/m/d H:i:s');
$query = "select itemincart.productid, product.price, product.quantity as item_quantity, soldvolume from product, itemincart 
where itemincart.email = 'I200010@e.ntu.edu.sg' and product.productid = itemincart.productid";


// echo $query;
$result = $db->query($query);
$num_results = $result->num_rows;

			if(isset($_POST['checkout'])){
				
				for($i=0; $i < $num_results; $i++){
					$row = $result -> fetch_assoc();
					// echo $_POST['check_'.($i+1)];
					$item_quantity = $row['item_quantity'];
					$soldvolume = $row['soldvolume'];
					if(isset($_POST['check_'.($i+1)])){
						
						$quantity = $_POST['quantity_'.($i+1)];
						$insert_query ="insert into orderinfo values (NULL, '".$email."', '".$row['productid']."', '".$row['price']*$quantity."', '".$date."', '".$quantity."')";
						$insert_result = $db->query($insert_query);
						
						$new_quantity = $item_quantity - $quantity;
						$new_soldvolume = $soldvolume+$quantity;
						
						$update_query = "update product set quantity = ".$new_quantity.", soldvolume = ".$new_soldvolume." where productid=".$row['productid'];
						$update_result = $db->query($update_query);
						// echo $new_soldvolume;
						// echo '<script>alert("Come in")</script>';
						
					}
				}
				
			$to = 'f32ee@localhost';
			$subject = 'Comfirmation of the order';
			$message = 'Dear customer,'."\n".'Thanks for your order!'."\n".'Best regards,'."\n".'Luxe,Essence';
			$headers = 'From: f31ee@localhost'."\r\n".'Reply-To:f31ee@localhost'."\r\n".'X-Mailer:PHP/'.phpversion();
			mail($to, $subject, $message, $headers);
			header('Location:after_checkout.html');
			}
				
				
			for($i=0; $i < $num_results; $i++){
				$row = $result -> fetch_assoc();
				
				if(isset($_POST['delete_'.($i+1)])){
				
					$delete_productid = $row['productid'];
					$delete_query = "delete from itemincart where itemincart.productid =".$delete_productid;
					$delete_result = $db->query($delete_query);
	

					break;
				}
				
			}
			
			
			$query = "select itemincart.productid, product.imagelink, product.productname, product.price, product.brandname, itemincart.quantity, itemincart.size, product.quantity as item_quantity from product, itemincart 
			where itemincart.email = '".$email."' and product.productid = itemincart.productid";


			// echo $query;
			$result = $db->query($query);
			$num_results_after_delete = $result->num_rows;	
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
	
		
		 <header style="position: fixed;
    width: 100%;">
            <a href="homepage.php" ><img src="assets/logo.png" id = "headerlogo"></a>
            <div style="position: absolute; top: 20px; right: 20px;">
                <a href="check_out.php"><img src="assets/cart.png" id = "icon"></a>
                <a href="order_history.php"><img src="assets/history.png" id = "icon"></a>
                <a href="validateLogin.php"><img src="assets/logout.png" id = "icon"></a>
            </div>
        </header>
	<div style="padding-top:80px">
	<p style="text-align:center;"><a href="check_out.php" style="text-decoration: none;">Cart</a> > Pay > Complete</p>
	</div>

	
	<div id="inner_wrapper">
		<div id="leftcolumn">
			<div style="padding-left: 16px">
				<input type="checkbox" name="checkall" id="checkall" value="" onclick="checkAll(<?php echo $num_results_after_delete?>),orderSummary(<?php echo $num_results_after_delete?>)"/>
				<label for="checkall" style="padding-left: 16px;">All items</label>
			
			</div>
			<br>
			<form action="check_out.php" method="post">
			<?php

			?>
				
			<?php
				
			
			for($i=0; $i < $num_results_after_delete; $i++){
				
				$row = $result -> fetch_assoc();
				$item_quantity = $row['item_quantity'];
				echo'<div class = "content">
				<div style="float: left; padding-top: 50px;">
				<input type="checkbox" name="check_'.($i+1).'" id="check_'.($i+1).'" value="" onclick="orderSummary('.$num_results_after_delete.')" />
				</div>';
		
				echo '<img style="padding-right:10px;" src="'.$row['imagelink'].'" width="90" height="120" id="floatleft" alt="Logo">';
				echo '<div id="productname_'.($i+1).'">'.$row['productname'].'</div>';
				echo '<div style="padding-top:8px">'.$row['brandname'].'</div>';
				echo '<div style="color:#FE5654;padding-top: 8px;" id="price_'.($i+1).'">S$'.$row['price'].'</div>';
				echo '
				<div style="padding-top: 8px;float: left;" >Size: '.$row['size'].'</div>
				<div style="padding-top: 8px; text-align: right;">
					<img style="width:15px; height:15px" id="minus_'.($i+1).'" src="assets/minus.png" onclick="minus('.($i+1).'),orderSummary('.$num_results_after_delete.')">';
				echo '<input type="text" id="quantity_'.($i+1).'" name="quantity_'.($i+1).'" style="border:none; text-align:center;vertical-align: top; width:32px" value='.$row['quantity'].' readonly>';
				echo '<img style="width:15px; height:15px;padding-right:16px" id="plus_'.($i+1).'" src="assets/plus.png" onclick="plus('.($i+1).','.$item_quantity.'),orderSummary('.$num_results_after_delete.')">';	
				echo '<button type="submit" name="delete_'.($i+1).'" style="padding-left:16px;border: none;appearance: none;background-color: inherit;" onclick="this.form.submit()"><img style="width:15px; height:15px; border=0" src="assets/delete.png"></button>
				
				</div>
			</div>
			<br>';
		
			}
			
			?>
		
			
		
		</div>
		
		<div id="rightcolumn">
			<div style="font-size:24px; padding-left: 16px; padding-top: 50px;padding-bottom:20px"><strong>Order summary</strong></div><br>
			<div id="order_summary">
			
			</div>
			
			
			
			<div id="order_summary">
			
			</div>
			<!-- <script>
				for(var i = 0; i < <?phpecho $num_results ?>; i++){
					var check = document.getElementById('check_' +  i);
					if(check.checked == true){
						document.write("<tr><td style="text-align:left;" id="truncateLongTexts">x1 A Beautiful Dress for Sweet girl. A Beautiful Dress for Sweet girl.</td>
							<td style="text-align:right;">S$30.00</td>
						</tr>");
					}
				}
			</script> -->
			
				<!-- <tr>
					<td style="text-align:left;" id="truncateLongTexts">x1 A Beautiful Dress for Sweet girl. A Beautiful Dress for Sweet girl.</td>
					<td style="text-align:right;">S$30.00</td>
				</tr>
				
				<tr>
					<td id="truncateLongTexts">x1 A Beautiful Dress for Sweet girl. A Beautiful Dress for Sweet girl.</td>
					<td style="text-align:right;">S$30.00</td>
				</tr>
				
				<tr>
					<td id="truncateLongTexts">x1 A Beautiful Dress for Sweet girl. A Beautiful Dress for Sweet girl.</td>
					<td style="text-align:right;">S$30.00</td>
				</tr> -->
				
			
			<hr style="width:90%; ">
			<table style="width:90%; ">
				<tr>
					<td>Total:</td>
					<td style="text-align:right;">
					<input type="text" style="text-align:right;color:#FE5654;font-weight:bold;border:none;" id = "totalprice" value="S$ 0" readonly>
					
					
					</td>
				</tr>
			</table>
			<br>
			
				<!-- <input type="submit"  style = "margin-left:50px" value="Check Out"> -->
		<div style="text-align:center;margin-bottom:30px">
			<button class="button" type="submit" name = "checkout" style = "height:48px; margin-top:24px">Check Out</button>
			
		</div>
		
		</div>
		</form>
		
	</div>
</div>

<footer style=" height: 120px;background-color: #FFE2E0;margin-bottom: 0px;margin-top:30px;  <?php if($num_results_after_delete < 4) echo "position: fixed; width: 100%; bottom:0;"?>">
<img src="assets/Logo_BW.png" style="height:60px;display: block;margin-left: auto;margin-right: auto;padding-top: 20px;">
<p style = "text-align: center;">&copy; 1996-2023, LuxeEssence.com, Inc. or its affiliates<br></p >
</footer>

<?php

// for($i=0; $i < $num_results; $i++){
	// if(isset($_POST['delete_'.($i+1)])){
		// $delete_result->free();
	// }
// }




$result->free();
$db->close();



?>



<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>


</html>
