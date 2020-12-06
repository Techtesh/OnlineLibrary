<?php

// Initializing Variables
$rfidtag = $_GET["rfidtag"];
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

##############################################################################

// Fetching Student Registration Number from RFID No.
$sql_reg = "select regno FROM student_info WHERE rfidtag = '$rfidtag'";
$retval = mysqli_query($conn,$sql_reg);
$row = mysqli_fetch_array($retval);
$regno = $row['regno'];

//Fetching branch and shift from Regno
$branch_digit = substr($regno, 3, 2);
$branch_field = 'B'.$branch_digit;

$tdate = date("Y-m-d");
$ttime = time();

// Fetching Timestamp
$sql="select date,intime FROM library_log WHERE rfidtag = '$rfidtag' AND timespend = 0 AND date = '$tdate'";
$retval = mysqli_query($conn,$sql);
$checktime_in = 0;

while($row=mysqli_fetch_array($retval)) 
{
	$checktime_in=$row['intime'];
	$idate=$row['date'];
}
$timespend_in=($ttime-$checktime_in);

// Fetching Timestamp
$sql="select date,outtime FROM library_log WHERE rfidtag = '$rfidtag' AND date = '$tdate'";
$retval = mysqli_query($conn,$sql);
$checktime_out = 0;

while($row=mysqli_fetch_array($retval)) 
{
	$checktime_out=$row['outtime'];
	
}
$timespend_out=($ttime-$checktime_out);

//Query to update the number of stat
$sql_update1 = "UPDATE in_lib_stat SET $branch_field=($branch_field+1) WHERE date = '$tdate'";
$sql_update2 = "UPDATE out_lib_stat SET $branch_field=($branch_field+1) WHERE date = '$tdate'";

//Query to insert a new entry
$sql1 = "INSERT INTO library_log (date,rfidtag, regno, intime) VALUES ('$tdate','$rfidtag', '$regno', $ttime)";

//Query to update the out time
$sql2 = "UPDATE library_log SET outtime='$ttime', timespend=$timespend_in  WHERE rfidtag = '$rfidtag' AND timespend = 0 AND date = '$tdate'";

//Check whether to insert or update
if(!$checktime_in )
{	
    if($timespend_out < 10)
    {
	echo "Dont come in";  
    }
     else
    {
	mysqli_query($conn,$sql1);
	echo "Yes";
	//echo "Student Entered";
	$sql_date = "SELECT date from in_lib_stat"; 
	$retval = mysqli_query($conn,$sql_date);

	$date_available = 0;
	while($row=mysqli_fetch_array($retval)) 
	{
		$date_field=$row['date'];
	
		if($date_field == $tdate)
		{
			$date_available = 1;
			mysqli_query($conn,$sql_update1);
		}
	}
	
	//If todays date not found i.e a new day
	if($date_available == 0)
	{
		$sql_new_date = "INSERT INTO in_lib_stat (date, $branch_field) VALUES ('$tdate',$branch_field+1)";
				
		mysqli_query($conn,$sql_new_date);
	}
    }
}
else
{
	// The student is not allowed to leave within 10 seconds
	if($timespend_in < 10)
	{
		//Buzzer Indication 
		echo "Don't go out";  
	}
	else
	{
		
		mysqli_query($conn,$sql2); //out
		echo "Yes";
		//echo "Student left";
					
		
		$sql_date = "SELECT date from out_lib_stat"; 
		$retval = mysqli_query($conn,$sql_date);
		$date_available = 0;
		while($row=mysqli_fetch_array($retval)) 
		{
			$date_field=$row['date'];
			
			if($date_field == $tdate)
			{
				$date_available = 1;
				mysqli_query($conn,$sql_update2);
			}
		}

		//If present date not found i.e a new day
		if($date_available == 0)
		{
			$sql_new_date = "INSERT INTO out_lib_stat (date, $branch_field) VALUES ('$tdate',1)";
			mysqli_query($conn,$sql_new_date);	
		}
	}
}

//header('Location: vesit_lib.php');
mysqli_close($conn);
?>
