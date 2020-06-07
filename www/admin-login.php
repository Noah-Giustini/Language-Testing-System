<?php
include 'db_connection.php';

session_start();
// Create connection
$con=OpenCon();
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$userID = $_POST['UserID'];
$password = $_POST['Password'];

$refpwsql = "SELECT password FROM student AS S WHERE S.idstudent = '$userID'";
$refpw = mysqli_query($con, $refpwsql);
$refpw->data_seek(0);
$result = $refpw->fetch_row();

if(password_verify($password,$result[0])){
	$_SESSION["UserID"] = $userID;
	$_SESSION['login'] = 'true';
	$refpw->close();
	header("Location: student-home.php");

}else{
	header("Location: index.php");
}


mysqli_close($con);
?>