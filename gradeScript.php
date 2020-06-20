<?php
include 'db_connection.php';

$con=OpenCon();
// Check connection
if (mysqli_connect_errno($con)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//get args
$lessonID = $argv[1];
$userID = $argv[2];
$grade = $argv[3];

//check for existing grades
$refgdsql = "SELECT gradeval FROM grade AS G WHERE G.studentid = '$userID' AND G.lessonid = '$lessonID';";
$refgd = mysqli_query($con, $refgdsql);
//if there is a grade see what it is
if($refgd != false){
    $refgd->data_seek(0);
    $result = $refgd->fetch_row();

    //if the new grade is better update the value
    if($result[0] <= $grade){
        $updateGrade = "UPDATE grade SET gradeval = '$grade' WHERE lessonid = '$lessonID' AND studentid = '$userID';";
        if (!mysqli_query($con,$updateGrade)){
            die('Error: ' . mysqli_error($con));
        }
        //let server know we did good
        print("success");
        $refgd->close();
    }
}
//no grade exists yet. add new one
else{
    $insertGrade = "INSERT INTO grade VALUE ('$lessonID','$userID','$grade');";
    if (!mysqli_query($con,$insertGrade)){
        die('Error: ' . mysqli_error($con));
    }
}
//close variable and connection

mysqli_close($con);

?>
