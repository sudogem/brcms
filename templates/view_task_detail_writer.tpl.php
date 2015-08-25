<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
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
				<div id="panel" >
				<form name="adminForm" method="post" action="edit_category.php">
				<div id="toolbar_panel">
					<div id="toolbar_btn">
						<a href="../admin/my_tasks.php"  onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/cancel_f2.png',1)"><img src="../admin/images/cancel.png" name="Image2" width="32" height="32" align="absmiddle" border="0">Cancel</a>						
					</div>				
				  </div>
				<div id="clear">&nbsp;</div>
					<h1 class="asterisk">Tasks : View</h1>	
					<table width="100%" cellpadding="4"  cellspacing="1"  class="ctable" id="tdata">
					<tr class="table_header" align="left">
						<th colspan="5" class="tdcaptions">
						Details
						</th>
					</tr>
					<tr>
						<td width="169">
						Subject :
						</td>
						<td width="1488">
						{SUBJECT}
						  </td>
					</tr>
					<tr>
					  <td valign="top">Description : </td>
					  <td>{DESCRIPTION}</td>
					  <tr>
					    <td valign="top">Created : </td>
					    <td>{CREATED}</td>
				      <tr> 
					    <td valign="top">Start Date : </td>
					    <td>{STARTDATE}</td>
				      <tr>
				        <td valign="top">Due Date : </td>
				        <td>{DUEDATE}</td>
			          <tr>
			            <td valign="top">Status : </td>
			            <td>{STATUS}</td>
		              <tr>
		                <td valign="top">Priority : </td>
		                <td>{PRIORITY}</td>
	                  <tr>
						<td valign="top">Assigned to : </td>
						<td>
						{ASSIGNEDTO}
						</td>
					
					<tr>
						<td colspan="2">&nbsp;
					
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

