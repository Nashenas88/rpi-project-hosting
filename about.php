<?php
/****************************************************
about.php
Creates a page called 'About' with the html provided.
****************************************************/
session_start (); 

require ("feater.php");
head("About");

?>
<table><tr><td>
<br />
<img src="images/RPH.png" width='10%' height='10%'>
<br>
<br>
RPH is a project hosting site for RPI students. Students are able to log in to the website using their RCS IDs and Passwords.
<br>
Once logged in, students will be able to post their completed projects for everyone to see.
<br>
Projects may include anything from a CS1 class homework to a video game or even a photograph.
<br>
<br>
RPH was started as a project for the Software Design and Documentation class.
<br>
<br>
Admins and Contributors:
<br>
Alex Mattern
<br>
Jin Guang Zheng
<a href="mailto:zhengj3@rpi.edu">zhengj3@rpi.edu</a>
<br>
Dan Meretzky
<a href="mailto:meretd@rpi.edu">meretd@rpi.edu</a>
<br>
Paul Faria
<a href="mailto:fariap@rpi.edu">fariap@rpi.edu</a>
</td></tr></table>
<?php

foot();

?>
