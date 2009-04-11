<?php
session_start ();
require ("upper_header.php");
echo "About";
require ("lower_header.php");
require ("menu.php");
echo "<br />\n";
?>
<img src="images/RPH.png" width='10%' height='10%'>
<br>
<br>
RPH is a project hosting site for RPI students. Students are able to log in to the website using their RCS IDs and Passwords.
<br>
Once logged in, students will be able to post their completed projects for everyone to see.
<br>
Projects may include anything from a CS1 class homework to a video game to a photograph.
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
<br>
Dan Meretzky
<br>
Paul Faria";

<?php
require ("footer.php");
?>