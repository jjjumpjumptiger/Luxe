<?php


    @ $db = new mysqli('localhost', 'root', '', 'luxe');
    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.  Please try again later.';
        exit;
    }
    session_start();
    if (isset($_GET['category'])){
        //echo "hello";
        $_SESSION['bw'] = true;
        $_SESSION['colored'] = true;
        $_SESSION['zara'] = true;
        $_SESSION['uniqlo'] = true;
        $_SESSION['ur'] = true;
        if ($_GET['category'] == "top"){
            $_SESSION['top'] = true;
            $_SESSION['bottom'] = false;
            $_SESSION['suite'] = false;
            $_SESSION['dress'] = false;
        }
        else if($_GET['category'] == "bottom"){
            $_SESSION['top'] = false;
            $_SESSION['bottom'] = true;
            $_SESSION['suite'] = false;
            $_SESSION['dress'] = false;
        }
        else if($_GET['category'] == "suite"){
            $_SESSION['top'] = false;
            $_SESSION['bottom'] = false;
            $_SESSION['suite'] = true;
            $_SESSION['dress'] = false;
        }
        else{
            $_SESSION['top'] = false;
            $_SESSION['bottom'] = false;
            $_SESSION['suite'] = false;
            $_SESSION['dress'] = true;
        }
    }

    if (isset($_GET['b'])){
        //echo "hello";
        $_SESSION['top'] = true;
        $_SESSION['bottom'] = true;
        $_SESSION['suite'] = true;
        $_SESSION['dress'] = true;
        $_SESSION['bw'] = true;
        $_SESSION['colored'] = true;
        
        if ($_GET['b'] == "zara"){
            $_SESSION['zara'] = true;
            $_SESSION['uniqlo'] = false;
            $_SESSION['ur'] = false;
        }
        else if($_GET['b'] == "uniqlo"){
            $_SESSION['zara'] = false;
            $_SESSION['uniqlo'] = true;
            $_SESSION['ur'] = false;
        }
        else{
            $_SESSION['zara'] = false;
            $_SESSION['uniqlo'] = false;
            $_SESSION['ur'] = true;
        }
    }


    if (isset($_POST['colored'])){
        //echo "Color is set to: " . $_POST['colored'];
        $_SESSION['colored'] = !$_SESSION['colored'];
    }
    if (isset($_POST['bw'])){
        //echo "Color is set to: " . $_POST['bw'];
        $_SESSION['bw'] = !$_SESSION['bw'];
    }
    if (isset($_POST['zara'])){
        //echo "Color is set to: " . $_POST['colored'];
        $_SESSION['zara'] = !$_SESSION['zara'];
    }
    if (isset($_POST['uniqlo'])){
        //echo "Color is set to: " . $_POST['bw'];
        $_SESSION['uniqlo'] = !$_SESSION['uniqlo'];
    }
    if (isset($_POST['ur'])){
        //echo "Color is set to: " . $_POST['bw'];
        $_SESSION['ur'] = !$_SESSION['ur'];
    }
    if (isset($_POST['top'])){
        //echo "Color is set to: " . $_POST['bw'];
        $_SESSION['top'] = !$_SESSION['top'];
    }
    if (isset($_POST['bottom'])){
        //echo "Color is set to: " . $_POST['colored'];
        $_SESSION['bottom'] = !$_SESSION['bottom'];
    }
    if (isset($_POST['suite'])){
        //echo "Color is set to: " . $_POST['bw'];
        $_SESSION['suite'] = !$_SESSION['suite'];
    }
    if (isset($_POST['dress'])){
        //echo "Color is set to: " . $_POST['bw'];
        $_SESSION['dress'] = !$_SESSION['dress'];
    }



    



    //select * from product where quantity >0 AND categoryid=1 or categoryid=2 and brandname='zara' and colorid=1 or colorid=2 ;
    $categoryConditions = [];
    if ($_SESSION['top']) {
        $categoryConditions[] = 'categoryid=1';
    }
    if ($_SESSION['bottom']) {
        $categoryConditions[] = 'categoryid=2';
    }
    if ($_SESSION['suite']) {
        $categoryConditions[] = 'categoryid=3';
    }
    if ($_SESSION['dress']) {
        $categoryConditions[] = 'categoryid=4';
    }

    // Brands
    $brandConditions = [];
    if ($_SESSION['zara']) {
        $brandConditions[] = "brandname='zara'";
    }
    if ($_SESSION['uniqlo']) {
        $brandConditions[] = "brandname='uniqlo'";
    }
    if ($_SESSION['ur']) {
        $brandConditions[] = "brandname='ur'";
    }

    // Colors
    $colorConditions = [];
    if ($_SESSION['bw']) {
        $colorConditions[] = 'colorid=1';
    }
    if ($_SESSION['colored']) {
        $colorConditions[] = 'colorid=2';
    }

    // Construct SQL
    $sql = 'SELECT * FROM product WHERE quantity > 0 AND ';

    if (!empty($categoryConditions)) {
        $sql .= '(' . implode(' OR ', $categoryConditions) . ') AND ';
    }

    if (!empty($brandConditions)) {
        $sql .= '(' . implode(' OR ', $brandConditions) . ') AND ';
    }

    if (!empty($colorConditions)) {
        $sql .= '(' . implode(' OR ', $colorConditions) . ')';
    } else {
        // Removing the trailing 'AND ' if no color conditions
        $sql = substr($sql, 0, -5);
    }
	$sql .= ' ORDER BY RAND()';

    //echo $sql;
    //echo 'top'.$_SESSION['top'].'bottom'.$_SESSION['bottom'].'suite'.$_SESSION['suite'].'dress'.$_SESSION['dress'].'zara'.$_SESSION['zara'].'uniqlo'.$_SESSION['uniqlo'].'ur'.$_SESSION['ur'].'bw'.$_SESSION['bw'].'colored'.$_SESSION['colored'];
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
    <body >
        <div >
        <header>
            <a href="homepage.php"><img src="assets/logo.png" id = "headerlogo"></a>
			<div style="position: absolute; top: 20px; right: 20px;">
                <a href="check_out.php"><img src="assets/cart.png" id = "icon"></a>
                <a href="order_history.php"><img src="assets/history.png" id = "icon"></a>
                <a href="validateLogin.php"><img src="assets/logout.png" id = "icon"></a>
            </div>
        </header>
		
        <div id="wrapper1">
			<div>
				<p style="text-align:center; font-size: 16px; font-family:Arial;"><a href="homepage.php" style="text-decoration: none;">Homepage</a> >Category </p>
			</div>
    
            <div class="fixed-column">

                
                    <p id="categorylabel" style=" " >Category</p>

                    <form method="post" action="category.php"> 
                    <label class="checkbox-label">
                        <input type="checkbox" <?php if($_SESSION['top']){ echo 'checked'; } ?> onchange="this.form.submit()">Top
                        <span class="checkmark"></span>
                    </label>
                    <input type="hidden" name="top">
                    </form>
                    <form method="post" action="category.php"> 
                    <label class="checkbox-label">
                        <input type="checkbox" <?php if($_SESSION['bottom']){ echo 'checked'; } ?> onchange="this.form.submit()">Bottom
                        <span class="checkmark"></span>
                    </label>
                    <input type="hidden" name="bottom">
                    </form>
                    <form method="post" action="category.php"> 
                    <label class="checkbox-label">
                        <input type="checkbox" <?php if($_SESSION['suite']){ echo 'checked'; } ?> onchange="this.form.submit()">Suite
                        <span class="checkmark"></span>
                    </label>
                    <input type="hidden" name="suite">
                    </form>
                    <form method="post" action="category.php"> 
                    <label class="checkbox-label">
                        <input type="checkbox" <?php if($_SESSION['dress']){ echo 'checked'; } ?> onchange="this.form.submit()">Dress
                        <span class="checkmark"></span>
                    </label>
                    <input type="hidden" name="dress">
                    </form>

                    <p id="categorylabel">Brands</p>


                    <form method="post" action="category.php"> 
                    <label class="checkbox-label">
                        <input type="checkbox" <?php if($_SESSION['zara']){ echo 'checked'; } ?> onchange="this.form.submit()">Zara
                        <span class="checkmark"></span>
                    </label>
                    <input type="hidden" name="zara">
                    </form>
                    <form method="post" action="category.php"> 
                    <label class="checkbox-label">
                        <input type="checkbox" <?php if($_SESSION['uniqlo']){ echo 'checked'; } ?> onchange="this.form.submit()">Uniqlo
                        <span class="checkmark"></span>
                    </label>
                    <input type="hidden" name="uniqlo">
                    </form>
                    <form method="post" action="category.php"> 
                    <label class="checkbox-label">
                        <input type="checkbox" <?php if($_SESSION['ur']){ echo 'checked'; } ?> onchange="this.form.submit()">Urban Revivo
                        <span class="checkmark"></span>
                    </label>
                    <input type="hidden" name="ur">
                    </form>


                    <p id="categorylabel">Colour</p>



                    <form method="post" action="category.php"> 
                    <label class="checkbox-label">
                        <input type="checkbox" <?php if($_SESSION['bw']){ echo 'checked'; } ?> onchange="this.form.submit()">Black / White
                        <span class="checkmark"></span>
                    </label>
                    <input type="hidden" name="bw">
                    </form>

                    <form method="post" action="category.php"> 
                    <label class="checkbox-label">
                        <input type="checkbox" name="colored" <?php if($_SESSION['colored']){ echo 'checked'; } ?> onchange="this.form.submit()">Colourful
                        <span class="checkmark"></span>
                    </label>
                    <input type="hidden" name="colored">
                    </form>

            </div>
            
            <div class="scrolling-column">

                <?php

                    for ($i=0; $i<$num_result; $i++){
                        $row = $result->fetch_assoc();
                        echo "<div style='width: 23%; margin-top: 18px' >";
                        echo "<a href='item_detail.php?productid=".$row['productid']."'><img src='".$row['imagelink']."' style='width: 100%;'></a>";
                        echo "<div id='saleflex'>";
                        echo "<p id='pricetag'>S$ ".$row['price']."</p>";
                        if($row['sale'] == 2){ echo "<img src='assets/sale.png' height= '18px'>"; }
                        echo "</div>";
                        echo "<p id='productnametag'>".$row['productname']."</p></div>";
                    }
                    
                    

                ?>
                <!--
                    <div style="width: 23%; margin-top: 18px" >
                        <a href="item_detail.php?productid=1"><img src="clothimg/ln1402-425-1_cfxv1lad8ll8uonh.webp" style="width: 100%;"></a>
                        <div id="saleflex">
                            <p id="pricetag">S$ 30.00</p>
                            <img src="assets/sale.png" height= "18px">
                        </div>
                        <p id="productnametag">A Beautiful Dress for Swe...</p>
                    </div>
                -->                
                
                
            </div>
        </div>
        <footer>
            <a href="homepage.php"><img src="assets/Logo_BW.png" id = "footerlogo"></a>
            <p style = "text-align: center;">&copy; 1996-2023, LuxeEssence.com, Inc. or its affiliates<br></p>
        </footer>
        </div>
    </body>
    
</html>