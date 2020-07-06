<?php
include 'db_connection.php';
session_start();
if(!isset($_SESSION['login'])){
  header("Location: index.php");
}
// Create connection
$con=OpenCon();

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$userID = $_SESSION["UserID"];


//query
$result = mysqli_query($con,"SELECT L.name, G.gradeval FROM lesson AS L, grade AS G WHERE G.studentid = '$userID' AND G.lessonid = L.idlesson");

echo "<table border='1'>
<tr>
<th>Lesson Name</th>
<th>Grade</th>
</tr>";




while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['grade'] . "</td>";
  echo "</tr>";
  }
echo "</table>";
echo "<br>
<a href=student-home.php>Back</a><br>";

mysqli_close($con);
?>
