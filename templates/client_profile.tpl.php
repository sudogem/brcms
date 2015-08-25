<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="brainwired@gmail.com" />
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
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
				<form name="users" method="post" action="edit_client_profile.php">
					<div id="toolbar_panel">
						<div id="toolbar_btn">
								<input type="submit" value="Edit" name="save" class="formbutton" >
								<input type="submit" value="Cancel" name="cancel" class="formbutton" >
								<input type="hidden" value="edit" name="task" >
						</div>
					</div>					
					<h3 class="msginfo">{MESSAGE}</h3>	
					<h1 class="asterisk">Client Profile </h1>
				    		<table width="100%" class="ctable">
								<tr>
									<td width="100%">
			
<table width="100%" cellpadding="4"  cellspacing="1"  class="ctable" id="tdata">
					<tr class="table_header" align="left">
						<th colspan="5" class="tdcaptions">
						Details
						</th>
					</tr>
					<tr>
					  <td colspan="2"><span class="hsmall">Items 
                      marked with a * are required unless stated otherwise.</span> </td>
		    </tr>
					<tr>
						<td width="105">
						Client Name:* 						</td>
						<td width="638">
						<!-- <input type="text" name="name" class="inputbox" size="40" value="" /> -->
						<label>{CLIENTNAME}</label>					  </td>
					</tr>
					<tr>
						<td>
						Contact name : *						</td>
						<td>
						<label>{CONTACTNAME}</label>
						<!-- <input type="text" name="username" class="inputbox" size="40" value="" />-->
						</td>
					<tr>
					
						<td height="16">
						Username : *						</td>
						<td>
						<!-- <input class="inputbox" type="text" name="email" size="40" value="{EMAIL}" /> -->
						<label>{USERNAME}</label>
						</td>
					</tr>
					<tr>
						<td height="16">
						Address :
						</td>
						<td>
						<!-- <input class="inputbox" type="text" name="email" size="40" value="{EMAIL}" /> -->
						<label>{ADDRESS}</label>
						</td>
					</tr>
					<tr>
						<td height="16">
						Email: * 
						</td>
						<td>
						<!-- <input class="inputbox" type="text" name="email" size="40" value="{EMAIL}" /> -->
						<label>{EMAIL}</label>
						</td>
					</tr>
					
					<tr>
					  <td valign="top">Website:</td>
					  <td>{WEBSITE}</td>
				  </tr>
					<tr>
						<td valign="top">
						Contact no: *
						</td>
						<td>
						{PHONENO}
						</td>
					</tr>
					    <tr>
					      <td>Extra info : </td>
					      <td>{EXTRAINFO} </td>
			      </tr>
					    <tr>
					      <td>Register Date : </td>
					      <td>{REGISTER_DATE} </td>
			      </tr>
				    <tr>
						<td>Last Visit Date : 
						</td>
						<td>{LAST_VISIT_DATE} 
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

		