<?php
function OpenCon(){
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "password";
    $db = "languagesys";

    $con = new mysqli($dbhost,$dbuser,$dbpass,$db) or die("Connect Failed: %s\n". $con->error);
    return $con; 
}

function CloseCon($con){
    $con->close();
}


?>