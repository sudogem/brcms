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
					<form name="adminForm" method="post" action="../admin/archive.php" >
					<div id="toolbar_panel">
						 <div id="toolbar_btn">
							<!--<a href="#" onClick="document.adminForm.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/archive_f2.png',1)"><img src="../admin/images/archive.png" name="Image1" width="32" height="32" border="0">Archive</a>						-->
						 	<!--<input type="hidden" name="archive" value="archive">-->
							<input type="hidden" name="boxchecked" value="0" />
							<input type="submit" onClick="javascript: if (document.adminForm.boxchecked.value == 0) { alert('Please select an item from the list to archive. '); }else{ document.adminForm.submit(); }" value="Archive" name="archive" class="formbutton" >
						 </div>
					 </div> 			
<table width="100%" border="0" class="midpanel" >
  <tr>
    <td width="50%" rowspan="2" class="asterisk">My Articles</td>
    <td width="70%">
		<div align="right">
		 <select name="status" class="inputbox" onChange="document.adminForm.submit();">
				<option value="0" >&nbsp; - Select Status - &nbsp;</option>
				{LIST_OF_STATUS}
			</select>
			<select name="category" class="inputbox" onChange="document.adminForm.submit();">
				<option value="0" >&nbsp; - Select Category - &nbsp;</option>
				{CATEGORY_NAMES}
			</select>
		</div>	
	</td>
  </tr>
  <tr>
    <td>			
		<div align="right">
			Filter Article title : <input name="filter_text" type="text" class="inputbox"  onChange="document.adminForm.submit();" value="{FILTER_TEXT}" size="21" > 
	   </div> 
	</td>
  </tr>
</table>
								<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ctable2">
									<tr class="table_header">
									<td width="2%" class="tdcaptions">#</td>
									<td width="2%" class="tdcaptions"><input type="checkbox" name="toggle" value="" onClick="checkAll({NUMITEMS});" > </td>
									<td width="25%" class="tdcaptions">{ARTICLE_TITLE}</td>
									<td width="10%" class="tdcaptions">{CATEGORY}</td>
									<td width="10%" class="tdcaptions">{STAGEID}</td>
									<td width="5%" class="tdcaptions">{STATUS}</td>
									
									<td width="15%" class="tdcaptions">{DATE_CREATED}</td>
									<td width="15%"  class="tdcaptions">{LAST_MODIFIED}</td>
									
									</tr>
								  {TABLE_DATA}
									<tr class="table_header">
									<td colspan="100%" id="paging"  class="tdcaptions" align="center">{PAGELINK}&nbsp;</td>
									</tr>
								</table>
							<div class="clear">&nbsp;</div>
							<div class="totop">
								<a href="#">Back to top</a><img src="../admin/images/arrow_up.gif">								
							</div>

					  </form>
					</div>
		</div>
		<div class="clear">&nbsp;</div>
		<div id="footer">{FOOTER}</div>
		</div>	<!-- CONTINER -->
	</div><!-- WRAPPER -->
</body>
</html>
