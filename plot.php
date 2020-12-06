<?php
include 'line_chart_data.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: false,
	theme: "dark1",
	title:{
		text: "Students present"
	},
	axisX: {
		valueFormatString: "hh mm"
	},
	axisY: {
		title: "Total Number of Students",
	},
	data: [{
		type: "splineArea",
		color: "rgba(54,158,173,.7)",
		markerSize: 5,
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
 
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="./canvasjs.min.js"></script>
</body>
</html>    