<?php
session_start ();

require ("connect_db.php");
require ("feater.php");

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
    $path = $username . "/" . $row['title'];
    
    // create new zip archive
    $za = new ZipArchive ();
    $zipfile = $row['title'] . ".zip";
    
    if ($za->open ($zipfile, ZIPARCHIVE::OVERWRITE) !== TRUE)
    {
	make_page ("Error", "<br/>\n<center>\nCannot open <$zipfile>!\n</center>\n<br/>");
	exit ("");
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
    header("Cache-Control: no-cache, must-revalidate");
    header ("Content-disposition: attachment; filename=\"$zipfile\"");
    readfile ($zipfile);

    unlink ($zipfile);
    
    // increase download count
    $downloads = $row['downloads'];
    
    $downloads += 1;
    
    $query = sprintf ("UPDATE projects SET downloads=%d WHERE id='%s'", $downloads, $id);
    
    if (!mysql_query ($query))
    {
      make_page ("Error", mysql_error ($result));
    }
  }
  else
  {
    make_page ("Error", "<br/><center>Project not found</center>");
  }
}
else
{
  make_page ("Error", mysql_error ($result));
}
?>