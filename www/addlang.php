<?php
include 'db_connection.php';
session_start();
$con=OpenCon();
if(!isset($_SESSION['login'])){
	header("Location: /index.php");
}
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$userID = $_SESSION["UserID"];
$sql = "SELECT * FROM student AS S WHERE S.idstudent = '$userID' AND S.admin = 1";
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) != 1){
    header("Location: /index.php");
}

echo '<form action="addlang-query.php"  method="post">

   Language Name: <input type="text" name="lang" required><br>
   <input type="submit" value="Submit">
</form>
<br>
<a href="admin-main.php">Back</a>
<br>
';
?>