<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />
<script type="text/javascript" language="javascript">
	function mh(){
		var f = document.adminForm;
		if ( f.clientname.value == "" ){
			alert( "You must provide a name." );
			return false;
		}
		if ( f.contactname.value == "" ){
			alert( "You must provide a contactname." );
			return false;
		}
		if ( f.username.value == "" ){
			alert( "You must provide a username." );
			return false;
		}
		if ( f.password.value == "" ){
			alert( "You must provide a name." );
			return false;
		}
		if ( f.email.value == "" ){
			alert( "You must provide a email." );
			return false;
		}
		if ( f.phoneno.value == "" ){
			alert( "You must provide a contact no." );
			return false;
		}
		
		if ( f.password.value != f.password2.value ) {
			//alert( "Password do not match." );
			//return false;
			return true;
		}
		return true;
	}
	function setpw(){
		var f = document.adminForm;
		f.password.value = f.username.value;
	}
	
</script>

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
					<div id="panel" >

				<form name="adminForm" method="post" action="save_client_profile.php">
					<div id="toolbar_panel">
						<div id="toolbar_btn">
								<input type="submit" onClick="return mh();" value="Save" name="save" class="formbutton" >
								<input type="submit" value="Cancel" name="cancel" class="formbutton" >
								<input type="hidden" value="add" name="task" >
						</div>
					</div>					
					<h3 class="msginfo">{MESSAGE}</h3>	
					<h1 class="asterisk">Banner Client: New </h1>
                    <table width="100%" class="ctable"  >
		<tr>
			<td width="100%"  valign="top">
				<table width="100%" class="ctable" id="tdata"  cellspacing="0" border="0"  >
                  <tr class="table_header" > 
                    <th colspan="2" align="left" class="tdcaptions">Details</th>
                  </tr>
                  <tr> 
                    <td colspan="100%" class="hsmall"> <span class="hsmall">Items 
                      marked with a * are required unless stated otherwise.</span> 
                    </td>
                  </tr>
                  <tr> 
                    <td width="203"> Client Name:* </td>
                    <td width="1321"> <input type="text" tabindex="1" name="clientname" class="inputbox" size="40" value="{CLIENTNAME}" /> 
                    </td>
                  </tr>
                  <tr> 
                    <td> Contact name : *</td>
                    <td> <input type="text" tabindex="2" name="contactname" class="inputbox" size="40" value="{CONTACTNAME}" /> 
                    </td>
                  <tr> 
                    <td> Username : *</td>
                    <td> <input type="text" tabindex="3" name="username" onBlur="setpw();" class="inputbox" size="40" value="{USERNAME}" /> 
                    </td>
                  <tr> 
				  
                    <td> Password : *</td>
                    <td> <input type="text" name="password" class="inputbox" size="40" value="" /> 
                    </td>
                  <tr>
				  
                    <td>Address :</td>
                    <td> <input type="text" tabindex="5" name="address" class="inputbox" size="40" value="{ADDRESS}" /> </td>
                  </tr>
<td> Email: * </td>
                    <td> <input class="inputbox" tabindex="6" type="text" name="email" size="40" value="{EMAIL}" /> 
                    </td>                  
<tr>
  <td>Website:</td>
  <td><input class="inputbox" type="text" tabindex="7" name="website" size="40" value="{WEBSITE}" /></td>
</tr>
<tr> 
                    <td> Contact No : *</td>
                    <td> <input class="inputbox"  tabindex="8"type="text" name="phoneno" size="40" value="{TELNO}" /> 
                    </td>
                  </tr>
                  <tr> 
                    <td> Extra info : </td>
                    <td> <textarea name="extrainfo" tabindex="9" class="inputbox" cols="42" rows="">{EXTRAINFO}</textarea>	
                    </td>
                  </tr>
                  <tr> 
                    <td> Enabled : </td>
                    <td> {STATUS} </td>
                  </tr>
                  <tr> 
                    <td valign="top"> Register Date : </td>
                    <td>{REGISTER_DATE}</td>
                  </tr>
                  <tr> 
                    <td colspan="2">&nbsp; </td>
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

		