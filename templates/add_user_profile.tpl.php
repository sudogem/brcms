<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />
<script type="text/javascript" language="javascript">



	function enableCategory() {
		//document.form.select2.disabled = true;
		if(document.adminForm.usertype.value == "3") {
			document.adminForm.category.disabled = false;
		} else {
			document.adminForm.category.disabled = true;
		}
	}
	
	function disableCategory() {
		document.adminForm.category.disabled = true;
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
		if ( f.password.value == "" ){
			alert( "You must provide a password." );
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
	function setpw(){
		var f = document.adminForm;
		f.password.value = f.username.value;
	}
</script>

</head>

<body onLoad="disableCategory();">
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
					<form name="adminForm" method="post" action="save_user_profile.php">
					<div id="toolbar_panel">
						<div id="toolbar_btn">
								<input type="submit" value="Cancel" name="cancel" class="formbutton" >
								<input type="hidden" value="add" name="task" >
								<input type="submit" onClick="return mh();" value="Save" name="save" class="formbutton" >
						</div>
					</div>			
					<h3 class="msginfo">{MESSAGE}</h3>	
						<h1 class="asterisk">User Profile : New</h1>
					<table width="100%" class="ctable" id="tablebgcolor">
							<tr>
							  <td valign="top">
									<table width="100%" class="ctable" id="tdata"  cellspacing="0" border="0"  >
									<tr class="table_header">
										<th colspan="2" align="left" class="tdcaptions">
										Details
										</th>
									</tr>
									<tr>
										<td colspan="100%">
									<span class="hsmall">Items marked with a * are required unless stated otherwise.</span>
										</td>
									</tr>
									<tr>
										<td width="154">
										Name:
					*					</td>
										<td width="1378">
										<input type="text" name="name" class="inputbox" size="40" value="{FULLNAME}" />
										</td>
									</tr>
									<tr>
										<td>
										Username:
					*					</td>
										<td>
										<input type="text" name="username" onBlur="setpw();" class="inputbox" size="40" value="{USERNAME}" />
										</td>
									<tr>
									<tr>
										<td>
										Password:
					*					</td>
										<td>
										<input class="inputbox" type="text" name="password" size="40" value="" />
										</td>
									</tr>
									
										<td>
										Email:
					*					</td>
										<td>
										<input class="inputbox" type="text" name="email" size="40" value="{EMAIL}" />
										</td>
									</tr>
									<tr>
										<td valign="top">
										Position :
					*					</td>
										<td>
										<select name="usertype" class="inputbox" onChange="enableCategory();">
												{LIST_USERTYPE}
										</select>
										</td>
									</tr>	
									<tr>
										<td valign="top">
										Category:
					*					</td>
										<td>
										<select name="category" class="inputbox">
											<option value="100" selected>All</option>
										
											{CATEGORY}
										</select>
										</td>
									</tr>
										<tr>
											<td>
											Contact No :
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
										<textarea name="interests" cols="42"  class="inputbox" rows="">{INTERESTS}</textarea>						</td>
										</tr>
										<tr>
											<td>
											Enabled :
*											</td>
											<td>
											{IS_ENABLED}
											</td>
										</tr>
										
										<tr>
											<td>
											Home address:
											</td>
											<td>
											<textarea name="homeaddress" cols="42" rows="" class="inputbox">{HOMEADDRESS}</textarea>		
											</td>
										</tr>
                  <tr> 
                    <td valign="top"> Register Date : </td>
                    <td>{REGISTER_DATE}</td>
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

		