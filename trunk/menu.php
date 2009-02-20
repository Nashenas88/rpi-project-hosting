<?php
function loggedIn ()
{
  return $_SESSION["loggedIn"];
}
?>

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
if (loggedIn () != 0)
{
  echo "\"login.php?logout\">Logout";
  echo "</a></td><td align=\"center\"><a href=\"upload.php\">Upload";
  echo "</a></td><td align=\"center\"><a href=\"projects.php\">Projects";
  echo "</a></td><td align=\"center\"><a href=\"search.php\">Search";
  echo "</a></td><td align=\"center\"><a href=\"settings.php\">Settings";
}
else
{
  echo "\"login.php\">Login";
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

