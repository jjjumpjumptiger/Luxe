<?php

session_start();
@ $db = new mysqli('localhost', 'root', '','luxe');

if(mysqli_connect_errno()){
		echo 'Error: Could not connect to database. Please try again later.';
		exit;
}
if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$match = 0;
	
	if(!isset($_SESSION['user'])){
		$_SESSION['email'] = $email;
	}

	
	$query = "select * from userinfo";
	$result = $db->query($query);
	$num_results = $result->num_rows;
	
	for($i=0; $i < $num_results; $i++){
		$row = $result -> fetch_assoc();
		
		if(strcasecmp($email, $row['email']) == 0 && $password == $row['password']){
			$match = 1;
		}
	}
	if($match == 0){
		echo '<script>alert("Log in failed! Check your email and password!")</script>'; 
	}else{
		header('Location:homepage.php');
	}
	
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>log in</title>
<meta charset="utf-8">
<link rel="stylesheet" href="external.css">

</head>

<body>
		<header>
            <a href="homepage.php" ><img src="assets/logo.png" id = "headerlogo"></a>
            
        </header>

<p style="text-align:center; font-size:36px; padding-top:30px">
Log In
</p>
<br>

<form action="validateLogin.php" method="post">
<table>
	<tr>
		<td style="text-align:left;">Email:</td>
	</tr>
	<tr>
		<td style="text-align:left;">
		<input required type="text" name="email"  id="email" style="width:240px; height: 20px">
		</td>
	</tr>
	
	<tr>
		<td style="text-align:left;padding-top:8px">Password:</td>
	</tr>
	<tr>
		<td style="text-align:left;">
		<input type="password" name="password"  id="password" minlength="6" style="width:240px; height: 20px">
	
		</td>
	</tr>
	
	<tr>
		<td style="font-size:12px;padding-top:8px">
		Do not have an account? <a href="index.html" style="color: #FE5654;">Sign up!</a>
		</td>
	</tr>
</table>

<div style="text-align:center;margin-top: 20px;">
<button type="submit" name="submit" class="button" style = "font-size: 24px;width: 240px;height: 40px">Log In</button>
</div>
</form>

<?php
if(isset($_POST['submit'])){
$result->free();
$db->close();

}

?>

</body>
</html>