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
					<form name="adminForm" method="post" action="../admin/my_tasks.php" >
					<input type="hidden" name="boxchecked" value="0" >
						<div id="toolbar_panel">
							<div id="toolbar_btn">
								<a href="#"  onClick="confirmdelete();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('delete','','../admin/images/delete_f2.png',1)"><img src="../admin/images/delete.png" name="delete" width="32" height="32" border="0" align="absmiddle">Delete</a>																				
							</div>
					  </div>
						<table width="100%" border="0" class="midpanel" >
  <tr>
    <td width="50%" rowspan="2" class="asterisk">My Tasks</td>
    <td width="70%">		<div align="right">
		 <select name="priority" class="inputbox" onChange="document.adminForm.submit()">
				<option value="0" >&nbsp; - Select Priority - &nbsp;</option>
					{LIST_OF_PRIORITY}
			</select>
		</div>	
	</td>
  </tr>
  <tr>
    <td>			
		<div align="right">	   </div> 
	</td>
  </tr>
</table>
								<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ctable2">
									<tr class="table_header">
									<td width="2%" class="tdcaptions">#</td>
									<td width="2%" class="tdcaptions"><input type="checkbox" name="toggle" value="" onClick="checkAll({NUMITEMS});" > </td>
									<td width="25%" class="tdcaptions"> {SUBJECT}</td>
									<td  width="15%" class="tdcaptions">{DATE_CREATED}</td>
									
									<td width="20%" class="tdcaptions">{DUE_DATE}</td>
									<td width="10%" class="tdcaptions">{PRIORITY}</td>

									<td width="10%" class="tdcaptions">{STATUS}</td>
									</tr>
								  {TABLE_DATA}
									<tr class="table_header">
									<td colspan="100%" id="paging"  class="tdcaptions" align="center">{PAGELINK}&nbsp;</td>
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
