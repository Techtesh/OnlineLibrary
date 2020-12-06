
<?php

$servername = "localhost";
$username = "nisha";
$password = "nisha";
$dbname = "lib_data";

// Create connections
$conn = mysqli_connect($servername, $username, $password);
$db = mysqli_select_db($conn,$dbname);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

//Fetch from in_lib_stat
$tdate = date("Y-m-d");

$sql_in = "select * FROM in_lib_stat WHERE Date = '$tdate'";
$retval = mysqli_query($conn,$sql_in);

while($row=mysqli_fetch_array($retval)) 
{
	$B0 = $row['B00'];
	$B1 = $row['B10'];
	$B2 = $row['B20'];
	$B3 = $row['B30'];
	$B4 = $row['B40'];
	$B5 = $row['B50'];
	$B6 = $row['B21'];
	$B7 = $row['B41'];
	$B8 = $row['B01'];
}

$sql_out = "select * FROM out_lib_stat WHERE Date = '$tdate'";
$retval = mysqli_query($conn,$sql_out);

while($row=mysqli_fetch_array($retval)) 
{
	$B0_out = $row['B00'];
	$B1_out = $row['B10'];
	$B2_out = $row['B20'];
	$B3_out = $row['B30'];
	$B4_out = $row['B40'];
	$B5_out = $row['B50'];
	$B6_out = $row['B21'];
	$B7_out = $row['B41'];
	$B8_out = $row['B01'];
}

$Total_in = ($B0+$B1+$B2+$B3+$B4+$B5+$B6+$B7+$B8);
$Total_out = ($B0_out+$B1_out+$B2_out+$B3_out+$B4_out+$B5_out+$B6_out+$B7_out+$B8_out); 
$Total = ($Total_in - $Total_out);

	
// Closing the connection
mysqli_close($conn);

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--<meta http-equiv="refresh" content="5">-->
<title>Welcome to VESIT Library</title>

<!-- Code for Bar Graph -->
	
<script src="../canvasjs.min.js"></script>


<script type="text/javascript">

window.onload = function () 
{
	var chart = new CanvasJS.Chart("chartContainer", {
		title:
		{
			text: "Department Wise Count"              
		},
		data: 
		[              
			{
				// Change type to "doughnut", "line", "splineArea", etc.
				type: "column" ,
				dataPoints: 
				[
					{ label: "ETRX",  y: <?php echo $B1; ?>  },
					{ label: "CMPN", y: <?php echo $B2; ?>  },
					{ label: "CMPN-II",  y: <?php echo $B6; ?>  },
					{ label: "INST", y: <?php echo $B3; ?>  },
					{ label: "EXTC",  y: <?php echo $B4; ?>  },
					{ label: "EXTC-II",  y: <?php echo $B7; ?>  },
					{ label: "INFT",  y: <?php echo $B5; ?> },
					{ label: "MCA",  y: <?php echo $B0; ?>  }
					{ label: "MCA-II",  y: <?php echo $B8; ?>  }
				]
			}
		]
	});
	chart.render();
}
</script>

<style type="text/css"></style>
</head>

<body>

<table width="68%" border="1" align="center" height="97%">
  <tbody>
    <tr>
      <td height="81" colspan="2" align = "center" valign="middle" style="font-size: 36px; color: #6C4DD4;"><strong>Welcome to VESIT Library</strong></td>
    </tr>
    <tr>
      <td width="60%" height="233" align="center" valign="middle"><div id="chartContainer" style="height: 220px; width: 100%;"></div></td>
      <td rowspan="2" width="40%"><table width="267" height="297" border="1" align="center">
        <tbody >
          <tr height="30">
            <td width="132" align="center" valign="middle" bgcolor="#E19AD1"><strong>Department</strong></td>
            <td width="22" align="center" valign="middle" bgcolor="#E19AD1" style="font-size: 14px"><p><strong>SWIPE</strong></p>
              <p><strong>IN</strong></p></td>
            <td width="28" align="center" valign="middle" bgcolor="#E19AD1" style="font-size: 14px"><p><strong>SWIPE</strong></p>
              <p><strong>OUT</strong></p></td>
            <td width="57" align="center" valign="middle" bgcolor="#E19AD1" style="font-size: 14px"><p><strong>ACTUAL </strong></p>
              <p><strong>PRESENT</strong></p></td>
            </tr>
          <tr height="30">
            <td bgcolor="#BC8BD9">ETRX </td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B10_i target="_blank"><?php echo $B1; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B10_o target="_blank"><?php echo $B1_out; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B10_p target="_blank"><?php echo ($B1-$B1_out); ?></a></td>
            </tr>
          <tr height="30">
            <td bgcolor="#BC8BD9">CMPN </td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B20_i target="_blank"><?php echo $B2; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B20_o target="_blank"><?php echo $B2_out; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B20_p target="_blank"><?php echo ($B2-$B2_out); ?></a></td>
            </tr>
          <tr>
            <td bgcolor="#BC8BD9">CMPN II Shift </td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B21_i target="_blank"><?php echo $B6; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B21_o target="_blank"><?php echo $B6_out; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B21_p target="_blank"><?php echo ($B6-$B6_out); ?></a></td>
            </tr>
          <tr>
            <td bgcolor="#BC8BD9">INST </td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B30_i target="_blank"><?php echo $B3; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B30_o target="_blank"><?php echo $B3_out; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B30_p target="_blank"><?php echo ($B3-$B3_out); ?></a></td>
            </tr>
          <tr>
            <td bgcolor="#BC8BD9">EXTC</td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B40_i target="_blank"><?php echo $B4; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B40_o target="_blank"><?php echo $B4_out; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B40_p target="_blank"><?php echo ($B4-$B4_out); ?></a></td>
            </tr>
          <tr>
            <td bgcolor="#BC8BD9">EXTC II Shft </td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B41_i target="_blank"><?php echo $B7; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B41_o target="_blank"><?php echo $B7_out; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B41_p target="_blank"><?php echo ($B7-$B7_out); ?></a></td>
            </tr>
          <tr>
            <td bgcolor="#BC8BD9">INFT </td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B50_i target="_blank"><?php echo $B5; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B50_o target="_blank"><?php echo $B5_out; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B50_p target="_blank"><?php echo ($B5-$B5_out); ?></a></td>
            </tr>
          <tr>
            <td bgcolor="#BC8BD9">MCA </td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B00_i target="_blank"><?php echo $B0; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B00_o target="_blank"><?php echo $B0_out; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B00_p target="_blank"><?php echo ($B0-$B0_out); ?></a></td>
            </tr>
          <tr>
            <td bgcolor="#BC8BD9">MCA II Shift </td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B01_i target="_blank"><?php echo $B8; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B01_o target="_blank"><?php echo $B8_out; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=B01_p target="_blank"><?php echo ($B8-$B8_out); ?></a></td>
            </tr>
          <tr>
            <td bgcolor="#BC8BD9">TOTAL </td>
			  <td bgcolor="#BC8BD9"><a href=./list.php?dept=all_i target="_blank"><?php echo $Total_in; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=all_o target="_blank"><?php echo $Total_out; ?></a></td>
            <td bgcolor="#BC8BD9"><a href=./list.php?dept=all_p target="_blank"><?php echo ($Total_in - $Total_out); ?></a></td>
            </tr>
          </tbody>
      </table></td>
    </tr>
    <tr>
      <td height="224"><div id="LineGraph" style="height: 220px; width: 100%;"></div></td>
    </tr>
  </tbody>
</table>
</body>
</html>
