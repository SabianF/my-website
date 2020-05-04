<?php
	$dbServerName   = "localhost"                       ;
	$dbUsername     = "********"                        ;
	$dbPassword     = "********"                        ;
	$dbName         = "sabian_eg_workout"               ;
  
	$err_msg        = "Failed to connect to ".$dbName   ;
	
	$conn = mysqli_connect
	(
		$dbServerName
		,$dbUsername
		,$dbPassword
		,$dbName
	);
	
	if (mysqli_connect_errno())
    {
        die($err_msg.": ".mysqli_connect_error());
    }
?>
