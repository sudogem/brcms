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
					<form name="adminForm" method="post" >
					<input type="hidden" name="boxchecked" value="0" >
						<div id="toolbar_panel">
							<div id="toolbar_btn">
							<a href="add_new_site_content.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/new_f2.png',1)"><img src="../admin/images/new.png" name="Image1" width="32" height="32" border="0">New</a></div>
					  </div>
						<h1 class="asterisk">Other Site Content </h1>
				    		<table width="100%" class="ctable">
								<tr>
									<td width="100%">
					
					<table width="100%" border="0" cellpadding="4" cellspacing="0" class="ctable2">
					  <tr class="table_header">
						<td width="1%" class="tdcaptions">#</td>
									<td width="2%" class="tdcaptions"><input type="checkbox" name="toggle" value="" onClick="checkAll({NUMITEMS});" > </td>
						
						<td width="16%" class="tdcaptions">{TITLE}</td>
						<td width="10%" class="tdcaptions">{STATUS}</td>	
						<td width="10%" class="tdcaptions">{AUTHOR}</td>							
						<td width="10%" align="left" class="tdcaptions">{DATE_CREATED}</td>
						<td width="10%" align="left" class="tdcaptions">{LAST_MODIFIED}</td>		
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

