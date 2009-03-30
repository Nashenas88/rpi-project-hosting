<?php

$user="php"; /* Your MySQL username/password goes here! */
$pass="pass";
$database="RPH";

mysql_connect(localhost,$user,$pass);
mysql_select_db($database) or die( "Unable to select database, change username, password, database in connect_db.php");

?>
