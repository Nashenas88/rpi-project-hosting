<?php
/*******************************************************
uploadFiles.php
Allows an RPI user to upload a file to the database
********************************************************/

session_start ();

require ("feater.php");

$_SESSION['message'] = '';

$reload = false;

if (empty ($_SESSION['username']))
{
    make_page ("Error", "<br/><center>You must be logged in to access this page!</center><br/>");
    exit;
}

if (empty ($_POST['projectName']))
{
	$_SESSION['message'] .= "<br/><center>You must have a name for your project!</center><br/>";
	$reload = true;
}
else
{
	$_SESSION['projectName'] = $_POST['projectName'];
}

if (empty ($_POST['projectAuthor']))
{
        $_SESSION['message'] .= "<br/><center>You must write in at least one author for your project!</center><br/>";
	$reload = true;
}
else
{
        $_SESSION['projectAuthor'] = $_POST['projectAuthor'];
}

if (isset ($_POST['projectDescription']))
{
	$_SESSION['projectDescription'] = $_POST['projectDescription'];
}

if (empty ($_POST['projectIsForClass']))
{
        $_SESSION['message'] .= "<br/><center>You must select whether or not the project is for a class</center><br/>";
	$reload = true;
}
else
{
        $_SESSION['isForClass'] = $_POST['projectIsForClass'];
}

if ($_POST['projectIsForClass'] == "yes" && empty ($_POST['projectClass']))
{
        $_SESSION['message'] .= "<br/><center>If your project is for a class, you must enter in a class name!</center><br/>";
        $reload = true;
}
else
{
        $_SESSION['projectClass'] = $_POST['projectClass'];
}

if ($_POST['projectIsForClass'] == "yes" && empty ($_POST['projectMajor']))
{
        $_SESSION['message'] .= "<br/><center>If your project is for a class you must select the major for the class. For example,
		  	   		 select CSCI if the class is CSCI-1200</center><br/>";
        $reload = true;
}
else
{
        $_SESSION['projectMajor'] = $_POST['projectMajor'];
}

if (empty ($_FILES["file1"]["name"]) && empty ($_FILES["file2"]["name"]) &&
    empty ($_FILES["file3"]["name"]) && empty ($_FILES["file4"]["name"]))
{
        $_SESSION['message'] .= "<br/><center>You must select at least one file to upload for your project!</center><br/>";
	$reload = true;
}

if ($reload)
{
	header ("Location: upload.php");
	exit;
}



require ("connect_db.php");
$username = $_SESSION['username'];
$MAX_FILE_SIZE = "1048576"; // 1MB
$output = "";
$path = "uploads/" . $username . "/" . $_POST["projectName"];

function getSchool ($major)
{
    if ($major == "ASTR" || $major == "BCBP" ||
        $major == "BIOL" || $major == "CHEM" ||
	$major == "CSCI" || $major == "ERTH" ||
	$major == "MATH" || $major == "MATP" ||
	$major == "PHYS")
    {
	return "Science";
    }
    else if ($major == "ARCH" || $major == "LGHT")
    {
	return "Architecture";
    }
    else if ($major == "BMED" || $major == "CHME" ||
    	     $major == "CIVL" || $major == "DSES" ||
	     $major == "ECSE" || $major == "ENGR" ||
	     $major == "ENVE" || $major == "EPOW" ||
	     $major == "MANE" || $major == "MTLE")
    {
	return "Engineering";
    }
    else if ($major == "MGMT")
    {
	return  "Business";
    }
    else if ($major == "ITEC")
    {
	return "IT";
    }
    else if ($major == "ARTS" || $major == "COGS" ||
    	     $major == "COMM" || $major == "IHSS" ||
	     $major == "LITR" || $major == "PHIL" ||
	     $major == "PSYC" || $major == "WRIT" ||
	     $major == "ECON")
    {
	return "Humanities and Social Sciences";
    }
    else
    {
	return "";
    }
}

// Check to make sure that current user has not already created a project with the same name
$query = sprintf ("SELECT id FROM projects WHERE uploader='%s' AND title='%s'", mysql_real_escape_string ($username),
                   mysql_real_escape_string ($_POST["projectName"]));

$result = mysql_query ($query);

