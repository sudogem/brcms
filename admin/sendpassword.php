<?php
include( 'configuration.php' );
require ( 'coreclass.php' );

if ( isset($_POST['sendpassword'])) {
	$username = $_POST['username'];
	$emailadd = $_POST['emailadd'];
	
	$message = "";
	$message .= " New Password request \r\n";
	$message .= " ------------------------------ \r\n";
	$message .= " Username: $username \r\n";
	$message .= " Email: $emailadd \r\n\r\n";
	$message .= " Thanks!!! \r\n";
	$result = @sendmail( $admin_email, 'Password Request', $message );
	if ($result){
		$msg = "A new password will be sent on the given email.<br>Thanks.";
	}
	else{
		$msg = "The e-mail could not be sent.<br>
Possible reason: your host may have disabled the mail() function...";
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Lost your password</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../templates/login.css" >

</head>

<body>
<table width="461" border="0" align="center" id="login">
	  <tr>
		<td colspan="2"  class="login-header">Lost Your Password?</td>
	  </tr>
	  <tr>
		<td colspan="2" class="login_desc"><?php echo $msg; ?></td>
	
	  </tr>
	  <tr>
		<td colspan="2"  class="login-header"><a href="login.php"><span style="color:#fff;">&lt;&lt;Back&nbsp;&nbsp;&nbsp;&nbsp;</span></a> </td>
	  </tr>
	</table>
</body>
</html>
