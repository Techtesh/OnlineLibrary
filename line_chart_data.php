<?php
$servername = "localhost";
$username = "nisha";
$password = "nisha";
$dbname = "lib_data";


$in_hm = array();
$out_hm = array();
$xaxis = array();
$yaxis_in = array();
$yaxis_out = array();
$present = array();
$dataPoints = array();

$conn = mysqli_connect($servername, $username, $password);
$db = mysqli_select_db($conn,$dbname);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$tdate = date("Y-m-d");

$sql = "select intime FROM library_log WHERE date = '$tdate'";
$retval = mysqli_query($conn,$sql);
$i=0;
while($row=mysqli_fetch_array($retval)) 
{
	$in = $row['intime'];
	$in_hm[$i]=date("h:ia",$in); 
	//echo $in_hm[$i];
	$i=$i+1;
	
}

$sql = "select outtime FROM library_log WHERE date = '$tdate' and outtime !=0";
$retval = mysqli_query($conn,$sql);
	$i=0;
	while($row=mysqli_fetch_array($retval)) 
	{
	  $out = $row['outtime'];
	  $out_hm[$i]=date("h:ia",$out);
	  //echo $out_hm[$i];
	  $i=$i+1;
	}
mysqli_close($conn);


	$m = date("m");$d = date("d");$y = date("Y");
	$start= mktime(8,0,0,$m,$d,$y);//morning 8am 24hr format
	//echo(date("F d,Y h:i:sa",$start));
	$end= mktime(20,0,0,$m,$d,$y);//evening 8pm 24hr format
	//echo(date("F d,Y h:i:sa",$end));


	$i=0;

	for($z=$start;$z<=$end;$z=$z+60)//one min. window
	{
	 $hm=date("h:ia",$z);
	 $xaxis[$i]=$hm;//x-axis of plot
	 $cin=count(array_keys($in_hm, $hm));
	 $cout=count(array_keys($out_hm, $hm));


	 if($i!=0){
	 $yaxis_in[$i]=($cin+$yaxis_in[$i-1]);
	 $yaxis_out[$i]=($cout+$yaxis_out[$i-1]);
	 }
	 else{
	 $yaxis_in[$i]=(0+$cin);
	 $yaxis_out[$i]=(0+$cout);
	 }

	 $present[$i]=$yaxis_in[$i]-$yaxis_out[$i];//y-axis of plot
	 $i=$i+1;

	}

	for($z=0;$z<count($present);$z++)
	{
	 //echo $xaxis[$z];echo "------";echo $present[$z]; 
	 array_push($dataPoints, array("label" => $xaxis[$z], "y" => $present[$z]));
	}

?>