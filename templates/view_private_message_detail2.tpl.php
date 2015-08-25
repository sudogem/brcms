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
					<div id="panel">
						<form name="adminForm" action="../admin/delete_message.php" method="post" >
						<input type="hidden" name="task" >
						<input type="hidden" name="boxchecked" value="1" >						
						<div id="toolbar_panel">
							<!-- <div id="toolbar_btn">
								<a href="#" onClick="submitbutton('delete');"   onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/delete_f2.png',1)"><img src="../admin/images/delete.png" name="Image1" width="32" height="32" border="0">Delete</a>						
							</div>-->
							<div id="toolbar_btn">
								<a href="new_private_message.php" onClick="submitbutton('new');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/new_f2.png',1)"><img src="../admin/images/new.png" name="Image2" width="32" height="32" border="0">Reply</a>													
							</div>
							
							
						</div>
						
							<h1 class="inbox">View Private Message </h1>	
							<table width="100%" border="0" cellspacing="0" class="inboxbody">
							<tr>
							<td width="6%" class="caption2"><div align="right">From : </div></td>
							<td class="data">
							{FROM}
							</td> 
							</tr>
							<tr>
							<td class="caption2"> <div align="right">Date : </div></td>
							<td class="data">{POSTED}
							</td>
							</tr>
							<tr>
							<td class="caption2"><div align="right">To :</div></td>
							<td class="data">{AUTHOR}</td>
							</tr>
							
							<tr>
							<td class="caption2"><div align="right">Subject : </div></td>
							<td class="data">{SUBJECT}</td>
							</tr>
							
							<tr>
							<td align="left" valign="top" class="caption2"><div align="right">Message  : </div></td>
							<td width="94%"><p>{MESSAGE}</p>
							
							  <!-- <textarea name="articlebody">{ARTICLE_BODY}</textarea> -->	</td>
							</tr>
							</table>
						</form>
					</div>
			</div>
		</div>
	<div id="footer">{FOOTER}</div>	
	<div class="clear">&nbsp;</div>
	</div>
</body>
</html>
