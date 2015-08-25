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
			<div id="content">
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
							</div><h1 class="asterisk">Content Items </h1>						
				    		<table width="100%" class="ctable">
								<tr>
									<td width="100%">
								<table width="100%" border="0" cellspacing="0" cellpadding="4" >
									<tr class="table_header">
									<td width="1%"  class="tdcaptions">#</td>
									<td width="14%"  class="tdcaptions">{ARTICLE_TITLE}</td>
									<td width="10%"  class="tdcaptions">{CATEGORY}</td>
									<td width="10%"  class="tdcaptions">{AUTHOR}</td>																		
									
									<td width="12%" class="tdcaptions">{FRONTPAGE}</td>
									<td width="10%"  class="tdcaptions">{STAGEID}</td>									
									<td width="10%" class="tdcaptions">{STATUS}</td>

									<td width="15%"  class="tdcaptions">{DATE_CREATED}</td>
									<td width="15%"  class="tdcaptions">{LAST_MODIFIED}</td>
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
					</div><!-- PANEL -->
		</div>					
		<div class="clear">&nbsp;</div>
		<div id="footer">{FOOTER}</div>
		</div>	<!-- CONTINER -->
	</div><!-- WRAPPER -->
</body>
</html>
