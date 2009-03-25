<?php
$usr = "";
$pass = "";
$loggedIn = 0;

$username = $_POST["username"];
$pass = $_POST["pass"];

$username = stripslashes ($username);
$pass = stripslashes ($pass);

if ($username=="asdasd" && $pass=="qweqwe")
{
$loggedIn = 1;

session_register ("username");
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