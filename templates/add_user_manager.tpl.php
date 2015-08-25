<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />

</head>

<body>
	<div id="wrapper">
		<div id="container">
			<div id="header">
				{HEADER}
			</div>
			<div id="topnav">
				{TOPNAV}
			</div>
			<div id="content">
				<div id="outerpanel">
					<div id="panel" >
					<form name="users" method="post" action="save_user_manager.php">
								<input type="submit" value="help" name="help" class="formbutton" >
								<input type="submit" value="cancel" name="cancel" class="formbutton" >
								
								<input type="submit" value="save" name="save" class="formbutton" >
						<h1 class="asterisk">User Profile </h1>
						<table width="50px" class="ctable" id="tablebgcolor" cellpadding="0">
						<tr class="table_header">
							<th colspan="5">
							User Details
							</th>
						</tr>
						<tr>
							<td width="108">
							Name:
							</td>
							<td width="286">
							<input type="text" name="fullname" class="inputbox" size="40" value="{FULLNAME}" />					  </td>
						</tr>
						<tr>
							<td>
							Username:
							</td>
							<td>
							<input type="text" name="username" class="inputbox" size="40" value="{USERNAME}" />
							</td>
						</tr>
						<tr>
							<td>
							Email:
							</td>
							<td>
							<input type="text" name="email" class="inputbox" size="40" value="{EMAIL}" />
							</td>
						</tr>
						
						<tr>
							<td>
							New Password:
							</td>
							<td>
							<input type="text" name="password" class="inputbox" size="40" value="" />
							</td>
						<tr>
						
							<td height="16">
							Verify Password:
							</td>
							<td>
							<input class="inputbox" type="text" name="verifypassword" size="40" value="" />
							</td>
						</tr>
						<tr>
							<td valign="top">
							Group:
							</td>
							<td>
							<select name="group" >
							{LIST_USERTYPE}
							</select>
							</td>
						</tr>
						<tr>
							<td>
								Block User
							  </td>
								<td>
								{IS_ENABLED}
								</td>
							</tr>
						<tr>
							<td colspan="2">&nbsp;
						
							</td>
						</tr>
						</table>
						<table width="30px" class="ctable" id="tablebgcolor">
						<tr class="table_header">
							<th colspan="5">
							Contact Information
							</th>
						</tr>
						<tr>
							<td width="75">
							Name:
							</td>
							<td width="316">
							<input type="text" name="fullname" class="inputbox" size="40" value="{FULLNAME}" />					  </td>
						</tr>
						<tr>
							<td>
							Position:
							</td>
							<td>
							<input type="text" name="username" class="inputbox" size="40" value="{USERNAME}" />
							</td>
						</tr>
						<tr>
							<td>
							Telephone:
							</td>
							<td>
							<input type="text" name="email" class="inputbox" size="40" value="{EMAIL}" />
							</td>
						</tr>
						<tr>
							<td>
							Home address:
							</td>
							<td>
							<textarea name="homeaddress" cols="30" rows="">{HOMEADDRESS}</textarea>
							</td>
						</tr>
						<tr>
							<td>
							Interests :
							</td>
							<td>
							<textarea name="interests" cols="30" rows="">{INTERESTS}</textarea>
							</td>
						</tr>
						<tr>
							<td>
							Cel No:
							</td>
							<td>
							<input type="text" name="celno" class="inputbox" size="40" value="{CELNO}" />
							</td>
						</tr>
						<tr>
							<td>
							Phone No:
							</td>
							<td>
							<input type="text" name="phoneno" class="inputbox" size="40" value="{PHONENO}" />
							</td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;
						
							</td>
						</tr>
						</table>						
					</form>
					</div>	
				</div>
</div>
</div>
	<div class="clear">&nbsp;</div>
	<div id="footer">
		{FOOTER}
	</div>	
		
	</div>
		
</body>
</html>

