<?php
session_start ();

require ("connect_db.php");
$id = mysql_real_escape_string ($_GET["id"]);

$query = sprintf ("SELECT title, uploader, downloads FROM projects WHERE id='%s';", $id);

$result = mysql_query ($query);

if ($result)
{
  if (mysql_numrows ($result) > 0)
  {
    $row = mysql_fetch_assoc ($result);
    
    $username = $row['uploader'];
    $path = $username . "/" . $row['title'];
    
    require ("pclzip.lib.php");
    
    $zipname = $row['title'] . ".zip";
    $zipfile = new PclZip ($zipname);
    
    foreach (scandir ($path) as $file)
    {
        if ($file != '.')
	{
	    $v_list = $zipfile->add("$path/$file", PCL_OPT_REMOVE_ALL_PATH);
	    if ($v_list == 0)
            {
		require ("upper_header.php");
            	echo "Error";
            	require ("lower_header.php");
      	        require ("menu.php");
		
		die ("<br/><center>Error: " . $zipfile->errorInfo (true) . "</center>");
       	    }
	}
    }
    
    header ("Content-type: application/octet-stream");
    header ("Content-disposition: attachment; filename=$zipname");
    readfile ($zipname);
    
    unlink ($zipname);
    
  }
  else
  {
    require ("upper_header.php");
    echo "Error";
    require ("lower_header.php");
    require ("menu.php");
    
    echo "<br/><center>Project not found</center>";
  }
}
else
{
  require ("upper_header.php");
  echo "Error";
  require ("lower_header.php");
  require ("menu.php");
  
  echo mysql_error($result);
}
?>