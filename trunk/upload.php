<?php
/*******************************************************
upload.php
Displays the upload form for uploading projects
********************************************************/

session_start ();
require ("feater.php");
head("Upload");

if (empty ($_SESSION['username']))
{
  make_page ("Error", "<br />\n<center>\nYou must be logged in to access this page!\n</center>\n<br />");
  exit ();
}

?>

<table width="500" border="0" cellpadding="0" cellspacing="0">
<tr><td>
<form name="upload" method="post" action="uploadFiles.php" enctype="multipart/form-data">
<fieldset>
<legend><strong>Upload</strong></legend>
<table width="490" border="0" cellpadding="3" cellspacing="1">

<!-- Project Name -->
<tr>
<td>Project Name</td>
<td>:</td>
<td><input name="projectName" type="text" id="projectName" />
</td>
</tr>

<!-- Name -->
<tr>
<td>Project Author(s)</td>
<td>:</td>
<td><input type=text name="projectAuthor" size="20" /></td>
</tr>

<!-- Description -->
<tr>
<td>Project Description</td>
<td>:</td>
<td><textarea name="projectDescription" cols="35" rows="4" ></textarea></td>
</tr>

<!-- Is It For A Class -->
<tr>
<td>Was this project created for a class?</td>
<td>:</td>
<td><input type=radio name="projectIsForClass" value="yes" checked="checked"/> yes
    <input type=radio name="projectIsForClass" value="no" /> no </td>
</tr>


<!-- Class Name -->
<tr>
<td>Class Name</td>
<td>:</td>
<td><input type=text name="projectClass" size="20" /></td>
</tr>

<!-- Major -->
<tr>
<td>Related Major</td>
<td>:</td>
<td><!--<input type=text name="projectMajor" size="20" />-->
<select name="projectMajor">
  <option value="">--Select Major--</option>
  <option value="ADMN">ADMN</option>
  <option value="ARCH">ARCH</option>
  <option value="ARTS">ARTS</option>
  <option value="ASTR">ASTR</option>
  <option value="BCBP">BCBP</option>
  <option value="BIOL">BIOL</option>
  <option value="BMED">BMED</option>
  <option value="CHEM">CHEM</option>
  <option value="CHME">CHME</option>
  <option value="CIVL">CIVL</option>
  <option value="COGS">COGS</option>
  <option value="COMM">COMM</option>
  <option value="CSCI">CSCI</option>
  <option value="DSES">DSES</option>
  <option value="ECON">ECON</option>
  <option value="ECSE">ECSE</option>
  <option value="ENGR">ENGR</option>
  <option value="ENVE">ENVE</option>
  <option value="EPOW">EPOW</option>
  <option value="ERTH">ERTH</option>
  <option value="IHSS">IHSS</option>
  <option value="ISCI">ISCI</option>
  <option value="ITEC">ITEC</option>
  <option value="LGHT">LGHT</option>
  <option value="LITR">LITR</option>
  <option value="MANE">MANE</option>
  <option value="MATH">MATH</option>
  <option value="MATP">MATP</option>
  <option value="MGMT">MGMT</option>
  <option value="MTLE">MTLE</option>
  <option value="PHIL">PHIL</option>
  <option value="PHYS">PHYS</option>
  <option value="PSYC">PSYC</option>
  <option value="STSH">STSH</option>
  <option value="STSS">STSS</option>
  <option value="USAF">USAF</option>
  <option value="USAR">USAR</option>
  <option value="USNA">USNA</option>
  <option value="WRIT">WRIT</option>
</select>
</td>
</tr>

<!-- Upload File -->
<tr>
<td>Choose a file to upload</td>
<td>:</td>
<td><input name="file" type="file" /></td>
</tr>

<!-- Upload Picture -->
<!--<tr>
<td>Choose a picture to upload</td>
<td>:</td>
<td><input name="uploadedPic" type="file" /></td>
</tr>!-->

<!-- Submit -->
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Upload" /></td>
</tr>

<!-- Terms of Service -->
<tr>
<td colspan="3">
<p style="font-size:12px">By uploading files you certify that you have the right to distribute these files and that it does not violate the <a href="termsOfService.php">Terms of Service</a>.</p>
</td>
</tr>

</table>
</fieldset>
</form>
</td></tr>
</table>
Note: Max file size is 1MB.
<br />

<?php
foot();
?>
