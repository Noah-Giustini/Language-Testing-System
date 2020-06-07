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
$lessonName = $_POST["lessonName"];

$ID = mt_rand(1000000,99999999);

$check = "SELECT * FROM lesson  WHERE idlesson = '$ID'";
$result = mysqli_query($con, $sql);

while (mysqli_num_rows($result) != 0){
    $userID = mt_rand(1000000,99999999);
    $result = mysqli_query($con, $check);
}


  //by default all courses belong to Japanese since i dont know any other language. this hard coded value must be changed if that is to be different
  //also note this value for JPNS' id is technically illegal because i made a change after making the course. all other courses have 7/8 digit id's
  //this will need to be updated when i move this to a real server unless i save all the data in the db
  $input = "INSERT INTO lesson VALUES ('$ID', 486758 ,'$lessonName');";
  
 
 if (!mysqli_query($con,$input))
  {
  die('Error: ' . mysqli_error($con));
  }
  
echo "1 lesson succsessfuly added";

mysqli_close($con);

echo '<br> <a href="admin-main.php">Back</a> <br>';
?>