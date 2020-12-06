<!DOCTYPE HTML>
<html>
<head>

<script src="./canvasjs.min.js"></script>


<?php

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

//Fetch from in_lib_stat
$tdate = date("Y-m-d");
echo $tdate;

$sql_in = "select * FROM in_lib_stat WHERE date = '$tdate'";

$retval = mysqli_query($conn,$sql_in);

while($row=mysqli_fetch_array($retval)) 
{
	$in_00 = $row['B00'];
	$in_10 = $row['B10'];
	$in_20 = $row['B20'];
	$in_30 = $row['B30'];
	$in_40 = $row['B40'];
	$in_50 = $row['B50'];
	$in_21 = $row['B21'];
	$in_41 = $row['B41'];
	$in_01 = $row['B01'];
	echo "ok";
}

$Total_in = ($in_00+$in_10+$in_20+$in_30+$in_40+$in_50+$in_21+$in_41+$in_01);
echo $Total_in;

$sql_out = "select * FROM out_lib_stat WHERE date = '$tdate'";
$retval = mysqli_query($conn,$sql_out);

/*while($row=mysqli_fetch_array($retval)) 
{
	$out_00 = $row['00'];
	$out_10 = $row['10'];
	$out_20 = $row['20'];
	$out_30 = $row['30'];
	$out_40 = $row['40'];
	$out_50 = $row['50'];
	$out_21 = $row['21'];
	$out_41 = $row['41'];
	$out_01 = $row['01'];echo "_____ok";
}

$Total_out = ($out_00+$out_10+$out_20+$out_30+$out_40+$out_50+$out_21+$out_41+$out_01);*/
$Total_Present = ($Total_in - $Total_out);


$date_timestamp = date("U");
$present = "UPDATE students_present SET students_number = $Total_Present WHERE timestamp = '$date_timestamp'";
mysqli_query($conn,$present);

// Closing the connection
mysqli_close($conn);

?>

<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
		title:{
			text: "My First Chart in CanvasJS"              
		},
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "column",
			dataPoints: [
				{ label: "MCA I",  y: <?php echo $in_00; ?>  },
				{ label: "ETRX",  y: <?php echo $in_10; ?>  },
				{ label: "CMPN I", y: <?php echo $in_20; ?>  },
				{ label: "INST", y: <?php echo $in_30; ?>  },
				{ label: "EXTC I",  y: <?php echo $in_40; ?>  },
				{ label: "INFT",  y: <?php echo $in_50; ?>  },
				{ label: "CMPN II",  y: <?php echo $in_21; ?> },
				{ label: "EXTC II",  y: <?php echo $in_41; ?> },
				{ label: "MCA II",  y: <?php echo $in_01; ?>  }
			]
		}
		]
	});
	chart.render();
}

</script>
</head>
<body>

<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<p>sadasd</p>
<!--<p> Total In = <?php echo $Total_in; ?> </p>

<p> Total Out = <?php echo $Total_out; ?> </p>
<p> Total Present = <?php echo $Total_Present; ?> </p>
-->
</body>
</html>