<!DOCTYPE HTML>
<html>
<body>
<?php
$id = $name = "";
?>

<h2>Scan RFID</h2>
	<form action="lib_rfid.php" method="GET" >  
	<br>
	
  RFID : <input type="text" name="rfidtag" required>
  <br><br>

  <input type="submit" value="Submit" name="submit" >
  
</form>
</body>
</html>