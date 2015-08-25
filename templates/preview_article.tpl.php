<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Preview</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />

</head>

<body>
	<div id="preview">
	<table width="100%" border="0" class="ctable2">
  <tr>
    <td width="17%" class="caption2">Article title :</td>
    <td width="83%"><span class="chead">{TITLE}</span></td>
  </tr>
  <tr>
    <td class="caption2">Category :</td>
    <td>{CATEGORY}
</td>
  </tr>
  <tr>
    <td class="caption2">Written by: </td>
    <td>{WRITER_NAME}
</td>
  </tr>
  <tr>
    <td class="caption2">Date Created: </td>
    <td>{DATE_CREATED}</td>
  </tr>
  <tr>
    <td class="caption2" valign="top">Article Body : </td>
    <td>{ARTICLE_BODY}</td>
  </tr>
</table>
<div class="clear"></div>					
<div id="imagepanel3">
	  <p class="orange">&nbsp;&nbsp;<b>Uploaded images:</b></p>
	<div id="imageexplorer3">
	  {THUMBNAIL}
	 </div> 
</div>				
<table align="center" width="90%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td width="50%" align="right"><a href="#" onClick="window.close()">Close</a></td>
		<td width="50%" align="left"><a href="javascript:;" onClick="window.print(); return false">Print</a></td>
	</tr>	
</table>
	
</body>
</html>
