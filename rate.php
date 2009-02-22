<?php
session_start ();


require("connect_db.php");
$rate=$_REQUEST['rate'];
$user=$_SESSION['usrname'];
$project=$_REQUEST['project_id'];

//query database to see if this user already rated this project
$query_rate="SELECT * FROM ratings WHERE user_id='".mysql_real_escape_string($user)."' AND project_id=".$project;
$query_rate_res=mysql_query($query_rate);


if (!$query_rate_res) 
{
	echo mysql_error();
	exit;
}

$num_of_rate = mysql_numrows($query_rate_res);
/***
if rated already, redirect to search.php, display message
***/
if($num_of_rate>0)
{
	$_SESSION['message']="<p>You already rated this project!</p>";
	header ("location:search.php");
}
/***
not rated yet, rate the project
***/
else
{
	$insert_rate="INSERT INTO ratings VALUES ('".mysql_real_escape_string($user)."',".mysql_real_escape_string($rate).",".mysql_real_escape_string($project).")";
	
	$insert_rate_res=mysql_query($insert_rate);
	
	if (!$insert_rate_res) 
	{
		echo mysql_error();
		exit;
	}
	
	$_SESSION['message']= "<p>You rated it successfully! </p>";
	header ("location:search.php");

}

?>