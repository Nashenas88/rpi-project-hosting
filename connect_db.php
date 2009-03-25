<?php

$user="root"; /* Your MySQL username/password goes here! */
$pass="75867586";
$database="projecthost";

mysql_connect(localhost,$user,$pass);
mysql_select_db($database) or die( "Unable to select database, change username, password, database in connect_db.php");

?>
