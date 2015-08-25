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
				<form name="users" method="post" action="save_poll_response.php" >
					<div id="toolbar_panel">
						<div id="toolbar_btn">
								<input type="submit" value="Save" name="save" class="formbutton" >
								<input type="submit" value="Cancel" name="cancel" class="formbutton" >								
								<input type="hidden" value="edit" name="task" >
						</div>
					</div>					
					<h3 class="msginfo">{MESSAGE}</h3>	
					<h1 class="asterisk">Poll : New </h1>
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
					<td colspan="101" class="hsmall">
				<span class="hsmall">Items marked with a * are required unless stated otherwise.</span>
					</td>
				</tr>
				
				<tr>
					<td width="144">
					Topic:
*					</td>
					<td width="208"><textarea name="topic"></textarea></td>
					<td width="974">
<table border="0">
			<tr>
				<td></td>
				<td>Month</td>
				<td>Day</td>
				<td>Year</td>
			</tr>
			<tr>
				<td> From:</td>
				
				<!-- Month -->
				<td>
					<select name="from_month">
					{FROM_MONTH}
					</select>
				</td>
				
				<!-- Day -->
				<td>
					<select name="from_date">		
					{FROM_DAY}
					</select>
				</td>
				
				<!-- Year -->
				<td>
					<select name="from_year">		
					{FROM_YEAR}
					</select>
				</td>
			</tr>
			<tr>
				<td> To:</td>
				
				<!-- Month -->
				<td>
					<select name="expiry_month">
						{FROM_MONTH}
					</select>
				</td>
				
				<!-- Day -->
				<td>
					<select name="expiry_date">		
						{FROM_DAY}
					</select>
				</td>
				
				<!-- Year -->	
				<td>
					<select name="expiry_year">		
						{FROM_YEAR}
					</select>
				</td>
			</tr>
		</table>					
					</td>
				</tr>
				<tr>
				  <td>Respond labels: * </td>
				  <td><input name="label" type="text"></td>
				  <td>&nbsp;</td>
				  <tr>
					<td>&nbsp;					</td>
					<td>&nbsp;</td>
					<td>&nbsp;
					</td>
				
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

		