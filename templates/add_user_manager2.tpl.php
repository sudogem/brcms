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
<table width="100%">
		<tr>
			<td width="100%" valign="top">
				<table class="adminform">
				<tr>
					<th colspan="2">
					User Details
					</th>
				</tr>
				<tr>
					<td width="104">
					Name:
					</td>
					<td width="246">
					<input type="text" name="name" class="inputbox" size="40" value="" />
					</td>
				</tr>
				<tr>
					<td>
					Username:
					</td>
					<td>
					<input type="text" name="username" class="inputbox" size="40" value="" />
					</td>
				<tr>
					<td>
					Email:
					</td>
					<td>
					<input class="inputbox" type="text" name="email" size="40" value="" />
					</td>
				</tr>
				<tr>
					<td>
					New Password:
					</td>
					<td>
					<input class="inputbox" type="password" name="password" size="40" value="" />
					</td>
				</tr>
				<tr>
					<td>
					Verify Password:
					</td>
					<td>
					<input class="inputbox" type="password" name="password2" size="40" value="" />
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
						Telephone:
						</td>
						<td>
						{TEL_NO}
						</td>
					</tr>
					<tr>
						<td>
						Cel no:
						</td>
						<td>
						{CEL_NO}
						</td>
					</tr>
					
					<tr>
						<td>
						Interest:
						</td>
						<td>
						{INTEREST}
						</td>
					</tr>
					<tr>
						<td>
						Home address:
						</td>
						<td>
						{HOME_ADDRESS}
						</td>
					</tr>
					<tr>
						<td>
						Register Date
						</td>
						<td>
						{REGISTER_DATE}
						</td>
					</tr>
					
				 <tr>
					<td>
					Last Visit Date
					</td>
					<td>
					{LAST_VISIT_DATE}
					</td>
				</tr> 
				<tr>
					<td colspan="2">&nbsp;

					</td>
				</tr>
				</table>
			</td>
			</tr>
				</table>
				
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

		