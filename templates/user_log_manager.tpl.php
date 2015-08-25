<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
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
			<div id="outerpanel">
<div id="panel">
<form name="users" method="post" >
<h1 class="asterisk">User Log Manager </h1>


<table width="100%" border="0" cellpadding="4" cellspacing="0" class="ctable">
  <tr class="table_header"  align="center">
    <td>{FULLNAME}</td>
	<td width="12%" >{USERNAME}</td>	
	<td width="12%" >{DAY}</td>
	<td width="12%" >{MONTH}</td>		
    <td width="12%" >{YEAR}</td>
    <td width="12%" >{TIME}</td>
  </tr>
    {TABLE_DATA}
	<tr class="table_header">
	<td colspan="100%" id="paging"  class="tdcaptions" align="center">{PAGELINK}&nbsp;</td>
	</tr>
	
</table>
</form>
</div>
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

