<?php

session_start();

$old_user = $_SESSION['user'];
unset($_SESSION['user']);
session_destroy();
?>

<html lang="en">
<head>
<title>check out</title>
<meta charset="utf-8">
<link rel="stylesheet" href="external.css">
</head>
<body>

<p style="text-align:center; font-size:40px; padding-top:30px">
<strong>Logged out. Thank you.</strong>
</p>
<div style="text-align:center;margin-top: 40px;">
<button class="button" style = "font-size: 24px;width: 240px;height:48px; " onclick="window.location = 'validateLogin.php';">Back to Log In</button>
</div>


</body>
</html>