<?php

$username="php"; /* Your MySQL username/password goes here! */
$password="pass";
$database="RPH";

mysql_connect(localhost,$username,$password);
mysql_select_db($database) or die( "Unable to select database, change username, password, database in connect_db.php");

?>