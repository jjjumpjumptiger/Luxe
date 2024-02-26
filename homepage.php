<?php
    @ $db = new mysqli('localhost', 'root', '', 'luxe');
    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.  Please try again later.';
        exit;
    }

    $sql = 'SELECT * FROM product WHERE quantity >0 ORDER BY soldvolume DESC ;';
    $result = $db->query($sql);
    $num_result = $result -> num_rows;




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
            <a href="homepage.php" ><img src="assets/logo.png" id = "headerlogo"></a>
            <div style="position: absolute; top: 20px; right: 20px;">
                <a href="check_out.php"><img src="assets/cart.png" id = "icon"></a>
                <a href="order_history.php"><img src="assets/history.png" id = "icon"></a>
                <a href="validateLogin.php"><img src="assets/logout.png" id = "icon"></a>
            </div>
        </header>
        <div id="wrapper">
            <a href="sale.php"><img src="assets/banner.png" id="bannerimg"></a>
            <table style="width: 100%;table-layout: fixed; border-spacing: 0px; margin-top: 14px;" >
                <tr >
                    <td style="padding-right: 8px; padding-bottom: 8px;">
                        <a href="category.php?category=top" class="categorybutton">TOP</a>
                    </td>
                    <td style="padding-bottom: 8px;">
                        <a href="category.php?category=bottom" class="categorybutton">BOTTOM</a>
                    </td>
                </tr>
                <tr>
                    <td style="padding-right: 8px;">
                        <a href="category.php?category=suite" class="categorybutton">SUITE</a>
                    </td>
                    <td>
                        <a href="category.php?category=dress" class="categorybutton">DRESS</a>
                    </td>
                </tr>
            </table>
            
            <img src="assets/SELECTED BRANDS.png" style="height: 20px; margin-top: 30px; margin-bottom: 14px; margin-left: auto; margin-right: auto; display: block;">

            <table style="width: 100%;table-layout: fixed; border-spacing: 0px;" >
                <tr >
                    <td style="padding-right: 8px; width: 50%;">
                        <a href="category.php?b=zara"><img src="assets/zara.png" style="width: 100%; height: 308px;"></a>
                    </td>
                    <td style="padding-right: 8px; width: 25%;">
                        <a href="category.php?b=uniqlo"><img src="assets/uniqlo.png" style="height: 308px; width: 100%;"></a>
                    </td>
                    <td style="width: 25%;">
                        <a href="category.php?b=ur"><img src="assets/ur.png" style="height: 308px; width: 100%;"></a>
                    </td>
                </tr>
            </table>

            <img src="assets/TOP 4 BEST SELLING.png" style="height: 20px; margin-top: 30px; margin-bottom: 14px; margin-left: auto; margin-right: auto; display: block;">

            <div style="width: 100%; display: flex; justify-content: space-between; gap: 8px;" >
                
                <?php

                    for ($i=0; $i<4; $i++){
                        $row = $result->fetch_assoc();
                        echo "<div style='width: 25%; '>";
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
        <footer>
            <a href="homepage.php"><img src="assets/Logo_BW.png" id = "footerlogo"></a>
            <p style = "text-align: center;">&copy; 1996-2023, LuxeEssence.com, Inc. or its affiliates<br></p>
        </footer>
    </body>
    
</html>