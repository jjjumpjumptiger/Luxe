<?php
    @ $db = new mysqli('localhost', 'root', '', 'luxe');
    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.  Please try again later.';
        exit;
    }


    $sql = 'SELECT * FROM product WHERE sale=2 AND quantity >0 ORDER BY RAND() ;';
    $result_sale = $db->query($sql);
    $num_result = $result_sale -> num_rows;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Luxe, Essence</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="homepage.css">
        <script type="text/javascript" src="homepage.js"></script>
    </head>
    <body>
        <header>
            <a href="homepage.php"><img src="assets/logo.png" id = "headerlogo"></a>
			<div style="position: absolute; top: 20px; right: 20px;">
                <a href="check_out.php"><img src="assets/cart.png" id = "icon"></a>
                <a href="order_history.php"><img src="assets/history.png" id = "icon"></a>
                <a href="validateLogin.php"><img src="assets/logout.png" id = "icon"></a>
            </div>
        </header>
        <div id="wrapper">
            <a href="sale.php"><img src="assets/banner.png" id="bannerimg"></a>
            
            <div style="width: 100%; height: 100%; overflow-y: scroll; overflow: auto; display: flex; gap: 8px; margin-top: 28px; flex-wrap: wrap;" >
                <?php

                    for ($i=0; $i<$num_result; $i++){
                        $row = $result_sale->fetch_assoc();
                        echo "<div style='width: 24.3%;' >";
                        echo "<a href='item_detail.php?productid=".$row['productid']."'><img src='".$row['imagelink']."' style='width: 100%;'></a>";
                        echo "<div id='saleflex'>";
                        echo "<p id='pricetag'>S$ ".$row['price']."</p>";
                        if($row['sale'] == 2){ echo "<img src='assets/sale.png' height= '18px'>"; }
                        echo "</div>";
                        echo "<p id='productnametag'>".$row['productname']."</p></div>";
                    }
                    
                ?>

            </div>
        </div>
    </body>
    <footer>
        <a href="homepage.php"><img src="assets/Logo_BW.png" id = "footerlogo"></a>
        <p style = "text-align: center;">&copy; 1996-2023, LuxeEssence.com, Inc. or its affiliates<br></p>
    </footer>
</html>