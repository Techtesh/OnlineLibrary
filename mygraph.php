<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Top Oil Reserves"
	},
	axisY: {
		title: "Reserves(MMbbl)"
	},
	data: [{        
		type: "column",  
		showInLegend: true, 
		legendMarkerColor: "grey",
		legendText: "MMbbl = one million barrels",
		dataPoints: [      
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
	}]
});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>