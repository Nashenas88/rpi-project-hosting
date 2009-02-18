<table width="500" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr><td>
<form name="upload" method="post" action="uploadFiles.php">
<fieldset>
<legend><strong>Upload</strong></legend>
<table width="490" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">

<tr>
<td>Choose a file to upload</td>
<td>:</td>
<td><input name="uploaded" type="file" /></td>
</tr>

<tr>
<td>Choose a picture to upload</td>
<td>:</td>
<td><input name="uploadedPic" type="file" /></td>
</tr>

<p style="font-size:12px">By uploading files you certify that you have the right to distribute these files and that it does not violate the <a href="http://www.youtube.com/watch?v=oHg5SJYRHA0">Terms of Service</a>.</p>

<tr>
<td>Project Name</td>
<td>:</td>
<td><input name="projectName" type="text" id="projectName" />
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" /></td>
</tr>

<tr>
<td>Project Authors</td>
<td>:</td>
<td><input type=text name="projectAuthors" size=20 /></td>
</tr>

<tr>
<td>Project Description</td>
<td>:</td>
<td><textarea name="projectDescription" cols=35 rows=4 </textarea></td>
</tr>

<tr>
<td>Was this project created for a class?</td>
<td>:</td>
<td><input type=radio name="projectForClass" value=yes /> yes
    <input type=radio name="projectForClass" value=no /> no </td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Upload"</td>
</tr></table>
</fieldset>
</form>
</td></tr>
</table>
Note: Max file size is 1MB.
<br>