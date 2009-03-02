<?php
session_start ();

require ("connect_db.php");
$id = mysql_real_escape_string ($_GET["id"]);

?>