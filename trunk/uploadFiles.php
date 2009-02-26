<?php
session_start ();

require ("connect_db.php");
$username = $_SESSION['usrname'];
$MAX_FILE_SIZE = "100000";
$output = "";

$path = $username . "/" . $_POST['projectName'] . "/" . $_FILES['file']['name'];

function getSchool ($major)
{
	return "Science";
}

if ($file != none)
{
	$fileSize = $HTTP_POST_FILES['file']['size'];
	if ($fileSize > $MAX_FILE_SIZE)
	{
		$output = "Your file is too big.<br />";
		$output = $output . "Your file size is " . $filesize . "<br />";
		$output = $output . "Max file size is " . $MAX_FILE_SIZE . "<br />";
	}
	else if (copy ($HTTP_POST_FILES['file']['tmp_name'], $path))
	{
		$major = $_POST['projectMajor'];
		$result = mysql_query ("INSERT INTO projects( id, title, description, uploader, downloads, size, project_location, class, major, school )VALUES (1,'" . $_POST['projectName'] . "','" . $_POST['projectDescription'] . "','" . $username . "',0,'" . $filesize . "','" . $path . "','" . $_POST['projectClass'] . "','" . $major . "','" . getSchool($major) . "');"); 
		$output = "Upload Complete!<br />";
	}
	else
	{
		$output = "Upload failed: Copy - " . $path . " - " . $filesize;
	}
}
else
{
	$output = "Upload failed: ";
}

require ("upper_header.php");
echo "Uploading...";
require ("lower_header.php");
require ("menu.php");
echo $output;
require ("footer.php");
?>
