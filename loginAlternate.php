<?php
session_start ();
require ("feater.php");

$output = "<align=\"left\">\n<br />\n";
$output .= '<table width="310" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">';
$output .= '<tr><td>';
$output .= '<form name="login" method="post" action="checkLogin.php">';
$output .= '<fieldset>';
$output .= '<legend><strong>Login</strong></legend>';
$output .= '<table width="300" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">';
$output .= '<tr>';
$output .= '<td>Username</td>';
$output .= '<td>:</td>';
$output .= '<td><input name="username" type="text" id="username" /></td>';
$output .= '</tr>';
$output .= '<tr>';
$output .= '<td>Password</td>';
$output .= '<td>:</td>';
$output .= '<td><input name="pass" type="password" id="pass" /></td>';
$output .= '</tr>';
$output .= '<tr>';
$output .= '<td>&nbsp;</td>';
$output .= '<td>&nbsp;</td>';
$output .= '<td><input type="submit" name="Submit" value="Login" /></td>';
$output .= '</tr></table>';
$output .= '</fieldset>';
$output .= '</form>';
$output .= '</td></tr>';
$output .= '</table>';

$output .= "</align>";

make_page ("Login", $output);
?>