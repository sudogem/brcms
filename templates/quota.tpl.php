<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="brainwired@gmail.com" />
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
<script type="text/javascript" language="javascript">
	function confirmdelete() {
		var f = document.adminForm;
 		if (document.adminForm.boxchecked.value == 0) { 
			alert('Please select an item from the list to delete. '); 
			return false;
		}
		else{
			var reply = confirm('Are you sure you want to delete selected items?');
			if (reply == true) {
				document.adminForm.task.value='delete';
				document.adminForm.submit(); 
			}
			else return false;
		}
	}
</script>

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
					<form name="adminForm" method="post" action="../admin/save_quota.php">
					<input type="hidden" name="boxchecked" value="0" />
					<input type="hidden" name="task" value="" >
						<div id="toolbar_panel">
							<div id="toolbar_btn">
								<a href="#" onClick="return confirmdelete();"    onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/delete_f2.png',1)"><img src="../admin/images/delete.png" name="Image1" width="32" height="32" border="0" align="absmiddle">Delete</a>						
							</div>							
							<div id="toolbar_btn">
								<a href="add_new_quota.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('new','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="new" width="32" height="32" border="0" align="absmiddle">New</a>
							</div>							
							<div id="toolbar_btn">
								<a href="javascript:if(document.adminForm.boxchecked.value==0) {alert('Please select an item to make default.'); } else {submitbutton('default');}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('default','','../admin/images/publish_f2.png',1)"><img src="../admin/images/publish.png" name="default" width="32" height="32" border="0" align="absmiddle">Default</a>
							</div>							
						</div>
					
					<h1 class="asterisk">Quota Manager </h1>
				    		<table width="100%" class="ctable">
								<tr>
									<td width="100%">
					<table width="100%" border="0" cellpadding="4" cellspacing="0" class="ctable2">
					  <tr class="table_header">
						<td width="2%" class="tdcaptions">#</td>
						<td width="3%" class="tdcaptions">&nbsp; </td>
						<td width="7%" class="tdcaptions">{QUOTA}</td>
						<td width="88%" class="tdcaptions">{DEFAULT}</td>	
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