if (!$result)
{
    $output .= mysql_error ();
    exit;
}

unset ($_SESSION['projectName']);
unset ($_SESSION['projectAuthor']);
unset ($_SESSION['projectDescription']);
unset ($_SESSION['isForClass']);
unset ($_SESSION['projectClass']);
unset ($_SESSION['projectMajor']);

$matches = mysql_numrows ($result);
$output = "";

// check to make sure the project name is less than 50 characters
// and the project description is less than 500 characters
if( strlen($_POST["projectName"]) > 50 || strlen($_POST["projectDescription"]) > 500 ||
	strlen($_POST["projectAuthor"]) > 300 || strlen($_POST["projectClass"]) > 200)
{
	if( strlen($_POST["projectName"]) > 50 ) 
	{
		$output .= "Project name is too long. <br/>";
		$output .= "Project name cannot exceed 50 characters.<br/>";
	}
	if( strlen($_POST["projectDescription"]) > 500 )
	{
		$output .= "Project description is too long. <br/>";
		$output .= "Project description cannot exceed 500 characters.<br/>";
	}
	if( strlen($_POST["projectAuthor"]) > 300 )
	{
		$output .= "Project Creator is too long. <br/>";
		$output .= "Project Creator cannot exceed 300 characters.<br/>";
	}
	if( strlen($_POST["projectClass"]) > 200 )
	{
		$output .= "Project Class is too long. <br/>";
		$output .= "Project Class cannot exceed 200 characters.<br/>";
	}
}
// check to make sure user has not uploaded a file with the same name
else if ($matches > 0)
{
	$output = "Upload Failed: You already have a project with the same name";
}
else
{
	$size = 0;
	
	if (!file_exists($path))
        {
                mkdir ($path, 0770, true);
        }
	
	for ($i = 1; $i < 5; ++$i)
	{
		if ($_FILES["file$i"] != none && !empty ($_FILES["file$i"]["name"]))
   		{
			$filesize = $_FILES["file$i"]["size"];
		
			// check to make sure the file does not exceed the maximum size
			if ($fileSize > $MAX_FILE_SIZE)
	   		{
				$output .= $_FILES["file$i"]["name"] . " is too big.<br />";
				$output .= "Max file size is " . $MAX_FILE_SIZE . " bytes.<br />";
			}
			else
			{
				$size += $filesize;
				$filepath = $path . "/" . $_FILES["file$i"]["name"];
				
				if (!copy ($_FILES["file$i"]["tmp_name"], $filepath))
				{
					$output .= "Upload failed: Copy - " . $path . " - " . $filesize . "<br/>";
				}
			}
		}
	}
    
        $id = 0;
	$major = mysql_real_escape_string (htmlentities (stripslashes ($_POST["projectMajor"]), ENT_QUOTES));
	
	$query = sprintf ("INSERT INTO projects( title, description, authors, uploader, downloads, size, class, major, school )
                           VALUES ('%s', '%s', '%s', '%s', 0, %d, '%s', '%s', '%s');",
			   mysql_real_escape_string (htmlentities (stripslashes ($_POST["projectName"]), ENT_QUOTES)),
			   mysql_real_escape_string (htmlentities (stripslashes ($_POST["projectDescription"]), ENT_QUOTES)),
			   mysql_real_escape_string (htmlentities (stripslashes ($_POST["projectAuthor"]), ENT_QUOTES)),
                           mysql_real_escape_string ($username), $size,
                           mysql_real_escape_string (htmlentities (stripslashes ($_POST["projectClass"]), ENT_QUOTES)), $major, getSchool($major));
			   
	if (!mysql_query ($query))
        {
		$output .= "Upload Failed: could not enter data into the database: " . mysql_error () . "<br/>";
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
                                $output .= "Upload Failed: No download link was created<br/>";
                        }
                        else
                        {
                                $output .= "Upload Complete!<br/>";
                        }
                }
		else
                {
                        $output .= "Upload Failed: Could not locate project after it was inserted into the database" . mysql_error () . "<br/>";
                }
        }
}

/*
head("Uploading...");

echo "<br/><center>$output</center><br/>";

foot();
*/

$_SESSION['message'] = $output;

header ("Location: index.php");

?>
