<?php

require ("priviledge.php");

function make_page ($title, $body)
{
  echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"';
  echo '"http://www.w3.org/TR/html4/strict.dtd">';
  echo '<html>';
  echo '';
  echo '<head>';
  echo '<meta name="author" content="Paul Faria" />';
  echo '<meta name="author" content="Alex Mattern" />';
  echo '<meta name="author" content="Jin Zheng" />';
  echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />';
  echo '<title>RPI Project Hosting | ';
  echo $title;
  echo '</title>';
  echo '</head>';
  echo '';
  echo '<body background="river.jpg">';
  
  require ("menu.php");
  
  echo $body;
  echo '</body>';
  echo '';
  echo '</html>';
}
?>
