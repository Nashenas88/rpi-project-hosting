<?php

function make_page ($title, $body)
{
  echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"\n';
  echo '"http://www.w3.org/TR/html4/strict.dtd">\n';
  echo '<html>\n';
  echo '\n';
  echo '<head>\n';
  echo '<meta name="author" content="Paul Faria" />\n';
  echo '<meta name="author" content="Alex Mattern" />\n';
  echo '<meta name="author" content="Jin Zheng" />\n';
  echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />\n';
  echo '<title>RPI Project Hosting | ';
  echo $title;
  echo '</title>\n';
  echo '</head>\n';
  echo '\n';
  echo '<body>\n';
  echo $body;
  echo '</body>\n';
  echo '\n';
  echo '</html>\n';
}
?>