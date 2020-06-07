<?php
include 'db_connection.php';
session_start();
$con=OpenCon();
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

if(mysqli_num_rows($result) != 1){
    header("Location: /index.php");
}

?>

<html>
<style type="text/css">
	body{
		text-align: center;
		margin: auto;
		vertical-align: middle;
		padding-bottom: 100px;
		padding-top: 100px;
		table-layout: fixed;
	}
	header{
		text-align: center;
		position: absolute;
		top:0;
		width: 100%;
		height: 60px;
		background: #ffa500;
		padding-bottom: 20px;
	}
	button{
		width: 200px;
		height:20px;
	}
</style>

<header>
<?php
$userID = $_SESSION["UserID"];
$getname = "SELECT name FROM student AS S WHERE S.idstudent = '$userID'";
$refpw = mysqli_query($con, $getname);
$refpw->data_seek(0);
$result = $refpw->fetch_row();

echo "<h1>Welcome, ", $result[0],"<h1>";
$refpw->close();
?>
</header>

<body>
<table style="vertical-align: bottom; margin-left: auto; margin-right: auto;">
	<tr>
		<th><a href="addlang.php"><button>Add Languages</button></a><br></th>
		<th><a href="addlesson.php"><button>Add Lessons</button></a><br></th>
	</tr><br>
</table>


<br>
<a href='logout.php'><button>Log out</button></a><br>
</body>

</html>


