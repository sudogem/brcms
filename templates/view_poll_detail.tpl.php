<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="brainwired@gmail.com" />
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
				<form name="users" method="post" action="edit_poll.php" >
					<div id="toolbar_panel">
						<div id="toolbar_btn">
								<input type="submit" value="Edit" name="save" class="formbutton" >
								<input type="submit" value="Cancel" name="cancel" class="formbutton" >								
								<input type="hidden" value="edit" name="task" >
						</div>
					</div>					
					<h3 class="msginfo">{MESSAGE}</h3>	
					<h1 class="asterisk">Poll : View </h1>
                    <table width="100%" class="ctable" id="tdata"  cellspacing="1" border="0">
		<tr>
			<td   valign="top">
				<table width="100%"   >
				<tr class="table_header" align="left">
					<th colspan="3" class="tdcaptions" >
					 Details
					</th>
				</tr>
				<tr>
					<td width="269">
					Topic:
*					</td>
					<td width="334">{POLL_TOPIC}</td>
					<td width="601">&nbsp;</td>
				</tr>
				<tr>
				  <td valign="top">Respond labels: * </td>
				  <td>{RESPOND_LABELS}</td>
				  <td>&nbsp;</td>
				  <tr>
				    <td>Start Date: </td>
				    <td>{TOPIC_DATE}</td>
				    <td>&nbsp;</td>
			      <tr>
					<td>End Date: </td>
					<td>{EXPIRY_DATE}</td>
					<td>&nbsp;</td>
				
				<tr>
					<td colspan="3">&nbsp;

					</td>
				</tr>
				</table>
			</td>
			</tr>
				</table>
				<div class="clear"></div>
				
		
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

		