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

//get variables from post
$name = $_POST['name'];
$password = $_POST['Password'];
//generate userID
$userID = mt_rand(100000,999999);

$sql = "SELECT * FROM student AS S WHERE S.idstudent = '$userID'";
$result = mysqli_query($con, $sql);
//make sure userID is not used already
while (mysqli_num_rows($result) != 0){
    $userID = mt_rand(100000,999999);
    $result = mysqli_query($con, $sql);
}
//hash and salt the password according to PHP's password_hash function
$password = password_hash($password, PASSWORD_DEFAULT);

//if everything checks out add student to students and enroll them in JPNS
if($password != false){
    $insert = "INSERT INTO student VALUE ('$userID','$name','$password','0');";
    $_SESSION["UserID"] = $userID;
    $_SESSION['name'] = $name;
    if (!mysqli_query($con,$insert)){
        die('Error: ' . mysqli_error($con));
    }
    $takejpns = "INSERT INTO takes VALUE (486758,'$userID');";
    if (!mysqli_query($con,$insert)){
        die('Error: ' . mysqli_error($con));
    }
    header("Location: success.php");
}
else{
    header("Location: error.php");
}


//close connection
mysqli_close($con);
?>