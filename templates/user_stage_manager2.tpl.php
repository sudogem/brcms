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
				<h3 class="msginfo">{MESSAGE}</h3>
			<div id="panel">
			<form name="users" method="post" action="save_user_sperms.php">
				<div id="toolbar_panel">
					<div id="toolbar_btn">
					</div>
					<div id="toolbar_btn">
					<!--<a href="" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/cancel_f2.png',1)"><img src="../admin/images/cancel.png" name="Image2" width="32" height="32" border="0">Close</a>-->
					</div>
				</div>
			<h1 class="asterisk">User Access Permissions</h1>
			<table width="100%" border="0" cellpadding="4" cellspacing="0" class="ctable2" >
			  <tr class="table_header">
				<td width="2%" class="tdcaptions">#</td>
  				<td width="11%" class="tdcaptions">{NAME}</td>
				<td width="15%" class="tdcaptions">{GROUP}</td>
				<td width="15%" class="tdcaptions">{WRITING}</td>
				<td width="15%" class="tdcaptions">{EDITING}</td>
				<td width="15%" class="tdcaptions">{PROOFREADING}</td>
				<td width="15%" class="tdcaptions">{PUBLISHING}</td>
			  </tr>
			  {TABLE_DATA}
				<tr class="table_header">
				<td colspan="100%" id="paging"  class="tdcaptions" align="center">{PAGELINK}&nbsp;</td>
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

