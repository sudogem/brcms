<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
<link rel="stylesheet" href="../templates/admin2.css" />
<script language="javascript">
	function lickme( cmd ){
		switch( cmd ) {
			case 'restore':
				if (document.adminForm.boxchecked.value == 0) { 
					alert('Please select an item from the list to restore the database. '); 
					return false;
				}else{
					var reply = confirm('Are you sure you want to restore the selected database?');
					if (reply == true) {
						document.adminForm.submit(); 
						return true;
					}
					else return false;
				}
				break;
			case 'delete':	
				if (document.adminForm.boxchecked.value == 0) { 
					alert('Please select an item from the list to delete. '); 
					return false;
				}else{
					var reply = confirm('Are you sure you want to delete selected items?');
					if (reply == true) {
						document.adminForm.submit(); 
						return true;
					}
					return false;
				}
				break;
		}
	}
	
</script>
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
					<form name="adminForm" method="post"  action="backuprestore.php" >
						<div id="toolbar_panel">
							<div id="toolbar_btn">
								<input type="submit" value="Backup" name="backup" class="formbutton" >							
								<input type="submit" onClick="return lickme('restore');" value="Restore" name="restore" class="formbutton" >
								<input type="submit" onClick="return lickme('delete');" value="Delete" name="delete" class="formbutton" >								
								<input type="hidden" name="boxchecked" value="0" />
							</div>
						</div>
					<h1 class="asterisk">Backup / Restore Database </h1>
				    		<table width="100%" class="ctable">
								<tr>
									<td width="100%">
					
					<table width="100%" border="0" cellpadding="4" cellspacing="0" class="ctable2">
					  <tr class="table_header">
						<td width="2%" class="tdcaptions">#</td>
						<td width="2%" class="tdcaptions"><input type="checkbox" name="toggle" value="" onClick="checkAll({NUMITEMS});" > </td>
						<td width="41%" class="tdcaptions">{FILENAME}</td>
						<td width="39%" class="tdcaptions">{CREATED}</td>
						<td width="14%" class="tdcaptions">{SIZE}</td>
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

