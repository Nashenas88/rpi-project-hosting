/*******************************************************************
connect_db.php
Allows access to the SQL database
********************************************************************/
<?php

$username="php"; /* Your MySQL username/password/database goes here! */
$password="pass";
$database="RPH";

mysql_connect(localhost,$username,$password);
mysql_select_db($database) or die( "Unable to select database, change username, password, database in connect_db.php");

?>
