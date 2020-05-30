<?php
//connect to mysql
$mysqli = new mysqli('localhost', 'gaoyangj', '484708', 'gaoyangj');

if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	//echo "888";
?>