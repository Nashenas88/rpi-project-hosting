<?php

$username=""; /* Your MySQL username/password goes here! */
$password="";
$database="";

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database, change username, password, database in connect_db.php");

?>