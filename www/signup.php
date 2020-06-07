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
	<h1> Sign-up </h1>
</header>
<body>
	<form action="submit-signup.php" method="post">
   Name: <input type="text" name="name" required><br><br>
   Password: <input type="password" name="Password" required><br><br>
   <input type="submit" value="Sign-up" />
   <input type="button" name = "Cancel" value="Cancel" onClick = "window.location='index.php';"/>
</form>
</body>
</html>

