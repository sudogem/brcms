<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
			<div id="content">
<div id="panel">
<form name="view_article" action="view_article_details.php" method="post" >
<table width="558" border="0">
  <tr>
    <td>ARTICLE_TITLE</td>
    <td>
	<label>{ARTICLE_TITLE}</label>
	<!-- <input type="text" name="title" value="{ARTICLE_TITLE}"> -->
	</td> 
	
  </tr>
  <tr>
    <td>CATEGORY</td>
    <td>{CATEGORY}
	</td>
  </tr>
  <tr>
    <td>AUTHOR</td>
    <td><label>{ARTICLE_AUTHORS}</label>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">ARTICLE_BODY</td>
    <td width="80%">		<p>{ARTICLE_BODY}</p>

	<!-- <textarea name="articlebody">{ARTICLE_BODY}</textarea> -->	</td>
  </tr>
</table>
</form>
</div>			</div>
		</div>
	<div class="clear">&nbsp;</div>
	<div id="footer">
		{FOOTER}
	</div>	
		
	</div>
		
</body>
</html>
