<?php
/************************************************
settings.php
Allows users to change certain features based on
the preferences that they fill out in this form
*************************************************/

session_start ();
require ("feater.php");
head("Settings");

if (loggedIn () != 1)
{
  make_page ("Error", "<br/><center>You must be logged in to access this page!</center><br/>");
  exit;
}

// html for the settings form
echo '<table width="360" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">';
echo '<tr><td>';
echo '<form name="settings" method="post" action="changeSettings.php">';
echo '<fieldset>';
echo '<legend><strong>Settings</strong></legend>';
echo '<table width="350" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">';
echo '<tr>';
echo '<td>Display Name</td>';
echo '<td>:</td>';
echo '<td><input name="displayName" type="text" id="displayName" /></td>';
echo '</tr>';
echo '<tr>';
echo '<td>Other Settings</td>';
echo '</tr>';
echo '<tr>';
echo '<td>&nbsp;</td>';
echo '<td>&nbsp;</td>';
echo '<td><input type="submit" name="Submit" value="Submit" /></td>';
echo '</tr></table>';
echo '</fieldset>';
echo '</form>';
echo '</td></tr>';
echo '</table>';

foot();
?>
