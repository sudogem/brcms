<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../templates/admin2.css" />
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>

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
			<div id="sidenav">
				{SIDENAV}
			</div>
			<div id="content">
				<div id="outerpanel">
					<!-- <div id="toolbar_panel">
						<div id="toolbar_btn">
							 <a href="../editor/edit_article.php" onClick="document.adminForm.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image1" width="32" height="32" border="0">Edit</a>
						</div>
						<div id="toolbar_btn">
							 <a href="../editor/add_article.php" onClick="document.adminForm.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/new_f2.png',1)"><img src="../admin/images/new.png" name="Image2" width="32" height="32" border="0">New</a>
						</div>
					</div>-->
				
				<h3 class="msginfo">{MESSAGE}</h3>
					<div id="panel">
					<form name="adminForm" method="post" action="../editor/edit_article.php" >
						<!-- </div> -->
							<div id="toolbar_panel">
								<input type="submit" value="Help" name="help" class="formbutton" >
								<input type="submit" value="Edit" name="edit" class="formbutton" >
							</div>
								<table width="100%" border="0" cellspacing="1" cellpadding="4" >
									<h1 class="asterisk">Content Items </h1>						
									<tr class="table_header">
									<td width="2%" align="center" class="tdcaptions">#</td>
									<td width="2%" align="center" class="tdcaptions"><input type="checkbox" name="toogle" onClick="checkAll(9);" > </td>
									<td width="25%" align="center" class="tdcaptions">{ARTICLE_TITLE}</td>
									<td width="19%" align="center" class="tdcaptions">{AUTHOR}</td>																		
									<td width="15%" align="center" class="tdcaptions">{CATEGORY}</td>

									<td width="10%" align="center" class="tdcaptions">{STAGEID}</td>
									<td width="25%" align="center" class="tdcaptions">{DATE_CREATED}</td>
									</tr>
								  {TABLE_DATA}
								  	<tr class="table_header">
									<td colspan="100%">&nbsp;</td>
									</tr>
								  
								</table>
						</form>	
					</div><!-- PANEL -->
				</div>	
		</div>					
		<div class="clear">&nbsp;</div>
		<div id="footer">{FOOTER}</div>
		</div>	<!-- CONTINER -->
	</div><!-- WRAPPER -->
</body>
</html>
