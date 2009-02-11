<?php
session_start ();
require ("upper_header.php");
echo "Upload";
require ("lower_header.php");
require ("menu.php");
require ("uploadForm.php");
echo "<br />Note: files will upload, but the files will not be saved to the<br/>";
echo "server. This feature has not yet been impleneted. However, since<br />";
echo "the files do upload, you will have to wait as it is sent from<br />";
echo "your computer to the server if you press the upload button.";
require ("footer.php");
?>
