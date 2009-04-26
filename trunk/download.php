<?php
/*******************************************************************
download.php
Allows user to download a project from the server
********************************************************************/

session_start ();

require_once ("connect_db.php");
require_once ("feater.php");

function download ()
{
// get project id
$id = mysql_real_escape_string ($_GET["id"]);

// use project id to get data from database
$query = sprintf ("SELECT title, uploader, downloads FROM projects WHERE id='%s';", $id);

$result = mysql_query ($query);

if ($result)
{
  if (mysql_numrows ($result) > 0)
  {
    $row = mysql_fetch_assoc ($result);
    
    $username = $row['uploader'];
    $path = "uploads/" . $username . "/" . $row['title'];
    
    // create new zip archive
    $za = new ZipArchive ();
    $zipfile = $row['title'] . ".zip";
    
    // open a file archive
    if ($za->open ($zipfile, ZIPARCHIVE::OVERWRITE) != TRUE)
    {
	make_page ("Error", "<br/>\n<center>\nCannot open <$zipfile>!\n</center>\n<br/>");
	//exit;
    }
    
    // add contents of project to zip archive
    foreach (scandir ($path) as $file)
    {
      if ($file[0] != "." && $file != $zipfile)
      {
	$za->addFile ("$path/$file", "$file");
      }
    }
    
    $za->close ();
    
    // send header information
    header ("Content-type: application/octet-stream");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Content-disposition: attachment; filename=\"$zipfile\"");
    readfile ($zipfile);

    unlink ($zipfile);
    
    // increase download count
    $downloads = $row['downloads'];
    
    $downloads += 1;
    
    $query = sprintf ("UPDATE projects SET downloads=%d WHERE id='%s'", $downloads, $id);
    
    if (!mysql_query ($query))
    {
      head ("Error");
      echo mysql_error ($result);
      foot ();
      //exit;
    }
  }
  else
  {
    head ("Error");
    $_SESSION['test'] = "<br/><center>Project not found.</center>";
    echo $_SESSION['test'];
    foot ();
    //exit;
  }
}
else
{
  make_page ("Error", mysql_error ($result));
  //exit;
}
}
download ();
?>
