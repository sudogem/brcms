<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>News Content Reports</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
<link rel="stylesheet" href="../templates/admin2.css" />
</head>

<body>
<div id="">
<table width="100%" border="0" cellspacing="0" class="inboxbody">
	<tr>
	<td width="12%" class="caption2"><div align="left">Name : </div></td>
	<td class="data">{FULLNAME} </td>
	<td class="data">&nbsp;	</td> 
	</tr>
	<tr>
	<td class="caption2"> <div align="left">Position : </div></td>
	<td class="data">{POSITION} </td>
	<td class="data">&nbsp;</td>
	</tr>
	<tr>
	<td class="caption2"><div align="left">Date Prepared  :</div></td>
	<td class="data">{DATE_PREPARED}</td>
	<td class="data"><input type="submit" value=" Print " onClick="window.print(); return false" class="button">&nbsp;&nbsp;&nbsp;<input type="submit"  onClick="window.close();" value=" Close " class="button"></td>
	</tr>
	
	<tr>
	<td class="caption2"><div align="left">Report Title  : </div></td>
	<td class="data">{REPORT_TITLE}</td>
	<td class="data">&nbsp;</td>
	</tr>
  </table>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ctable3">
	<h1 class="asterisk"></h1>				
	<tr class="report_header1">
	<td width="2%" class="rpt_caption">#</td>
	<td width="20%"  class="rpt_caption">{ARTICLE_TITLE}</td>
	<td width="10%"  class="rpt_caption">{CATEGORY}</td>
	<td width="10%"  class="rpt_caption">{AUTHOR}</td>																		
	
	<td width="12%" class="rpt_caption">{FRONTPAGE}</td>
	<td width="5%"  class="rpt_caption">{STAGEID}</td>
	<td width="17%"  class="rpt_caption">{DATE_CREATED}</td>
	<td width="15%"  class="rpt_caption">{DATE_PUBLISHED}</td>
	</tr>
  {TABLE_DATA}
</table>  
</div>
</body>
</html>
