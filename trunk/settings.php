<?php
session_start ();
require ("feater.php");

if (loggedIn () != 1)
{
  make_page ("Error", "<br/><center>You must be logged in to access this page!</center><br/>");
  exit;
}

$output = '<table width="360" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">';
$output .= '<tr><td>';
$output .= '<form name="settings" method="post" action="changeSettings.php">';
$output .= '<fieldset>';
$output .= '<legend><strong>Settings</strong></legend>';
$output .= '<table width="350" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">';
$output .= '<tr>';
$output .= '<td>Display Name</td>';
$output .= '<td>:</td>';
$output .= '<td><input name="displayName" type="text" id="displayName" /></td>';
$output .= '</tr>';
$output .= '<tr>';
$output .= '<td>Other Settings</td>';
$output .= '</tr>';
$output .= '<tr>';
$output .= '<td>&nbsp;</td>';
$output .= '<td>&nbsp;</td>';
$output .= '<td><input type="submit" name="Submit" value="Submit" /></td>';
$output .= '</tr></table>';
$output .= '</fieldset>';
$output .= '</form>';
$output .= '</td></tr>';
$output .= '</table>';

make_page ("Settings", $output);
?>