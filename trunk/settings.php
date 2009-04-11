<?php
session_start ();
require ("feater.php");

if (loggedIn () != 1)
{
  make_page ("Error", "<br/><center>You must be logged in to access this page!</center><br/>");
  exit;
}

$output = '<table width="360" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">\n';
$output .= '<tr><td>\n';
$output .= '<form name="settings" method="post" action="changeSettings.php">\n';
$output .= '<fieldset>\n';
$output .= '<legend><strong>Settings</strong></legend>\n';
$output .= '<table width="350" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">\n';
$output .= '<tr>\n';
$output .= '<td>Display Name</td>\n';
$output .= '<td>:</td>\n';
$output .= '<td><input name="displayName" type="text" id="displayName" /></td>\n';
$output .= '</tr>\n';
$output .= '<tr>\n';
$output .= '<td>Other Settings</td>\n';
$output .= '</tr>\n';
$output .= '<tr>\n';
$output .= '<td>&nbsp;</td>\n';
$output .= '<td>&nbsp;</td>\n';
$output .= '<td><input type="submit" name="Submit" value="Submit" /></td>\n';
$output .= '</tr></table>\n';
$output .= '</fieldset>\n';
$output .= '</form>\n';
$output .= '</td></tr>\n';
$output .= '</table>\n';

make_page ("Settings", $output);
?>