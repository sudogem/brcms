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
					<form name="adminForm" method="post" action="../admin/delete_message.php" >
							<input type="hidden" name="boxchecked" value="0" />
							<input type="hidden" name="task" /> 
					
					<div id="toolbar_panel">
							<!-- <div id="toolbar_btn">
								<a href="#" onClick="submitbutton('delete');"   onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/delete_f2.png',1)"><img src="../admin/images/delete.png" name="Image1" width="32" height="32" border="0">Delete</a>						
							</div>-->
							<div id="toolbar_btn">
								<a href="../admin/new_private_message.php" onClick="document.adminForm.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/new_f2.png',1)"><img src="../admin/images/new.png" name="Image2" width="32" height="32" border="0">New</a>													
							</div>
							<div id="toolbar_btn">
								<a href="javascript: if (document.adminForm.boxchecked.value==0) { alert('Please select an item from the lists to delete.');} else { 			var reply = confirm('Are you sure you want to delete selected items?');	if (reply == true) { submitbutton('archive') } } "  onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('ar','','../admin/images/delete_f2.png',1)"><img src="../admin/images/delete.png" name="ar" width="32" height="32" border="0">Delete</a>													
							</div>
							
						</div><br>
						<h1 class="inbox">Private Messaging</h1>
				    		<table width="100%" class="ctable">
								<tr>
									<td width="100%">
								<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ctable2">
									<tr class="table_header">
									<td width="2%" class="tdcaptions">#</td>
									<td width="2%" class="tdcaptions"><input type="checkbox" name="toggle" onClick="checkAll({NUMITEMS});" > </td>
									<td width="37%" class="tdcaptions">{MESSAGE_SUBJECT}</td>
									<td width="20%" class="tdcaptions">{FROM}</td>
									<td width="25%" class="tdcaptions">{DATE}</td>
									<td width="9%" class="tdcaptions">{READ}</td>
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
		<div class="clear">&nbsp;</div>
		<div id="footer">{FOOTER}</div>
		</div>	<!-- CONTINER -->
	</div><!-- WRAPPER -->
</body>
</html>
