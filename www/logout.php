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
</html>

<?php
session_start();
session_destroy();
echo 'You have been logged out. <a href="index.php">Go To Login Page</a>';
?>