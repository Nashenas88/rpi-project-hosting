<?php
/*******************************************************
helpQuestions.php
Displays the FAQ page for RPH
********************************************************/

session_start();

require("feater.php");
head("FAQ");
?>

<h2>FAQ</h2>

<a href="#login"> How do I login?</a><br />
<a href="#upload"> How do I upload a project?</a><br />
<a href="#download"> How do I download a project?</a><br />
<a href="#bug"> I found a bug, what should I do?</a><br />
<a href="#comment"> Where do I comment on a project?</a><br />
<a href="#liable"> Am I liable for what I upload?</a><br />
<a href="#removeProject"> How do I remove my project?</a><br />
<a href="#copyright">Do I retain the copyright to my uploads?</a><br />
<a href="#otherCopyright">May I upload another person's project?</a><br />

<p>---------------------------------------</p>
<a name="login">
<p><b>Q:</b> How do I login?</p>
<p><b>A:</b> To login, click the Login button on the top menu.  Then enter your RCS username and password.  Finally, click "Login".</p></a>
<p>---------------------------------------</p>
<a name="upload">
<p><b>Q:</b> How do I upload a project?</p>
<p><b>A:</b> First off, you must be logged in to upload a project.  Once logged in, click the Upload button on the top menu. Then, fill out all the necessary forms including 1-4 files that you wish to upload.  Finally, click "Upload".</p></a>
<p>---------------------------------------</p>
<a name="download">
<p><b>Q:</b> How do I download a project?</p>
<p><b>A:</b> To download, first find the project you wish to download either on the Homepage or the Search page.  Finally, click "Download Link" under the "Link" column.</p></a>
<p>---------------------------------------</p>
<a name="bug">
<p><b>Q:</b> I found a bug, what should I do?</p>
<p><b>A:</b> If at any time you find an error with the website or have any further questions or issues go to the About page by clicking "About" on the top menu.  Then write an email explaining in detail your concern to one of the Admin's emails listed at the bottom.</p></a>
<p>---------------------------------------</p>
<a name="comment">
<p><b>Q:</b> Where do I comment on a project?</p>
<p><b>A:</b> To comment a project, simply find the project you wish to comment, click the project's title link, and enter your comment at the bottom of the page.</p></a>
<p>---------------------------------------</p>
<a name="liable">
<p><b>Q:</b> Am I liable for what I upload?</p>
<p><b>A:</b> Under our <a href="termsOfService.php">Terms of Service</a>, you are liable and responsible for any content that you upload.</p></a>
<p>---------------------------------------</p>
<a name="removeProject">
<p><b>Q:</b> How do I remove my project?</p>
<p><b>A:</b> If you wish to remove a project that you uploaded, click on the project's title link, and click the "Remove" button underneath the project's rating information.</p></a>
<p>---------------------------------------</p>
<a name="copyright">
<p><b>Q:</b> Do I retain the copyright to my uploads?</p>
<p><b>A:</b> You will retain your ownership of the copyright when your project is uploaded. By uploading to RPH you agree to allow reproduction, derivative works, distribution, public display, public performances of your project. Essentially, you agree to releasing your project with a Creative Commons or Open Source type of liscense.</p></a>
<p>---------------------------------------</p>
<a name="otherCopyright">
<p><b>Q:</b> May I upload another person's project?</p>
<p><b>A:</b> You may only upload other people's copyrighted works if the liscense permits you to do this.</p></a>
<p>---------------------------------------</p>


<?php

if( getPriviledge() <= 1 )
{
?>
	<p><b>Q:</b> How do I ban a user?</p>
	<p><b>A:</b> To ban a user, click the "Moderate" button on the top menu.  Then enter the username of the user you wish to ban in the ban form.  Make sure the action is set to ban, and click "Update".</p>
	<p>---------------------------------------</p>
<?php
	if( getPriviledge() == 0 )
	{
?>
		<p><b>Q:</b> How do I change a user's privilege level?</p>
		<p><b>A:</b> To change a user's privilege, click the "Moderate" button on the top menu.  Then enter the username of the user you wish to change in the privilege form.  Make sure the action is set to the desired privilege level, and click "Update".</p>
		<p>---------------------------------------</p>
<?php
	}
}

foot();

?>
