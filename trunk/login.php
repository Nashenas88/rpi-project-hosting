
<html>
<head>
<title>Central Authentication Service</title>
<link href="https://www.rpi.edu/dept/cct/apps/generic/login/login_style.css" media="screen" type="text/css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript">
<!--
  // places the cursor in the first available form element when the page is loaded
  // (if a form exists on the page)
  function focusFirstElement() {
    if (window.document.forms[0]) {
      window.document.forms[0].elements[0].focus();
    }
  }
 // -->
 </script>
</head>

<body onload="focusFirstElement();">

    <div id="contentBox">
      <h1>
	  	Central Authentication Service
	  </h1>





<p>

  You have requested access to a site that requires RCS
  authentication. 

</p>

<p>
Enter your RCSID and password below; then click on the <b>Login</b>
button to continue.
</p>

      <form method="post" name="login_form">
		<p>RCSID: <input type="text" name="username" maxlength="8"></p>
		<p>Password: <input type="password" name="password"></p>
		<p id="warn"><input type="checkbox" name="warn" value="true" />Warn me before logging me in to other sites.</p>
	<input type="hidden" name="lt" value="LT-40636-JI2UlYnqmQHhhU5JVKyn" />
		<p><input type="submit" value="Login"></p>
	  </form>

<p id="security">For security reasons, quit your web browser when you are done
accessing services that require authentication!</p>


<p>
Be wary of any program or web page that asks you for your RCSID and
password. Secure RPI web pages that ask you for your RCSID and password
will generally have URLs that begin with "https://www.rpi.edu" or
"https://j2ee.rpi.edu". In addition, your browser should visually
indicate that you are accessing a secure page.
</p>

</div>
	  <div id="logoBox">
            <img alt="Rensselaer" src="https://www.rpi.edu/AFS/dept/cct/apps/generic/login/rensselaerLogo.gif" width="119" height="22" border="0" align="left"/>
            <img alt="DotCIO" src="https://www.rpi.edu/AFS/dept/cct/apps/generic/login/cioLogo.gif" width="48" height="18" border="0" align="right"/>
          </div>

</body>
</html>


