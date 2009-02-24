<?php
session_start ();
require("connect_db.php");

$usr = "";
$pass = "";
$loggedIn = 0;

$usrname = $_POST["usrname"];
$pass = $_POST["pass"];

$usrname = stripslashes ($usrname);
$pass = stripslashes ($pass);

$authentication="SELECT 1 FROM users WHERE rcsid='".mysql_real_escape_string($usrname)."' AND password='".mysql_real_escape_string($pass)."'";
$authentication_res=mysql_query($authentication);

if (!$authentication_res) 
{
	echo mysql_error();
	exit;
}

$authentication_num=mysql_numrows($authentication_res);

if ($authentication_num>0)
{
$loggedIn = 1;

session_register ("usrname");
session_register ("pass");
session_register ("loggedIn");
header ("location:loginSuccess.php");
}
else
{
require ("upper_header.php");
echo "Login Failed";
require ("lower_header.php");
require ("menu.php");
echo "<br /><center>Username and/or password were incorrect click ";
echo "<a href=\"login.php\">here</a> to login again.";
require ("footer.php");
}
?>