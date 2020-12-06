<html>
   <head>
      <title>Creating MySQL Database</title>
   </head>
   <body>
<h1>creates all databse & tables</h1>

<?php

   $dbhost = 'localhost';
   $dbuser = 'nisha';
   $dbpass = 'nisha';
   

   $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
   
   if(! $conn ) {
      die('Could not connect: ' . mysqli_error());
   }
   

   $sql = "USE enterance_log;";
   $retval = mysqli_query( $conn, $sql );
   if(! $retval ) {die('Could not get data: ' . mysqli_error());  }

$sql = "CREATE TABLE student_info (rfidtag VARCHAR(20),regno VARCHAR(10), name varchar(30));";
   $retval = mysqli_query( $conn, $sql );
   if(! $retval ) {die('Could not get data: ' . mysqli_error());  }
   
   
   
   $sql = "CREATE TABLE library_log (date varchar(20),rfidtag VARCHAR(10),regno VARCHAR(10),intime BIGINT(20)UNSIGNED DEFAULT 0,outtime BIGINT(20) UNSIGNED DEFAULT 0,timespend SMALLINT(5) UNSIGNED DEFAULT 0);";
   $retval = mysqli_query( $conn, $sql );
   if(! $retval ) {die('Could not get data: ' . mysqli_error());  }



   $sql = "CREATE TABLE in_lib_stat (date varchar(20),B00 SMALLINT(5) UNSIGNED DEFAULT 0,B10 SMALLINT(5) UNSIGNED DEFAULT 0,B20 SMALLINT(5) UNSIGNED DEFAULT 0,B30 SMALLINT(5) UNSIGNED DEFAULT 0,B40 SMALLINT(5) UNSIGNED DEFAULT 0,B50 SMALLINT(5) UNSIGNED DEFAULT 0,B21 SMALLINT(5) UNSIGNED DEFAULT 0,B41 SMALLINT(5) UNSIGNED DEFAULT 0,B01 SMALLINT(5) UNSIGNED DEFAULT 0);";
   $retval = mysqli_query( $conn, $sql );
   if(! $retval ) {die('Could not get data: ' . mysqli_error());  }


	$sql = "CREATE TABLE out_lib_stat (date varchar(20),B00 SMALLINT(5) UNSIGNED DEFAULT 0,B10 SMALLINT(5) UNSIGNED DEFAULT 0,B20 SMALLINT(5) UNSIGNED DEFAULT 0,B30 SMALLINT(5) UNSIGNED DEFAULT 0,B40 SMALLINT(5) UNSIGNED DEFAULT 0,B50 SMALLINT(5) UNSIGNED DEFAULT 0,B21 SMALLINT(5) UNSIGNED DEFAULT 0,B41 SMALLINT(5) UNSIGNED DEFAULT 0,B01 SMALLINT(5) UNSIGNED DEFAULT 0);";
   $retval = mysqli_query( $conn, $sql );
   if(! $retval ) {die('Could not get data: ' . mysqli_error());  }
   
   $sql = "CREATE TABLE present_lib_stat (date varchar(20),B00 SMALLINT(5) UNSIGNED DEFAULT 0,B10 SMALLINT(5) UNSIGNED DEFAULT 0,B20 SMALLINT(5) UNSIGNED DEFAULT 0,B30 SMALLINT(5) UNSIGNED DEFAULT 0,B40 SMALLINT(5) UNSIGNED DEFAULT 0,B50 SMALLINT(5) UNSIGNED DEFAULT 0,B21 SMALLINT(5) UNSIGNED DEFAULT 0,B41 SMALLINT(5) UNSIGNED DEFAULT 0,B01 SMALLINT(5) UNSIGNED DEFAULT 0);";
   $retval = mysqli_query( $conn, $sql );
   if(! $retval ) {die('Could not get data: ' . mysqli_error());  }


	
  echo "Congratulations database & tables are created";
  mysqli_close($conn);
?>


</body>
</html>
