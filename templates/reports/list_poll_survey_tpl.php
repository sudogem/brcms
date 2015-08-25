<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
<link rel="stylesheet" href="../templates/admin2.css" />
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
				document.adminForm.submit(); 
			}
			else return false;
		}
	}

	function openpopup( url ){
		var popurl= url;
		winpops=window.open(popurl,"","width=500,height=400,scrollbars=yes,resizable=yes")
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
					<form name="adminForm" method="post" action="../admin/delete_poll.php" >
					<input type="hidden" name="boxchecked" value="0" />
						<div id="toolbar_panel">
							<div id="toolbar_btn">
								<a href="add_new_poll.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/new_f2.png',1)"><img src="../admin/images/new.png" name="Image1" width="32" height="32" border="0">New</a>
							</div>
							<div id="toolbar_btn">
								<a href="list_poll_survey.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image3" width="32" height="32" border="0">Refresh</a>
							</div>		
							<div id="toolbar_btn">
								<a href="#" onClick="return confirmdelete();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('btndelete','','../admin/images/delete_f2.png',1)"><img src="../admin/images/delete.png" name="btndelete" width="32" height="32" border="0">Delete</a>						
							</div>
						</div>
							<h1 class="asterisk">Poll Survey Manager</h1>						
				    		<table width="100%" class="ctable">
								<tr>
									<td width="100%">
								<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ctable2" >
									<tr class="table_header">
									<td width="1%"  class="tdcaptions">#</td>
									<td width="2%" class="tdcaptions"><input type="checkbox" name="toggle" value="" onClick="checkAll({NUMITEMS});" > </td>
              <td width="29%"  class="tdcaptions">{POLL_TITLE}</td>
              <td width="22%"  class="tdcaptions">{DATE_CREATED}</td>
			  <td width="18%"  class="tdcaptions">{EXPIRY_DATE}</td>
			  <td width="22%"  class="tdcaptions">{VIEW_GRAPH_LABEL}</td>
			  </tr>
								  {TABLE_DATA}
								  	<tr class="table_header">
									<td colspan="100%" id="paging"  class="tdcaptions" align="center">{PAGE_LINK}&nbsp;</td>
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
