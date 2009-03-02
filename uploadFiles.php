<?php
session_start ();

require ("connect_db.php");
$username = $_SESSION['usrname'];
$MAX_FILE_SIZE = "100000";
$output = "";

$path = $username . "/" . $_POST["projectName"];
$filepath = $path . "/" . $HTTP_POST_FILES["file"]["name"];

function getSchool ($major)
{
	return "Science";
}

if ($file != none)
{
	$fileSize = $HTTP_POST_FILES["file"]["size"];
	if ($fileSize > $MAX_FILE_SIZE)
	{
		$output = "Your file is too big.<br />";
		$output = $output . "Your file size is " . $filesize . "<br />";
		$output = $output . "Max file size is " . $MAX_FILE_SIZE . "<br />";
	}
	else
	{
		if (!file_exists($path))
		{
			mkdir ($path, 0770, true);
		}
		if (copy ($HTTP_POST_FILES["file"]["tmp_name"], $filepath))
		{
			$id = 0;
			$major = mysql_real_escape_string ($_POST["projectMajor"]);
			$result = mysql_query ("SELECT id FROM projects");
			while ($row = mysql_fetch_assoc ($result))
			{
				if ($row["id"] >= $id)
				{
					$id = $row["id"] + 1;
				}
			}
			
			$query = sprintf ("INSERT INTO projects( id, title, description, uploader, downloads, size, project_location, class, major, school )
                                          VALUES (%d, '%s', '%s', '%s', 0, %d, '%s', '%s', '%s', '%s');", mysql_real_escape_string ($id),
					  mysql_real_escape_string ($_POST["projectName"]), mysql_real_escape_string ($_POST["projectDescription"]),
                     			  mysql_real_escape_string ($username), mysql_real_escape_string ($filesize), mysql_real_escape_string ("download.php?id=" . $id),
					  mysql_real_escape_string ($_POST["projectClass"]), $major, getSchool($major));
			
			if (mysql_query ($query))
			{
				$output = "Upload Complete!<br />";
			}
			else
			{
				$output = "Upload Half Complete: File created, not entered into database: " . mysql_error ();
			}
		}
		else
		{
			$output = "Upload failed: Copy - " . $path . " - " . $filesize;
		}
	}
}
else
{
	$output = "Upload failed: File was empty";
}

require ("upper_header.php");
echo "Uploading...";
require ("lower_header.php");
require ("menu.php");
echo $output;
require ("footer.php");
?>
