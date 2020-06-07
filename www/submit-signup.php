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

$name = $_POST['name'];
$password = $_POST['Password'];
$userID = mt_rand(100000,999999);

$sql = "SELECT * FROM student AS S WHERE S.idstudent = '$userID'";
$result = mysqli_query($con, $sql);

while (mysqli_num_rows($result) != 0){
    $userID = mt_rand(100000,999999);
    $result = mysqli_query($con, $sql);
}

$password = password_hash($password, PASSWORD_DEFAULT);

if($password != false){
    $insert = "INSERT INTO student VALUE ('$userID','$name','$password','0');";
    $_SESSION["UserID"] = $userID;
    $_SESSION['name'] = $name;
    if (!mysqli_query($con,$insert)){
        die('Error: ' . mysqli_error($con));
    }
    $takejpns = "INSERT INTO takes VALUE (486758,'$userID');";
    header("Location: success.php");
}
else{
    header("Location: error.php");
}



mysqli_close($con);
?>