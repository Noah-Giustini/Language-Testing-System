<?php
function OpenCon(){
    $dbhost = "host address";
    $dbuser = "username";
    $dbpass = "password";
    $db = "database name";

    $con = new mysqli($dbhost,$dbuser,$dbpass,$db) or die("Connect Failed: %s\n". $con->error);
    return $con; 
}

function CloseCon($con){
    $con->close();
}


?>