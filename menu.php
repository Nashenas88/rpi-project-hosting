<table width="100%" border = "0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td align="center">
<a href="index.php">Home</a>
</td>
<td align="center">
<a href=

<?php
//the functions used to determine priviledge
require("priviledge.php");
if (loggedIn () != 0)
{
  	echo "\"login.php?logout\">Logout";
  	echo "</a></td><td align=\"center\"><a href=\"logout.php\">LogoutAlternate";
  	echo "</a></td><td align=\"center\"><a href=\"upload.php\">Upload";
  	echo "</a></td><td align=\"center\"><a href=\"projects.php\">Projects";
  	echo "</a></td><td align=\"center\"><a href=\"search.php\">Search";
  	echo "</a></td><td align=\"center\"><a href=\"settings.php\">Settings";
  
  	if (getPriviledge <= 1)
  	{
  		 echo "</a></td><td align=\"center\"><a href=\"moderate.php\">Moderate";
  	}  
}
else
{
  echo "\"login.php\">Login";
  echo "</a></td><td align=\"center\"><a href=\"loginAlternate.php\">LoginAlernate";
  echo "</a></td><td align=\"center\"><a href=\"search.php\">Search";
}
?>
</a>
</td>
<td align="center">
<a href="about.php">About</a>
</td>
</tr>
</table>
</td>
</tr>
</table>

