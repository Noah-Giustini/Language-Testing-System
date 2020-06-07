<?php
include 'db_connection.php';
session_start();
$con=OpenCon();

//make sure only valid people are using this page
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

// var from form
$lang = $_POST["lang"];

$ID = mt_rand(10000,99999);

$check = "SELECT * FROM course  WHERE idcourse = '$ID'";
$result = mysqli_query($con, $sql);

while (mysqli_num_rows($result) != 0){
    $userID = mt_rand(10000,99999);
    $result = mysqli_query($con, $check);
}


  
  $input = "INSERT INTO course VALUES ('$ID', '$lang');";
  
 
 if (!mysqli_query($con,$input))
  {
  die('Error: ' . mysqli_error($con));
  }
  
echo "1 course succsessfuly added";

mysqli_close($con);

echo '<br> <a href="admin-main.php">Back</a> <br>';
?>