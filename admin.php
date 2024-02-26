<?php
    @ $db = new mysqli('localhost', 'root', '', 'luxe');
    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.  Please try again later.';
        exit;
    }

    $sql = 'SELECT productid,brandname,price,productname,quantity,soldvolume FROM product';
    $result = $db->query($sql);
    $num_result = $result -> num_rows;



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Luxe, Essence</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="external.css">
       
    </head>
	
	
<style>


table, th, td {
  border: 1px solid black;font-size:14px;
}

 
</style>
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
		<div style="margin-left:180px">
		<?php

                    for ($i=0; $i<$num_result; $i++){
                        $row = $result->fetch_assoc();
                       echo '<table style="width:970px">
							<tr>
							<td style="width:110px;">Product id:'.$row['productid'].'
							</td>
							<td style="width:400px">Product name:'.$row['productname'].'
							</td>
							<td style="width:100px;">Price:'.$row['price'].'
							</td>
							<td style="width:150px;">Brand name:'.$row['brandname'].'
							</td>
							<td style="width:80px;">Stock:'.$row['quantity'].'
							</td>
							<td style="width:130px;">Sales volume:'.$row['soldvolume'].'
							</td>
							</tr>
						</table>';
                       
                    }
                    
                ?>
		
		
		
		
		</div>
		
</body>
</html>