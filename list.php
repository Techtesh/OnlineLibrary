<!DOCTYPE HTML>
<html>
<head>
<!-- <meta http-equiv="refresh" content="5"> -->

<title>
List of Students
</title>

<body>
<br>
<h2>List of Students</h2>

<hr>

<table border=1>
	<tr>
		<td><strong>Sr. No.</strong></td>
		<td><strong>Registration Number</strong></td>
		<td><strong>Name</strong></td>
		<td><strong>In Time</strong></td>
		<td><strong>Out Time</strong></td>
		<td><strong>Time Spend</strong></td>
    </tr>

<?php

// Initializing Variables
$dept = $_GET["dept"];
$servername = "localhost";
$username = "nisha";
$password = "nisha";
$dbname = "lib_data";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
$db = mysqli_select_db($conn,$dbname);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$status = substr($dept,4,1);

switch($status)
{
	case "i": $field_name = "intime";break;
	case "o": $field_name = "outtime";break;
	case "p": $field_name = "timespend";break;
}

$tdate = date("Y-m-d");
$sql1 = "select * FROM library_log WHERE date = '$tdate';";
$retval1 = mysqli_query($conn,$sql1);

$branch = substr($dept,1,2);
$i = 1;

while($row1=mysqli_fetch_array($retval1)) 
{
	$regno = $row1['regno'];
	$only_branch = substr($regno,3,2);
	if($only_branch == $branch)
	{
	$intime = $row1['intime'];
	$outtime = $row1['outtime'];
	
	
	$timespend = $row1['timespend'];
	
	$sql2 = "select name FROM student_info WHERE regno = '$regno'";
	$retval2 = mysqli_query($conn,$sql2);
	$row2=mysqli_fetch_array($retval2);
	$name = $row2['name'];
	
	
	
?>
	<tr>
	<td><?php echo $i;?></td>
	<td><?php echo $regno;?></td>
	<td><?php echo $name;?></td>
	<td><?php echo date("h:i:sa", $intime);?></td>
	<?php
	if($outtime != 0)
	{
	?>
		<td><?php echo date("h:i:sa", $outtime);?></td>
	<?php
	}
	else 
	{
	?>
		<td><?php echo "";?></td>
	<?php
	}
	?>
	<td><?php echo $timespend;?></td>
	</tr>
<?php
$i++;
}
}
?>

</table>
</body>
</html>
<?php 

// Closing the connection
mysqli_close($conn);

?>