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

	
	$query = "insert into userinfo values
(NULL, '".$email."', '".$password."')";
	$result = $db->query($query);
	
	if(!isset($_SESSION['user'])){
		$_SESSION['email'] = $email;
	}

echo '<script>alert("Sign up successfully!")</script>'; 
header('Location:homepage.php');


}


$db->close();

?>

