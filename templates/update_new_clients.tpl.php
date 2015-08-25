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
					<div id="panel" >

				<form name="users" method="post" action="save_client_profile.php">
					<div id="toolbar_panel">
						<div id="toolbar_btn">
								<input type="submit" value="cancel" name="cancel" class="formbutton" >
								<input type="submit" value="save" name="save" class="formbutton" >
								<input type="hidden" value="edit" name="task" >
						</div>
					</div>					
					<h3 class="msginfo">{MESSAGE}</h3>	
					<h1 class="asterisk">Client Profile </h1>
<table width="630" class="ctable"  >
		<tr>
			<td width="622"  valign="top">
				<table width="622" class="ctable" id="tdata"  cellspacing="0" border="0"  >
                  <tr class="table_header"> 
                    <th colspan="2"> Client Details</th>
                  </tr>
                  <tr> 
                    <td colspan="100%" class="hsmall"> <span class="hsmall">Items 
                      marked with a * are required unless stated otherwise.</span> 
                    </td>
                  </tr>
                  <tr> 
                    <td width="353"> Client Name:* </td>
                    <td width="257"> <input type="text" name="clientname" class="inputbox" size="40" value="{CLIENTNAME}" /> 
                    </td>
                  </tr>
                  <tr> 
                    <td> Contact name : *</td>
                    <td> <input type="text" name="contactname" class="inputbox" size="40" value="{CONTACTNAME}" /> 
                    </td>
                  <tr> 
                    <td> Email: * </td>
                    <td> <input class="inputbox" type="text" name="email" size="40" value="{EMAIL}" /> 
                    </td>
                  </tr>
                  <tr> 
                    <td> Telephone: *</td>
                    <td> <input class="inputbox" type="text" name="phoneno" size="40" value="{PHONENO}" /> 
                    </td>
                  </tr>
                  <tr> 
                    <td> Fax no: *</td>
                    <td> <input class="inputbox" type="text" name="faxno" size="40" value="{FAXNO}" /> 
                    </td>
                  </tr>
                  <tr> 
                    <td> Extra info : </td>
                    <td> <textarea name="extrainfo" cols="30" rows="">{EXTRA_INFO}</textarea>	
                    </td>
                  </tr>
                  <tr> 
                    <td valign="top"> Register Date : </td>
                    <td> {REGISTER_DATE} </td>
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

		