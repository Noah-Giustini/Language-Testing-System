<?php
include 'db_connection.php';

$con=OpenCon();
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$userID = $argv[1];
$password = $argv[2];

$refpwsql = "SELECT password FROM student AS S WHERE S.idstudent = '$userID'";
$refpw = mysqli_query($con, $refpwsql);
$refpw->data_seek(0);
$result = $refpw->fetch_row();

if(password_verify($password,$result[0])){
	print("success");
	$refpw->close();

}else{
	print("bad login");
}


mysqli_close($con);


?>