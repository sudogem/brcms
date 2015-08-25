<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="brainwired@gmail.com" />
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />
<script type="text/javascript" language="javascript">
	function enableCategory() {
	document.adminForm.category.disabled = true;
		if(document.adminForm.usertype.value == "3") {
			document.adminForm.category.disabled = false;
		} else {
			document.adminForm.category.disabled = true;
		}
	}
	
	function mh(){
		var f = document.adminForm;
		if ( f.name.value == "" ){
			alert( "You must provide a name." );
			return false;
		}
		if ( f.username.value == "" ){
			alert( "You must provide a username." );
			return false;
		}
		if ( f.email.value == "" ){
			alert( "You must provide a email." );
			return false;
		}
		if ( f.password.value != f.password2.value ) {
			alert( "Password do not match." );
			return false;
		}
		return true;
	}
</script>
</head>

<body onLoad="enableCategory();">
	<div id="wrapper">
		<div id="container">
			<div id="header">
				{HEADER}
			</div>
			<div id="topnav">
				{TOPNAV}
			</div>
			<div id="content">
					<div id="panel" >

				<form name="adminForm" method="post" onSubmit="" action="save_user_profile.php">
					<div id="toolbar_panel">
						<div id="toolbar_btn">
								<input type="submit" onClick="return mh();"  value="Save" name="save" class="formbutton" >
								<input type="submit" value="Cancel" name="cancel" class="formbutton" >								
								<input type="hidden" value="edit" name="task" >
								
						</div>
					</div>					
					<h3 class="msginfo">{MESSAGE}</h3>	
					<h1 class="asterisk">User Profile : Edit </h1>
                    <table width="100%" class="ctable" id="tdata" cellspacing="1" border="0">
		<tr>
			<td   valign="top">
				<table width="100%"   >
				<tr class="table_header" align="left">
					<th colspan="2" class="tdcaptions" >
					 Details
					</th>
				</tr>
				<tr>
					<td colspan="100%" class="hsmall">
				<span class="hsmall">Items marked with a * are required unless stated otherwise.</span>
					</td>
				</tr>
				
				<tr>
					<td width="390">
					Name:
*					</td>
					<td width="1336">
					<input type="text" name="name" class="inputbox" size="40" value="{FULLNAME}" />
					</td>
				</tr>
				<tr>
					<td>
					Username:
*					</td>
					<td>
					<input type="text" name="username" class="inputbox" size="40" value="{USERNAME}" />
					</td>
				<tr>
					<td>
					Password:*<br>	
<p style="font-size:10px; line-height:1em; margin:0 0 0 0; color:#FF0000;">You only need to supply a password if you want to change it									
					</td>
					<td>
					<input class="inputbox" type="password" name="password" size="40" value="" />
					</td>
				</tr>
				<tr>
					<td>
					Password confirmation:*<br>	
<p style="font-size:10px; line-height:1em; margin:0 0 0 0;color:#FF0000; ">You only need to confirm your password if you changed it above					
					</td>
					<td>
					<input class="inputbox" type="password" name="password2" size="40" value="" />
					</td>
				</tr>
				<tr>
					<td>
					Email:
*					</td>
					<td>
					<input class="inputbox" type="text" name="email" size="40" value="{EMAIL}" />
					</td>
				</tr>
				
				<tr>
					<td valign="top">
					Position:
*					</td>
					<td>
					<select name="usertype" class="inputbox" onChange="enableCategory();">
						{GROUP}
					</select>
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
					Category:
*					</td>
					<td>
					<select name="category" class="inputbox" >
						<option value="-1" selected>All</option>
						{CATEGORY}						
					</select>
					<!--<ul style="list-style-type:none;">
						{CATEGORY}
					</ul>-->
					
					</td>
				</tr>
				
					<tr>
						<td>
						Contact no:
						</td>
						<td>
					<input class="inputbox" type="text" name="phoneno" size="40" value="{PHONENO}" />
						</td>
					</tr>
					
					<tr>
						<td>
						Interest:
						</td>
						<td>
					<textarea class="inputbox" name="interests" cols="42" rows="">{INTERESTS}</textarea>						</td>
					</tr>
					<tr>
						<td>
						Home address:
						</td>
						<td>
						<textarea class="inputbox" name="homeaddress" cols="42" rows="">{HOMEADDRESS}</textarea>		
						</td>
					</tr>
				<tr>
					<td>
						Enabled :
					  </td>
						<td>
						{IS_ENABLED}
						</td>
					</tr>
					
				<tr>
					<td valign="top">
					Register Date :
					</td>
					<td>
					{REGISTER_DATE}
					</td>
				</tr>
				<tr>
					<td valign="top">
					Last Visit Date :
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
		
					</form>
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

		