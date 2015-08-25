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
					 </div>
<div class="clear">&nbsp;</div>
<table width="100%" class="ctable" >
		<tr>
			<td width="100%"  valign="top">
				<table width="100%" class="adminform">
				<tr class="table_header">
					<td colspan="3" class="tdcaptions">Search</td>
				</tr>
				<tr>
					<td colspan="100%">&nbsp;
				</td>
				</tr>
				<tr>
					<td width="155">
					Article Title :
					</td>
					<td width="1417">&nbsp;
					</td>
				</tr>
				<tr>
					<td>Article Body  :</td>
					<td>&nbsp;
					</td>
				
				<tr>
					<td>
					Category:
</td>
					<td>&nbsp;			        </td>
				</tr>
				<tr>
				  <td>Author : </td>
				  <td>&nbsp;			        </td>
				  </tr>
				<tr>
					<td colspan="2"><input name="submit" type="submit" class="button" value="Search" /></td>
				</tr>
				</table>
			</td>
			</tr>
				</table>
								<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ctable2">
									<tr class="table_header">
									<td width="2%" class="tdcaptions">#</td>
									<td width="2%" class="tdcaptions"><input type="checkbox" name="toggle" value="" onClick="checkAll({NUMITEMS});" > </td>
									<td width="25%" class="tdcaptions">{ARTICLE_TITLE}</td>
									<td width="19%" class="tdcaptions">{CATEGORY}</td>
									<td width="10%" class="tdcaptions">{STAGEID}</td>
									<td width="10%" class="tdcaptions">{STATUS}</td>
									
									<td width="25%" class="tdcaptions">{DATE_CREATED}</td>
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
