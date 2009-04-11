$output .= "<form name='ban' method='POST' action='moderate.php'>";
$output .= "Username:&nbsp;&nbsp;&nbsp;&nbsp;<input name='username' id='input' type='text'\>";
$output .= "By:&nbsp;&nbsp;&nbsp;&nbsp;<select name='ban_unban'>";
$output .= "<option value="ban">Ban</option>";
$output .= "<option value="unban">Unban</option>";
$output .= "</select>";
$output .= "&nbsp;&nbsp;<input type='submit' value='Update'\>";
$output .= "</form>";