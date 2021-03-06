<?php
/*******************************************************************
rate.php
Allows user to rate a project once
********************************************************************/

session_start ();

require("connect_db.php");


if(isset($_REQUEST['rate'])&&isset($_REQUEST['project_id']))
{

$rate=htmlspecialchars($_REQUEST['rate']);
$user=htmlspecialchars($_SESSION['username']);
$project=htmlspecialchars($_REQUEST['project_id']);


if($rate>5 || $rate < 1 )
{
$_SESSION['message']= "<p>Your rate fails! Must be 1-5!</p>";
header ("location:search.php");
exit;
}

//query database to see if this user already rated this project
$query_rate="SELECT * FROM ratings WHERE user_id='".mysql_real_escape_string($user)."' AND project_id=".mysql_real_escape_string($project);
$query_rate_res=mysql_query($query_rate);


if (!$query_rate_res) 
{
	//echo mysql_error();
	echo "Sorry, we can't query your request";
	exit;
}

$num_of_rate = mysql_numrows($query_rate_res);

// if user has already rated this project, redirect to search.php, display message
if($num_of_rate>0)
{
	$_SESSION['message']="<p>You already rated this project!</p>";
	header("location:".$_SESSION['back']);
}

$insert_rate="INSERT INTO ratings(user_id,rate,project_id) VALUES ('".mysql_real_escape_string($user)."',".mysql_real_escape_string($rate).",".mysql_real_escape_string($project).")";

$insert_rate_res=mysql_query($insert_rate);

if (!$insert_rate_res) 
{
	//echo mysql_error();
	echo "Sorry, we can't query your request.";
	exit;
}

$_SESSION['message']= "<p>You rated it successfully! </p>";
header("location:".$_SESSION['back']);

}
?>
