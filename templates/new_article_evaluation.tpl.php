<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
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
				<div id="outerpanel">
					<div id="panel">
						<form name="adminForm" action="send_article_evaluation.php" method="post" >
							<!--<div id="toolbar_panel">
								<div id="toolbar_btn">
									 <a href="view_article_versions.php?stageID=3" onClick="document.adminForm.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image1" width="32" height="32" border="0">Close</a>
								</div>
							
								<div id="toolbar_btn">
									 <a href="send_article_evaluation.php" onClick="document.adminForm.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image1" width="32" height="32" border="0">Send</a>
								</div>
							</div>-->
						<div id="toolbar_panel">
							<div id="toolbar_btn">
							<input type="submit" value="Send" name="send" class="formbutton" >
							<input type="submit" value="Cancel" name="cancel" class="formbutton" >							
							</div>
						</div>	
							<h1 class="asterisk">Article Evaluation</h1>	
							<table width="754" border="0" class="ctable2">
							<tr>
							<td width="16%" class="caption2">Article Title : </td>
							<td class="data">
							{ARTICLE_TITLE}
							</td> 
							
							</tr>
							<tr>
							<td class="caption2">Category : </td>
							<td class="data">{CATEGORY}
							</td>
							</tr>
							<tr>
							<td class="caption2">Date Created  : </td>
							<td class="data">{DATE_CREATED}
							</td>
							</tr>
							
							<tr>
							<td class="caption2">Writer's Name : </td>
							<td class="data">{WRITER_NAME}
							</td>
							</tr>
							<tr>
							<td class="caption2">Editor's Name: </td>
							<td class="data">{EDITOR_NAME}
							</td>
							</tr>
							
							<tr>
							<td align="left" valign="top" class="caption2">Article Body : </td>
							<td width="84%"><p>{ARTICLE_BODY}</p>
							
							</tr>
							<tr>
							<td class="caption2">Date  : </td>
							<td class="data"><input type="text" name="date"  size="100"  class="inputbox" value="{DATE}" >
							</td>
							</tr>
							<tr>
							<td class="caption2">Subject  : </td>
							<td class="data"><input type="text" name="subject" size="100" class="inputbox" value="{SUBJECT}" >
							</td>
							</tr>
							<!--<tr>
							<td class="caption2">Assign to  : </td>
							<td class="data">{ASSIGN}</td>
							</tr>-->
							
							<tr>
							<td align="left" valign="top" class="caption2">Message  : </td>
							<td width="84%"><textarea name="message" style="width:100%" rows="30" class="inputbox" >{MESSAGE}</textarea>
							
							  <!-- <textarea name="articlebody">{ARTICLE_BODY}</textarea> -->	</td>
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
