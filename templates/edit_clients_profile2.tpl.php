<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="brainwired@gmail.com" />
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript">
	function mh(){
		var f = document.adminForm;
		if ( f.clientname.value == "" ){
			alert( "You must provide a clientname." );
			return false;
		}
		if ( f.contactname.value == "" ){
			alert( "You must provide a contact name." );
			return false;
		}
		if ( f.username2.value == "" ){
			alert( "You must provide a username." );
			return false;
		}
		
		if ( f.email.value == "" ){
			alert( "You must provide a email." );
			return false;
		}
		if ( f.phoneno.value == "" ){
			alert( "You must provide a contactno." );
			return false;
		}
		
		if ( f.password.value != f.password2.value ) {
			alert( "Password do not match." );
			return false;
		}
		return true;
	}
</script>

<link rel="stylesheet" type="text/css" href="{STYLESHEET}" />

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
								<input type="hidden" value="edit" name="task" >
						</div>
					</div>					
					<h3 class="msginfo">{MESSAGE}</h3>	
					<h1 class="asterisk">Client Profile </h1>
<table width="100%" class="ctable"  >
		<tr>
			<td width="100%"  valign="top">
				<table class="xctable" id="tdata"  cellspacing="0" border="0"width="100%"   >
                  <tr class="table_header" align="left"> 
						<th colspan="2"  class="tdcaptions">
						Details
						</th>
                  </tr>
                  <tr> 
                    <td colspan="100%" class="hsmall"> <span class="hsmall">Items 
                      marked with a * are required unless stated otherwise.</span> 
                    </td>
                  </tr>
                  <tr> 
                    <td width="116"> Client Name:* </td>
                    <td width="647"> <input type="text" name="clientname" class="inputbox" size="40" value="{CLIENTNAME}" /> 
                    </td>
                  </tr>
                  <tr> 
                    <td> Contact name : *</td>
                    <td> <input type="text" name="contactname" class="inputbox" size="40" value="{CONTACTNAME}" /> 
                    </td>
                  <tr> 
                    <td> Username : *</td>
                    <td> <input type="text" name="username2" class="inputbox" size="40" value="{USERNAME}" /> 
                    </td>
                  <tr> 
                    <td> Password : *<p style="font-size:10px; line-height:1em; margin:0 0 0 0; color:#FF0000; ">You only need to supply a password if you want to change it									
</td>
                    <td> <input type="password" name="password" class="inputbox" size="40" value="" /> 
                    </td>
                  <tr> 
                    <td> Password confirmation : *<p style="font-size:10px; line-height:1em; margin:0 0 0 0; color:#FF0000; ">You only need to confirm your password if you changed it above	</td>
                    <td> <input type="password" name="password2" class="inputbox" size="40" value="" /> 
                    </td>
                  <tr>
				  
                    <td>Address :</td>
                    <td> <input type="text" name="address" class="inputbox" size="40" value="{ADDRESS}" /> </td>
                  </tr>
                  <tr> 
                    <td> Email: * </td>
                    <td> <input class="inputbox" type="text" name="email" size="40" value="{EMAIL}" /> 
                    </td>
                  </tr>
                  <tr>
                    <td>Website:</td>
                    <td><input class="inputbox" type="text" name="website" size="40" value="{WEBSITE}" /></td>
                  </tr>
                  <tr> 
                    <td> Contact no: *</td>
                    <td> <input class="inputbox" type="text" name="phoneno" size="40" value="{PHONENO}" /> 
                    </td>
                  </tr>
                  <tr> 
                    <td> Extra info : </td>
                    <td> <textarea name="extrainfo" class="inputbox" cols="37" rows="">{EXTRAINFO}</textarea>	
                    </td>
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

		