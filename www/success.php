<html>
<style type="text/css">
	body{
		text-align: center;
		margin: auto;
		vertical-align: middle;
		padding-bottom: 100px;
		padding-top: 100px;
	}
	header{
		text-align: center;
		position: absolute;
		top:0;
		width: 100%;
		height: 60px;
		background: #ffa500;
		padding-bottom: 20px;
	}
</style>
<header>
	<h1> Login</h1>
</header>
<body>
You have successfully signed up! Thank you!
<?php
session_start();
echo "\n Your user id is: ",$_SESSION["UserID"], " Do not lose your password or ID, I WILL NOT help you recover it.\n";
?>
<p></p>
<a href="index.php">Home</a>
</body>
</html>