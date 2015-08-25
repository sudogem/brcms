<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../templates/login.css" >

</head>

<body>
<form name="login" action="{LOGIN_URL}" method="post">

<table width="461" border="0" align="center" id="login">
  <tr>
    <td colspan="3" class="login-header" >&nbsp;Login</td>
  </tr>
  <tr>
    <td colspan="3"><h1 class="tcaptions">Welcome to El Nuevo Bantay Radyo Web Content Management System</h1></td>
  </tr>
  <tr>
    <td width="163" rowspan="3" class="icon"><p class="login_desc"><img src="../admin/images/security.png" width="64" height="64" />Use a valid username and password to gain access to the  system..</p></td>
    <td width="107" id="login-label" valign="bottom"><b>Username:</b></td>
    <td width="175" valign="bottom" ><input type="text" class="inputbox" name="username" value= "{POST_USERNAME}" /></td>
  </tr>
  <tr>
    <td valign="middle" id="login-label"><b>Password:</b></td>
    <td valign="middle"><input class="inputbox" type="password" name="password" /></td>
  </tr>
  <tr>
    <td valign="top"></td>
    <td valign="top"><input type="submit" name="submit" value="Submit" class="login_btn" /><input type="submit" name="cancel" value="Cancel" class="login_btn" /></td>
	
  </tr>
  <tr>
  	<td></td>
  	<td></td>
  	<td id="login-label"><a href="lostpassword.php">Lost your password?</a></td>	
  </tr>

  <tr>
    <td colspan="3"  class="login-header">&nbsp;</td>
  </tr>
</table>
</form>

</body>
</html>
