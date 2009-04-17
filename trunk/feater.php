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
<link href="default.css" rel="stylesheet" type="text/css" />
<title>RPI Project Hosting | <?php echo $title;?></title>
</head>

<body background="images/background.jpg">
<div id="header">
	<div id="logo">
		<h1>RPH Project Hosting</h1>
	</div>
	<div id="menu">
<?php
require ("menu.php");
//echo $body;
?>
</div>
</div>
<div id="page">
	<!-- start content -->
	<div id="content">
		<!-- start latest-post -->
		<div id="latest-post" class="post">
			<h1 class="title">Welcome to Our Website!</h1>
<?php
//require ("menu.php");
echo $body;
?>
		</div>
	</div>
</div>
	<div id="sidebar">
		<div style="clear: both;">&nbsp;</div>
	</div>
<div id="footer-bg">
<div id="footer">
	<p id="legal">Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a> This page is licensed under the <a href=http://www.gnu.org/licenses/gpl.html>GNU General Public License v3</a></p>
</div>
</div>
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
	echo '<link href="default.css" rel="stylesheet" type="text/css" />';
	echo '<title>RPI Project Hosting | ';
	echo $title;
	echo '</title>';
	echo '</head>';
	echo '';
	echo '<body>';
	echo "<div id='header'>";
	echo "<div id=\"logo\">";
	echo "<h1>RPI Project Hosting</h1>";
	echo "</div>";
	echo "<div id=\"menu\">";
	require ("menu.php");
	echo "</div>";
	echo "</div>";
	echo "<div id=\"page\">";
	echo "<div id='content'>";
	echo "<div id='latest-post' class='post'>";
}

// adds a footer to the page
function foot ()
{
?>
	</div>
	</div>
	</div>
	<div id="sidebar">
		<div style="clear: both;">&nbsp;</div>
	</div>
	
	<div id="footer-bg" align="center">
	<div id="footer">
	<p>Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates	</a><br />This page is licensed under the <a href=http://www.gnu.org/licenses/gpl.html>GNU General Public License v3</a></p>
	</div>
	</div>
	
<?php
	echo '</body>';
	echo '';
	echo '</html>';
}



?>
