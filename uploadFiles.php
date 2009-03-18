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

// Check to make sure that current user has not already created a project with the same name
$query = sprintf ("SELECT id FROM projects WHERE uploader='%s' AND title='%s'", mysql_real_escape_string ($username),
                   mysql_real_escape_string ($_POST["projectName"]));

$result = mysql_query ($query);

if (!$result)
{
    echo mysql_error ();
    exit;
}

$matches = mysql_numrows ($result);

if ($matches > 0)
{
	$output = "Upload Failed: You already have a project with the same name";
}
else
{
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
			
				//
				$query = sprintf ("INSERT INTO projects( title, description, uploader, downloads, size, class, major, school )
                                          VALUES ('%s', '%s', '%s', 0, %d, '%s', '%s', '%s');", mysql_real_escape_string ($_POST["projectName"]),
					  mysql_real_escape_string ($_POST["projectDescription"]), mysql_real_escape_string ($username),
					  mysql_real_escape_string ($filesize), mysql_real_escape_string ($_POST["projectClass"]), $major,
					  getSchool($major));
				
				if (!mysql_query ($query))
			   	{
					$output = "Upload Half Complete: File created, not entered into database: " . mysql_error ();
				}
				else
				{
					$query = sprintf ("SELECT id FROM projects WHERE title='%s' AND uploader='%s'",
					       	 	   mysql_real_escape_string ($_POST["projectName"]), mysql_real_escape_string ($username));
					$result = mysql_query ($query);
					if ($result)
					{
						$row = mysql_fetch_assoc ($result);
					       	$query = sprintf ("UPDATE projects SET project_location='%s' WHERE id=%d",
					       	 	   	   mysql_real_escape_string ("download.php?id=". $row["id"]), $row["id"]);
						if (!mysql_query ($query))
					   	{
							$output = "Upload Half Complete: No download link was created";
						}
						else
						{
							$output = "Upload Complete!";
						}
					}
					else
					{
						$output = "Upload Half Complete: Could not locate project after it was inserted into the database" . mysql_error ();
					}
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
}

require ("upper_header.php");
echo "Uploading...";
require ("lower_header.php");
require ("menu.php");
echo $output;
require ("footer.php");
?>
