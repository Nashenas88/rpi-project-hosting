<?php
/*******************************************************
upload.php
Displays the upload form for uploading projects
********************************************************/

session_start ();
require ("feater.php");

if (empty ($_SESSION['username']))
{
  make_page ("Error", "<br />\n<center>\nYou must be logged in to access this page!\n</center>\n<br />");
  exit ();
}

head ("Upload");

if (isset ($_SESSION['message']))
{
	echo $_SESSION['message'];
	unset ($_SESSION['message']);
}
?>

<table width="500" border="0" cellpadding="0" cellspacing="0">
<tr><td>
<form name="upload" method="post" action="uploadFiles.php" enctype="multipart/form-data">
<fieldset>
<legend><h2>Upload</h2></legend>
<table width="490" border="0" cellpadding="3" cellspacing="1">

<!-- Project Name -->
<tr>
<td>Project Name</td>
<td>:</td>
<td><input name="projectName" type="text" id="projectName" value="<?php echo isset($_SESSION["projectName"]) ? $_SESSION["projectName"] : '';?>" />
</td>
</tr>

<!-- Name -->
<tr>
<td>Project Creator(s)</td>
<td>:</td>
<td><input type=text name="projectAuthor" size="20" value="<?php echo isset($_SESSION["projectAuthor"]) ? $_SESSION["projectAuthor"] : '';?>" /></td>
</tr>

<!-- Description -->
<tr>
<td>Project Description</td>
<td>:</td>
<td><textarea name="projectDescription" cols="35" rows="4"><?php echo isset($_SESSION["projectDescription"]) ? $_SESSION["projectDescription"] : '';?></textarea></td>
</tr>

<!-- Is It For A Class -->
<tr>
<td>Was this project created for a class?</td>
<td>:</td>
<td><input type=radio name="projectIsForClass" value="yes" <?php echo isset ($_SESSION["isForClass"]) ?
	   	      			       		   ($_SESSION["isForClass"] == "yes" ? 'checked="checked"' : '') :
							   'checked="checked"'; ?> /> yes
    <input type=radio name="projectIsForClass" value="no" <?php echo isset ($_SESSION["isForClass"]) && $_SESSION["isForClass"] == "no" ?
    	   	      			       		  'checked="checked"' : '';?> /> no </td>
</tr>


<!-- Class Name -->
<tr>
<td>Class Name</td>
<td>:</td>
<td><input type=text name="projectClass" size="20" value="<?php echo isset($_SESSION["projectClass"]) ? $_SESSION["projectClass"] : '';?>" /></td>
</tr>

<!-- Major -->
<tr>
<td>Related Major</td>
<td>:</td>
<td><!--<input type=text name="projectMajor" size="20" />-->
<select name="projectMajor" >
  <option value="">--Select Major--</option>
  <option value="ADMN" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "ADMN" ? 'selected="selected"' : '';?>>ADMN</option>
  <option value="ARCH" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "ARCH" ? 'selected="selected"' : '';?>>ARCH</option>
  <option value="ARTS" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "ARTS" ? 'selected="selected"' : '';?>>ARTS</option>
  <option value="ASTR" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "ASTR" ? 'selected="selected"' : '';?>>ASTR</option>
  <option value="BCBP" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "BCBP" ? 'selected="selected"' : '';?>>BCBP</option>
  <option value="BIOL" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "BIOL" ? 'selected="selected"' : '';?>>BIOL</option>
  <option value="BMED" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "BMED" ? 'selected="selected"' : '';?>>BMED</option>
  <option value="CHEM" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "CHEM" ? 'selected="selected"' : '';?>>CHEM</option>
  <option value="CHME" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "CHME" ? 'selected="selected"' : '';?>>CHME</option>
  <option value="CIVL" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "CIVL" ? 'selected="selected"' : '';?>>CIVL</option>
  <option value="COGS" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "COGS" ? 'selected="selected"' : '';?>>COGS</option>
  <option value="COMM" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "COMM" ? 'selected="selected"' : '';?>>COMM</option>
  <option value="CSCI" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "CSCI" ? 'selected="selected"' : '';?>>CSCI</option>
  <option value="DSES" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "DSES" ? 'selected="selected"' : '';?>>DSES</option>
  <option value="ECON" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "ECON" ? 'selected="selected"' : '';?>>ECON</option>
  <option value="ECSE" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "ECSE" ? 'selected="selected"' : '';?>>ECSE</option>
  <option value="ENGR" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "ENGR" ? 'selected="selected"' : '';?>>ENGR</option>
  <option value="ENVE" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "ENVE" ? 'selected="selected"' : '';?>>ENVE</option>
  <option value="EPOW" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "EPOW" ? 'selected="selected"' : '';?>>EPOW</option>
  <option value="ERTH" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "ERTH" ? 'selected="selected"' : '';?>>ERTH</option>
  <option value="IHSS" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "IHSS" ? 'selected="selected"' : '';?>>IHSS</option>
  <option value="ISCI" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "ISCI" ? 'selected="selected"' : '';?>>ISCI</option>
  <option value="ITEC" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "ITEC" ? 'selected="selected"' : '';?>>ITEC</option>
  <option value="LGHT" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "LGHT" ? 'selected="selected"' : '';?>>LGHT</option>
  <option value="LITR" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "LITR" ? 'selected="selected"' : '';?>>LITR</option>
  <option value="MANE" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "MANE" ? 'selected="selected"' : '';?>>MANE</option>
  <option value="MATH" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "MATH" ? 'selected="selected"' : '';?>>MATH</option>
  <option value="MATP" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "MATP" ? 'selected="selected"' : '';?>>MATP</option>
  <option value="MGMT" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "MGMT" ? 'selected="selected"' : '';?>>MGMT</option>
  <option value="MTLE" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "MTLE" ? 'selected="selected"' : '';?>>MTLE</option>
  <option value="PHIL" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "PHIL" ? 'selected="selected"' : '';?>>PHIL</option>
  <option value="PHYS" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "PHYS" ? 'selected="selected"' : '';?>>PHYS</option>
  <option value="PSYC" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "PSYC" ? 'selected="selected"' : '';?>>PSYC</option>
  <option value="STSH" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "STSH" ? 'selected="selected"' : '';?>>STSH</option>
  <option value="STSS" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "STSS" ? 'selected="selected"' : '';?>>STSS</option>
  <option value="USAF" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "USAF" ? 'selected="selected"' : '';?>>USAF</option>
  <option value="USAR" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "USAR" ? 'selected="selected"' : '';?>>USAR</option>
  <option value="USNA" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "USNA" ? 'selected="selected"' : '';?>>USNA</option>
  <option value="WRIT" <?php echo isset ($_SESSION["projectMajor"]) && $_SESSION["projectMajor"] == "WRIT" ? 'selected="selected"' : '';?>>WRIT</option>
</select>
</td>
</tr>

<!-- Upload File 1 -->
<tr>
<td>Choose a file to upload</td>
<td>:</td>
<td><input name="file1" type="file" /></td>
</tr>

<!-- Upload File 2 -->
<tr>
<td>Choose a file to upload</td>
<td>:</td>
<td><input name="file2" type="file" /></td>
</tr>

<!-- Upload File 3 -->
<tr>
<td>Choose a file to upload</td>
<td>:</td>
<td><input name="file3" type="file" /></td>
</tr>

<!-- Upload File 4 -->
<tr>
<td>Choose a file to upload</td>
<td>:</td>
<td><input name="file4" type="file" /></td>
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
