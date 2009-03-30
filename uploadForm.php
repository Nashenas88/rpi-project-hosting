
<table width="500" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr><td>
<form name="upload" method="post" action="uploadFiles.php" enctype="multipart/form-data">
<fieldset>
<legend><strong>Upload</strong></legend>
<table width="490" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">

<!-- Print Errors -->

<!-- Project Name -->
<tr>
<td>Project Name</td>
<td>:</td>
<td><input name="projectName" type="text" id="projectName" />
</td>
</tr>

<!-- Name -->
<!--<tr>
<td>Project Author(s)</td>
<td>:</td>
<td><input type=text name="projectAuthor" size=20 /></td>
</tr>!-->

<!-- Description -->
<tr>
<td>Project Description</td>
<td>:</td>
<td><textarea name="projectDescription" cols=35 rows=4 </textarea></td>
</tr>

<!-- Is It For A Class -->
<tr>
<td>Was this project created for a class?</td>
<td>:</td>
<td><input type=radio name="projectIsForClass" value=yes checked/> yes
    <input type=radio name="projectIsForClass" value=no /> no </td>
</tr>

<!-- Class Name -->
<tr>
<td>Class Name</td>
<td>:</td>
<td><input type=text name="projectClass" size=20 /></td>
</tr>

<!-- Major -->
<tr>
<td>Related Major</td>
<td>:</td>
<td><input type=text name="projectMajor" size=20 /></td>
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
<td><input type="submit" name="Submit" value="Upload"</td>
</tr>

<!-- Terms of Service -->
<tr>
<td colspan="3">
<p style="font-size:12px">By uploading files you certify that you have the right to distribute these files and that it does not violate the <a href="http://www.youtube.com\
/watch?v=oHg5SJYRHA0">Terms of Service</a>.</p>
</td>
</tr>

</table>
</fieldset>
</form>
</td></tr>
</table>
Note: Max file size is 1MB.
<br>
