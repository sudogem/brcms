<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Lost your password</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../templates/login.css" >

</head>

<body>
<form name="adminForm" method="post" action="{URL}">
	<table width="461" border="0" align="center" id="login">
	  <tr>
		<td colspan="2"  class="login-header">Lost Your Password?</td>
	  </tr>
	  <tr>
		<td colspan="2" class="login_desc">Please enter your Username and e-mail address then click on the Send Password button.
	You will receive a new password shortly. Use this new password to access the site.</td>
	
	  </tr>
	  <tr>
		<td width="160"  id="login-label"><b>Username: </b></td>
		<td><input type="text" name="username" class="inputbox"></td>
	  </tr>
	  <tr>
		<td  id="login-label"><b>E-mail address: </b></td>
		<td><input type="text" name="emailadd" class="inputbox"></td>
	  </tr>
	  <tr>
	    <td><input type="submit" name="sendpassword"  class="login_btn" value="Send Password"></td>
	    <td id="login-label" align="right"><a href="login.php">&lt;&lt;Back&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
      </tr>
	  <tr>
		<td colspan="2"  class="login-header">&nbsp; </td>
	  </tr>
	</table>
</form>
</body>
</html>
