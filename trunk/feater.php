<?php
/*******************************************************************
feater.php
head(string) - prints the header to the page
foot() - prints the footer to the page
********************************************************************/

function make_page ($title, $body)
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
<meta name="author" content="root"/>
<meta name="author" content="root"/>
<meta name="author" content="root"/>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>RPI Project Hosting | <?php echo $title;?></title>
</head>

<body id="background" BGPROPERTIES=FIXED >

<?php
require ("menu.php");
echo $body;
?>
<br /><br /><center>This page is licensed under the <a href=http://www.gnu.org/licenses/gpl.html>GNU General Public License v3</a></center><br />
</body>

</html>
<?php
}

// adds a header to the page
function head ($title)
{
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"';
	echo '"http://www.w3.org/TR/html4/strict.dtd">';
	echo '<html>';
	echo '';
	echo '<head>';
	echo '<meta name="author" content="root"/>';
	echo '<meta name="author" content="root"/>';
	echo '<meta name="author" content="root"/>';
	echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />';

	echo '<title>RPI Project Hosting | ';
	echo $title;
	echo '</title>';
	echo '</head>';
	echo '';
	echo '<body style="background:url(images/background.jpg); background-attachment: scroll">';

   require ("menu.php");
}

// adds a footer to the page
function foot ()
{
	echo '<br /><br /><center>This page is licensed under the <a href=http://www.gnu.org/licenses/gpl.html>GNU General Public License v3</a></center><br />';
	echo '</body>';
	echo '';
	echo '</html>';
}



?>
