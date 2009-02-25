<?php
$usr = "";
$pass = "";
$loggedIn = 0;

$usrname = $_POST["usrname"];
$pass = $_POST["pass"];

$usrname = stripslashes ($usrname);
$pass = stripslashes ($pass);

if ($usrname=="asdasd" && $pass=="qweqwe")
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