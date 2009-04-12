<?php
/*******************************************************
upload.php
Displays the upload form for uploading projects
********************************************************/

session_start ();
require ("feater.php");
head("Upload");

if ($_SESSION['username']== null)
{
  make_page ("Error", "<br />\n<center>\nYou must be logged in to access this page!\n</center>\n<br />");
  exit ();
}

echo "<table width=\"500\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FFFFFF\">\n";
echo "<tr><td>\n";
echo "<form name=\"upload\" method=\"post\" action=\"uploadFiles.php\" enctype=\"multipart/form-data\">\n";
echo "<fieldset>\n";
echo "<legend><strong>Upload</strong></legend>\n";
echo "<table width=\"490\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" bgcolor=\"#FFFFFF\">\n";
echo "\n";
echo "<!-- Print Errors -->\n";
echo "\n";
echo "<!-- Project Name -->\n";
echo "<tr>\n";
echo "<td>Project Name</td>\n";
echo "<td>:</td>\n";
echo "<td><input name=\"projectName\" type=\"text\" id=\"projectName\" />\n";
echo "</td>\n";
echo "</tr>\n";
echo "\n";
echo "<!-- Name -->\n";
echo "<tr>\n";
echo "<td>Project Author(s)</td>\n";
echo "<td>:</td>\n";
echo "<td><input type=text name=\"projectAuthor\" size=\"20\" /></td>\n";
echo "</tr>\n";
echo "\n";
echo "<!-- Description -->\n";
echo "<tr>\n";
echo "<td>Project Description</td>\n";
echo "<td>:</td>\n";
echo "<td><textarea name=\"projectDescription\" cols=\"35\" rows=\"4\" ></textarea></td>\n";
echo "</tr>\n";
echo "\n";
echo "<!-- Is It For A Class -->\n";
echo "<tr>\n";
echo "<td>Was this project created for a class?</td>\n";
echo "<td>:</td>\n";
echo "<td><input type=radio name=\"projectIsForClass\" value=\"yes\" checked/> yes\n";
echo "    <input type=radio name=\"projectIsForClass\" value=\"no\" /> no </td>\n";
echo "</tr>\n";
echo "\n";
echo "\n";
echo "<!-- Class Name -->\n";
echo "<tr>\n";
echo "<td>Class Name</td>\n";
echo "<td>:</td>\n";
echo "<td><input type=text name=\"projectClass\" size=\"20\" /></td>\n";
echo "</tr>\n";
echo "\n";
echo "<!-- Major -->\n";
echo "<tr>\n";
echo "<td>Related Major</td>\n";
echo "<td>:</td>\n";
echo "<td><input type=text name=\"projectMajor\" size=\"20\" /></td>\n";
echo "</tr>\n";
echo "\n";
echo "<!-- Upload File -->\n";
echo "<tr>\n";
echo "<td>Choose a file to upload</td>\n";
echo "<td>:</td>\n";
echo "<td><input name=\"file\" type=\"file\" /></td>\n";
echo "</tr>\n";
echo "\n";
echo "<!-- Upload Picture -->\n";
echo "<!--<tr>\n";
echo "<td>Choose a picture to upload</td>\n";
echo "<td>:</td>\n";
echo "<td><input name=\"uploadedPic\" type=\"file\" /></td>\n";
echo "</tr>!-->\n";
echo "\n";
echo "<!-- Submit -->\n";
echo "<tr>\n";
echo "<td>&nbsp;</td>\n";
echo "<td>&nbsp;</td>\n";
echo "<td><input type=\"submit\" name=\"Submit\" value=\"Upload\" /></td>\n";
echo "</tr>\n";
echo "\n";
echo "<!-- Terms of Service -->\n";
echo "<tr>\n";
echo "<td colspan=\"3\">\n";
echo "<p style=\"font-size:12px\">By uploading files you certify that you have the right to distribute these files and that it does not violate the <a href=\"termsOfService.php\">Terms of Service</a>.</p>\n";
echo "</td>\n";
echo "</tr>\n";
echo "\n";
echo "</table>\n";
echo "</fieldset>\n";
echo "</form>\n";
echo "</td></tr>\n";
echo "</table>\n";
echo "Note: Max file size is 1MB.\n";
echo "<br />\n";

foot();

?>
