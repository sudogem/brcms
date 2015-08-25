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
						<!--<div id="toolbar_panel">
							<div id="toolbar_btn">
								<a href="../editor/edit_article.php" onClick="document.adminForm.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image1" width="32" height="32" border="0">Edit</a>						
							</div>
							<div id="toolbar_btn">
								<a href="../editor/add_article.php"  onClick="document.adminForm.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/new_f2.png',1)"><img src="../admin/images/new.png" name="Image2" width="32" height="32" border="0">New</a>													
							</div>
						</div> -->
				<h3 class="msginfo">{MESSAGE}</h3>
					<div id="panel">
					<form name="adminForm" method="post" action="../admin/report_editor_articles.php" >
						<div id="toolbar_panel">
						
							<div id="toolbar_btn">
							<a href="javascript:void window.open('{LINK}', 'report_editor_articles', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/preview_f2.png',1)"><img src="../admin/images/preview.png" name="Image3" width="32" height="32" align="absmiddle" border="0">Preview</a>
							</div>
						</div>
					<h1 class="asterisk">Editor Report</h1>
                    <table width="100%" border="0"  class="ctable">
					  <tr>
						<td colspan="6">View Reports By: </td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td width="98">Select Month:</td>
						<td width="10">&nbsp;</td>
						<td width="92">Select Year: </td>
						<td width="213">&nbsp;</td>
						<td width="257">&nbsp;</td>
					  </tr>
					  <tr>
					    <td>&nbsp;</td>
					    <td><select name="month">
                          <option value="1">January</option>
                          <option value="2">February</option>
                          <option value="3">March</option>
                          <option value="4">April</option>
                          <option value="5">May</option>
                          <option value="6">June</option>
                          <option value="7">July</option>
                          <option value="8">August</option>
                          <option value="9">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12">December</option>
                        </select></td>
					    <td>&nbsp;</td>
					    <td><select name="year">
							{LISTOFYEAR}
				        </select></td>
					    <td><input type="submit" name="submit" value="View Report" class="button"></td>
					    <td>&nbsp;</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td width="11">&nbsp;</td>
						<td colspan="5">&nbsp;</td>
					  </tr>
</table>					 
								<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ctable2">
									<h1 class="asterisk"></h1>				
									<tr class="table_header">
									<td width="2%" class="tdcaptions">#</td>
									<td width="20%" class="tdcaptions">{ARTICLE_TITLE}</td>
									<td width="15%" class="tdcaptions">{CATEGORY}</td>
									<td width="15%" class="tdcaptions">{WRITTEN_BY}</td>									
									<td width="8%" class="tdcaptions">{STAGEID}</td>
									<td width="20%" class="tdcaptions">{DATE_CREATED}</td>
									<td width="20%" class="tdcaptions">{LAST_MODIFIED}</td>									
									</tr>
								  {TABLE_DATA}
								  <tr>
								  <td colspan="100%" align="center" class="missingfield">{RESULT_MSG}</td>
								  </tr>
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
