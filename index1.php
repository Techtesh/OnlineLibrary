<?php

// Initializing Variables
$rfidtag = $_GET["rfidtag"];
$servername = "localhost";
$username = "nisha";
$password = "nisha";
$dbname = "lib_data";
$wait=10;//time in second

// Create connection
$conn = mysqli_connect($servername, $username, $password);
$db = mysqli_select_db($conn,$dbname);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 


// Fetching Student Registration Number using RFID No. from CMS
$sql_reg = "select regno FROM student_info WHERE rfidtag = '$rfidtag'";
$retval = mysqli_query($conn,$sql_reg);
$row = mysqli_fetch_array($retval);
$regno = $row['regno'];
if($regno)
{
	//Fetching branch and shift from Regno
	$branch_digit = substr($regno, 3, 2);
	$branch_field = 'B'.$branch_digit;
	$tdate = date("Y-m-d");
	$ttime = time();

/* ------ students present -------------------*/

$sql="select regno FROM library_log WHERE rfidtag = '$rfidtag' AND date = '$tdate'";
$sql_update3 = "UPDATE present_lib_stat SET $branch_field=($branch_field+1) WHERE date = '$tdate'";
$retval = mysqli_query($conn,$sql);

	while($row=mysqli_fetch_array($retval)) 
	{
		$reg=$row['regno'];
	}

	if(!$reg)
	{
		$sql_date = "SELECT date from present_lib_stat"; 
		$retval = mysqli_query($conn,$sql_date);
		$date_available = 0;
		while($row=mysqli_fetch_array($retval)) 
		{
			$date_field=$row['date'];
			if($date_field == $tdate)
			{
			  $date_available = 1;
			  mysqli_query($conn,$sql_update3);
			}
		}

		//If present date not found i.e a new day
		if($date_available == 0)
		{
		  $sql_new_date = "INSERT INTO present_lib_stat (date, $branch_field) VALUES ('$tdate',1)";
		  mysqli_query($conn,$sql_new_date);
		  $sql_new_date = "INSERT INTO in_lib_stat (date) VALUES ('$tdate')";
		  mysqli_query($conn,$sql_new_date);
		  $sql_new_date = "INSERT INTO out_lib_stat (date) VALUES ('$tdate')";
		  mysqli_query($conn,$sql_new_date);	
		}

	}
/* -------------------------------------------------------------*/

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


//Query to update in, out stat table
$sql_update1 = "UPDATE in_lib_stat SET $branch_field=($branch_field+1) WHERE date = '$tdate'";
$sql_update2 = "UPDATE out_lib_stat SET $branch_field=($branch_field+1) WHERE date = '$tdate'";


//Query to insert a new entry 
$sql1 = "INSERT INTO library_log (date,rfidtag, regno, intime) VALUES ('$tdate','$rfidtag', '$regno', $ttime)";

//Query to update the out time
$sql2 = "UPDATE library_log SET outtime='$ttime', timespend=$timespend_in  WHERE rfidtag = '$rfidtag' AND timespend = 0 AND date = '$tdate'";


//Check whether to insert or update
	if(!$checktime_in )
	{	
    	 if($timespend_out < $wait)
     	  {
	    echo "Dont come in";  
     	  }
     	  else
     	  {
		mysqli_query($conn,$sql1);
		echo "Yes";
		$sql_date = "SELECT date from in_lib_stat"; 
		$retval = mysqli_query($conn,$sql_date);

		while($row=mysqli_fetch_array($retval)) 
	 	{
		  $date_field=$row['date'];
		  if($date_field == $tdate)
		  {
			$date_available = 1;
			mysqli_query($conn,$sql_update1);
		  }
	 	}
      	  }
	}
	else
	{
		if($timespend_in < $wait)
		{
		  echo "Don't go out";  
		}
		else
		{
		 mysqli_query($conn,$sql2);
		 echo "Student left";
		 $sql_date = "SELECT date from out_lib_stat"; 
		 $retval = mysqli_query($conn,$sql_date);
		 while($row=mysqli_fetch_array($retval)) 
		   {
			$date_field=$row['date'];
			if($date_field == $tdate)
			{
				$date_available = 1;
				mysqli_query($conn,$sql_update2);
			}
		   }
		}
	}

}
mysqli_close($conn);
?>