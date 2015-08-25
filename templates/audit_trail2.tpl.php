<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="brainwired@gmail.com" />
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
					<form name="logging" method="post" action="../admin/audit_trail.php" >
					<div id="toolbar_panel">
						 <div id="toolbar_btn">
							<a href="audit_trail.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image3" width="32" height="32" align="absmiddle" border="0">Refresh</a>
						</div>
						<div id="toolbar_btn">
							<a href="javascript:void window.open('{LINK}', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('prev','','../admin/images/preview_f2.png',1)"><img src="../admin/images/preview.png" name="prev" width="32" height="32" align="absmiddle" border="0">Preview</a>
						</div>
						
					 </div>
<div class="clear">&nbsp;</div>
<table width="100%" class="ctable" >
		<tr>
			<td width="100%"  valign="top">
				<table width="100%" class="adminform">
				<tr class="table_header">
					<td colspan="3" class="tdcaptions">Query logging
					</td>
				</tr>
				<tr>
					<td colspan="100%">&nbsp;
				</td>
				</tr>
				<tr>
					<td width="155">
					Username:
					</td>
					<td width="1417">
					<select name="userid" class="inputbox" style="width:240px;">
							<option value="0">Any/ All</option> 
							{USERNAMES}
					</select>
					</td>
				</tr>
				<tr>
					<td>Activity :</td>
					<td>
					<select name="activity" class="inputbox" style="width:240px;">
							<option value="0">Any/ All</option> 
							{ACTIVITIES}
					</select>
					</td>
				
				<tr>
					<td>
					Date From:
</td>
					<td>
					<select name="from_month">
						{FROM_MONTH}
					</select>
					<select name="from_date">		
							{FROM_DATE}
					</select>
					<select name="from_year">		
						{FROM_YEAR}
					</select>									
			</td>
				</tr>
				<tr>
				  <td>Date To : </td>
				  <td>
				<select name="end_month">
					{END_MONTH}
				</select>				
				<select name="end_date">		
						{END_DATE}
				</select>				
					<select name="end_year">		
						{END_YEAR}						
					</select>				  
				  </td>
				  </tr>
				<tr>
					<td colspan="2"><input name="submit" type="submit" class="button" value="Search" /></td>
				</tr>
				</table>
			</td>
			</tr>
				</table>
								<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ctable2">
									<h1 class="asterisk">Query results</h1>				
									<tr class="table_header">
									<td width="1%" class="tdcaptions">#</td>
									<td width="2%" class="tdcaptions"><input type="checkbox" name="toggle" value="" onClick="checkAll({NUMITEMS});" > </td>
									<td width="17%" class="tdcaptions">{USERNAME}</td>
									<td width="18%" class="tdcaptions">{ACTION}</td>
									<td width="34%" class="tdcaptions">{ITEMNAME}</td>									
									<td width="16%" class="tdcaptions">{DATE}</td>									
									<td width="12%" class="tdcaptions">{TIME}</td>
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
