<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
<link rel="stylesheet" href="../templates/admin2.css" />

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
					<form name="users" method="post" >
						<div id="toolbar_panel">
							<div id="toolbar_btn">
							<a href="add_user_profile.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/new_f2.png',1)"><img src="../admin/images/new.png" name="Image1" width="32" height="32" border="0">New</a></div>
							<div id="toolbar_btn">
							<a href="user_manager2.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image3" width="32" height="32" border="0">Refresh</a>
							</div>							
						</div>
					
					<h1 class="asterisk">User Manager </h1>
				    		<table width="100%" class="ctable">
								<tr>
									<td width="100%">
					
					<table width="100%" border="0" cellpadding="4" cellspacing="0" class="ctable2">
					  <tr class="table_header">
						<td width="1%" class="tdcaptions">#</td>
						<td width="16%" class="tdcaptions">{FULLNAME}</td>
						<td width="10%" class="tdcaptions">{USERNAME}</td>	
						<td width="5%" align="left" class="tdcaptions">{LOGGED_IN}</td>
						<td width="5%" align="left" class="tdcaptions">{IS_ENABLED}</td>		
						<td width="13%" class="tdcaptions">{GROUP}</td>
						<td width="10%" class="tdcaptions">{EMAIL}</td>
						<td width="15%" class="tdcaptions">{LAST_VISIT}</td>
					  </tr>
					  {TABLE_DATA}
						<tr class="table_header">
						<td colspan="100%" id="paging"  class="tdcaptions" align="center">{PAGELINK}&nbsp;</td>
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

