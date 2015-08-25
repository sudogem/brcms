<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
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
				<form name="adminForm" method="post" action="edit_quote.php">
				<div id="toolbar_panel">
					<div id="toolbar_btn">
						 <a href="edit_quote.php" onClick="document.adminForm.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image1" width="32" height="32" border="0">Edit</a>
					</div>
					<!-- <input type="submit" value="Edit" name="edit" class="formbutton" > -->
				</div>
				<div class="clear">&nbsp;</div>
					<h1 class="asterisk">Quote : View </h1>

					<table width="100%" cellpadding="4"  cellspacing="1"  class="ctable" id="tdata">
					<tr class="table_header" align="left">
						<th colspan="5">
						Details
						</th>
					</tr>
					<tr>
						<td width="220">
						Quote:
						</td>
						<td width="1039">
						{QUOTE}
					  </td>
					</tr>
					<tr>
						<td valign="top">
						Author:
						</td>
						<td>
						{AUTHOR}
						</td>
					
					<tr>
						<td colspan="2">&nbsp;
					
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

