<?php
/*******************************************************
helpQuestions.php
Displays the FAQ page for RPH
********************************************************/

session_start();

require("feater.php");
head("FAQ");

echo "<h2>RPH FAQs</h2>";
echo "<p>---------------------------------------</p>"; 
echo "<p><b>Q:</b> How do I login?</p>";
echo "<p><b>A:</b> To login, click the Login button on the top menu.  Then enter your RCS username and password.  Finally, click \"Login\".</p>";
echo "<p>---------------------------------------</p>";
echo "<p><b>Q:</b> How do I upload a project?</p>";
echo "<p><b>A:</b> First off, you must be logged in to upload a project.  Once logged in, click the Upload button on the top menu. Then, fill out all the necessary forms including 1-4 files that you wish to upload.  Finally, click \"Upload\".</p>";
echo "<p>---------------------------------------</p>";
echo "<p><b>Q:</b> How do I download a project?</p>";
echo "<p><b>A:</b> To download, first find the project you wish to download either on the Homepage or the Search page.  Finally, click \"Download Link\" under the \"Link\" column.</p>";
echo "<p>---------------------------------------</p>";
echo "<p><b>Q:</b> I found a bug, what should I do?</p>";
echo "<p><b>A:</b> If at any time you find an error with the website or have any further questions or issues go to the About page by clicking \"About\" on the top menu.  Then write an email explaining in detail your concern to one of the Admin's emails listed at the bottom.</p>";
echo "<p>---------------------------------------</p>";
echo "<p><b>Q:</b> Where do I comment on a project?</p>";
echo "<p><b>A:</b> To comment a project, simply find the project you wish to comment, click the project's title link, and enter your comment at the bottom of the page.</p>";
echo "<p>---------------------------------------</p>";
echo "<p><b>Q:</b> Am I liable for what I upload?</p>";
echo "<p><b>A:</b> Under our <a href=\"termsOfService.php\">Terms of Service</a>, you are liable and responsible for any content that you upload.</p>";
echo "<p>---------------------------------------</p>";
echo "<p><b>Q:</b> How do I remove my project?</p>";
echo "<p><b>A:</b> If you wish to remove a project that you uploaded, click on the project's title link, and click the \"Remove\" button underneath the project's rating information.</p>";
echo "<p>---------------------------------------</p>";

if( getPriviledge() <= 1 )
{
	echo "<p><b>Q:</b> How do I ban a user?</p>";
	echo "<p><b>A:</b> To ban a user, click the \"Moderate\" button on the top menu.  Then enter the username of the user you wish to ban in the ban form.  Make sure the action is set to ban, and click \"Update\".</p>";
	echo "<p>---------------------------------------</p>";

	if( getPriviledge() == 0 )
	{
		echo "<p><b>Q:</b> How do I change a user's privilege level?</p>";
		echo "<p><b>A:</b> To change a user's privilege, click the \"Moderate\" button on the top menu.  Then enter the username of the user you wish to change in the privilege form.  Make sure the action is set to the desired privilege level, and click \"Update\".</p>";
		echo "<p>---------------------------------------</p>";
	}
}

foot();

?>
