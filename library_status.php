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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {font-size: 18px; color: #FFFFFF; font-weight: bold; font-family: "Courier New"}
.style5 {font-size: 18px; font-weight: bold; font-family: "Courier New"}
.style6 {font-size: 26px;color: #FFFFFF;font-weight: bold; font-family: "Courier New"}

-->
</style>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="5">
  <tr>
    <td height="40" colspan="2" bgcolor="#625242" class="style6"  align="center">Welcome to VESIT Library</td>
  </tr>
  <tr>
    <td width="68%" ><div id="chartContainer" style="height: 300px; width: 100%;"></div> </td>
    <td width="32%" rowspan="2" align="right" valign="middle" ><table border="1" cellpadding="8" cellspacing="3" >
      <tr align="center" class="style1" bgcolor="#006666">
        <td  >Department</td>
        <td width="60">Swipe In</td>
        <td width="60">Swipe Out</td>
        <td width="60">Actual Present</td>
      </tr>
      <tr class="style5" align="center" bgcolor="#B3C994">
        <td align="left">ETRX</td>
        <td>32</td>
        <td>54</td>
        <td>34</td>
      </tr>
      <tr class="style5" align="center" bgcolor="#B3C994">
        <td align="left">CMPN - I </td>
        <td>32</td>
        <td>54</td>
        <td>34</td>
      </tr>
      <tr class="style5" align="center" bgcolor="#B3C994">
        <td align="left">CMPN - II </td>
        <td>3</td>
        <td>54</td>
        <td>564</td>
      </tr>
      <tr class="style5" align="center" bgcolor="#B3C994">
        <td align="left">INST</td>
        <td>2</td>
        <td>454</td>
        <td>54</td>
      </tr>
      <tr class="style5" align="center" bgcolor="#B3C994">
        <td align="left">EXTC - I </td>
        <td>5</td>
        <td>451</td>
        <td>2</td>
      </tr>
      <tr class="style5" align="center" bgcolor="#B3C994">
        <td align="left">EXTC - II</td>
        <td>6</td>
        <td>12</td>
        <td>123</td>
      </tr>
      <tr class="style5" align="center" bgcolor="#B3C994">
        <td align="left">INFT</td>
        <td>4</td>
        <td>231</td>
        <td>5</td>
      </tr>
      <tr class="style5" align="center" bgcolor="#B3C994">
        <td align="left">MCA - I </td>
        <td>8</td>
        <td>21</td>
        <td>5</td>
      </tr>
      <tr class="style5" align="center" bgcolor="#B3C994">
        <td align="left">MCA - II</td>
        <td >5</td>
        <td >21</td>
        <td >5</td>
      </tr>
      <tr class="style1" align="center" bgcolor="#006666">
        <td>Total</td>
        <td>20</td>
        <td>20</td>
        <td>20</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>line chart  </td>
  </tr>
</table>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
