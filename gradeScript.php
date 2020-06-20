<?php
include 'db_connection.php';

$con=OpenCon();
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$lessonID = $argv[1];
$userID = $argv[2];
$grade = $argv[3];

$refgdsql = "SELECT grade FROM grade AS G WHERE G.studentID = '$userID' AND lessonid = '$lessonID";
$refgd = mysqli_query($con, $refgdsql);
$refgd->data_seek(0);
$result = $refgd->fetch_row();

if($result[0] <= $grade){
    $updateGrade = "INSERT INTO grade VALUE ('$lessonID','$userID','$grade');"
    if (!mysqli_query($con,$updateGrade)){
        die('Error: ' . mysqli_error($con));
    }
    $refgd->close();
    print("success");

}else{
    print("something bad happened");
}


mysqli_close($con);


?>