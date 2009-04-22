<link rel="icon" type="image/ico" href="images/favicon.ico" />
<link rel="stylesheet" type="text/css" href="table.css" />



<ul>
<li><a href="index.php">Home</a></li>
<?php
/*******************************************************************
menu.php
Creates the menu which is displayed at the top of all pages
********************************************************************/

//the functions used to determine priviledge
require("priviledge.php");


if (isset ($_SESSION['username']))
{
  	echo "<li><a href=\"login.php?logout\">Logout</a></li>";
  	echo "<li><a href=\"logout.php\">LogoutAlternate</a></li>";
  	echo "<li><a href=\"upload.php\">Upload</a></li>";
  	echo "<li><a href=\"search.php\">Search</a></li>";
  	//echo "</a></td><td align=\"center\"><a href=\"settings.php\">Settings";
  
	// if user is a moderator display the moderate option
  	if (getPriviledge() <= 1)
  	{
  		 echo "<li><a href=\"moderate.php\">Moderate</a></li>";
  	}  
	
}
else
{
  echo "<li><a href=\"login.php\">Login</a></li>";
  echo "<li><a href=\"loginAlternate.php\">LoginAlernate</a></li>";
  echo "<li><a href=\"search.php\">Search</a></li>";
}
?>
<li><a href="about.php">About</a></li>
<li><a href="helpQuestions.php">FAQ</a></li>
</ul>
