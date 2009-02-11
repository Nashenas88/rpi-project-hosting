<table width="500" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr><td>
<form name="upload" method="post" action="uploadFiles.php">
<fieldset>
<legend><strong>Upload</strong></legend>
<table width="490" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td>Project Name</td>
<td>:</td>
<td><input name="projectName" type="text" id="projectName" />
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" /></td>
</tr>
<tr>
<td>Choose a file to upload</td>
<td>:</td>
<td><input name="uploaded" type="file" /></td>
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
Note: Max file size is 1MB
