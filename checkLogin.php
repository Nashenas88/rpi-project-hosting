<?php
require("feater.php");

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
head("Login Success");
}
else
{
head("Login");
echo "Login Failed";
echo "<br /><center>Username and/or password were incorrect click ";
echo "<a href=\"login.php\">here</a> to login again.";
foot();
}
?>