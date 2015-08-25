<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../templates/admin.css" />
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<link rel="stylesheet" type="text/css" href="../templates/admin.css" />

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
			<div id="sidenav">
				{SIDENAV}
			</div>
			<div id="content">
				<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ctable">
				  <h1 class="asterisk">{MESSAGE}</h1>
				  <tr class="table_header">
					<td align="left" class="tdcaptions">{ARTICLE_TITLE}</td>
					<td class="tdcaptions">{CATEGORY}</td>
					<td class="tdcaptions">{AUTHOR}</td>
					<td class="tdcaptions">{DATE}</td>
					<!--<td>{MODIFIED_DATE}</td>
					<td>{MODIFIED_BY}</td>-->
				  </tr>
				  {TABLE_DATA}
				</table>
			</div>
		</div>
	<div class="clear">&nbsp;</div>
	<div id="footer">
		{FOOTER}
	</div>	
		
	</div>
		
</body>
</html>
