<?php
/*******************************************************
termsOfService.php
Displays the Terms of Service page for RPH
********************************************************/

session_start();

require("feater.php");
head("Terms of Service");

echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
echo "<HTML>";
echo "<HEAD>";
echo 	"<META HTTP-EQUIV=\"CONTENT-TYPE\" CONTENT=\"text/html; charset=utf-8\">";
echo 	"<TITLE></TITLE>";
echo 	"<META NAME=\"GENERATOR\" CONTENT=\"OpenOffice.org 2.4  (Linux)\">";
echo 	"<META NAME=\"AUTHOR\" CONTENT=\"Dan Meretzky\">";
echo 	"<META NAME=\"CREATED\" CONTENT=\"20090411;16021800\">";
echo 	"<META NAME=\"CHANGEDBY\" CONTENT=\"Dan Meretzky\">";
echo 	"<META NAME=\"CHANGED\" CONTENT=\"20090411;18234700\">";
echo 	"";
echo 	"<STYLE TYPE=\"text/css\">";
echo 	"<!--";
echo 		"@page { size: 8.5in 11in; margin: 0.79in }";
echo 		"P { margin-bottom: 0.08in }";
echo 		"H1 { margin-bottom: 0.08in }";
echo 		"H1.western { font-family: \"Nimbus Roman No9 L\", serif }";
echo 		"H1.cjk { font-family: \"DejaVu Sans\" }";
echo 		"H1.ctl { font-family: \"DejaVu Sans\" }";
echo 		"H2 { margin-bottom: 0.08in }";
echo 	"-->";
echo 	"</STYLE>";
echo "</HEAD>";
echo "<BODY LANG=\"en-US\" DIR=\"LTR\">";
echo "<H1 CLASS=\"western\">Terms of Service</H1>";
echo "<DIV ID=\"yt-static-main-content\" DIR=\"LTR\">";
echo 	"<H2>1. Your Acceptance</H2>";
echo 	"<OL>";
echo 		"<LI><P STYLE=\"margin-bottom: 0in\">By using and/or visiting this website you signify your agreement to these terms and conditions.</P>";
echo 		"<LI><P>This page contains the most up-to-date Terms of Service for RPH.  You are responsible for adhering to all changes made to this document in the future.</P>";
echo 	"";
echo 	"</OL>";
echo 	"<H2>2. RPH Website</H2>";
echo 	"<OL>";
echo 		"<LI><P STYLE=\"margin-bottom: 0in\">These Terms of Service apply to all users of the RPH Website, including users who provide content to the Website.</P>";
echo 		"<LI><P STYLE=\"margin-bottom: 0in\">The RPH Website may contain links to third party websites.  These websites are not owned or controlled by RPH. RPH is relieved of all liability arising from your use of any third-party website, by your use of the Website.</P>";
echo 		"<LI><P STYLE=\"margin-bottom: 0in\">By uploading content onto the RPH Website you are allowing any user to copy your project for any purpose.</P>";
echo 	"</OL>";
echo 	"<H2>3. Permissions and Restrictions</H2>";
echo 	"";
echo 	"<OL>";
echo 		"<LI><P STYLE=\"margin-bottom: 0in\">The content on the RPH Website is provided to you as is for your information and personal use only and may not be sold, licensed, or otherwise exploited for any other purposes whatsoever without the prior written consent of the respective owners.</P>";
echo 		"<LI><P STYLE=\"margin-bottom: 0in\">You may not upload any content to the Website that is not your personal work or that is copyrighted in someone else's name.</P>";
echo  	"</OL>";
echo  	"<H2>4. Account Termination Policy</H2>";
echo  	"<OL>";
echo  		"<LI><P STYLE=\"margin-bottom: 0in\">RPH will terminate a User's access to this Website if, under appropriate circumstances, they are determined to be a hazard to the Website."; 
echo 		"</P>";
echo 	"";
echo 		"<LI><P>RPH reserves the right to decide whether Projects or Comments are appropriate and comply with these Terms of Service. Without prior notice, RPH may remove Projects and Comments and/or terminate a User's access.</P>";
echo 	"</OL>";
echo 	"<H2>5. Limitation of Liability</H2>";
echo 	"<P>	Use RPH at your own risk.  RPH is not liable for any offensive or harmful material that you may come in contact with while using the Website."; 
echo 	"</P>";
echo "</DIV>";
echo "</BODY>";
echo "</HTML>";

foot();

?>

