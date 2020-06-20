<?php
include 'db_connection.php';

$con=OpenCon();
// Check connection
if (mysqli_connect_errno($con)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//get args
$userID = $argv[1];
$password = $argv[2];

//retrieve the user's password
$refpwsql = "SELECT password FROM student AS S WHERE S.idstudent = '$userID'";
$refpw = mysqli_query($con, $refpwsql);

//if a password was found for user
if ($refpw != false){
  $refpw->data_seek(0);
  $result = $refpw->fetch_row();

  //compare between arg and db.
  if(password_verify($password,$result[0])){
    //if good let server know
    print("success");
    $refpw->close();

  //login failed
  }else{
    print("bad login");
  }
}
//login failed
else{
  print("bad login");
}

//close connection
mysqli_close($con);


?>