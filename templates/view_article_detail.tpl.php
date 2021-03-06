<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
<script type="text/javascript" language="javascript">
	function submitbutton(pressbutton){
		switch(pressbutton){
			case 'submit2editor':
				var ans = confirm("Are you sure you want to submit the article to the News Editor?");
				if (ans == true) {
					return true;
				}else return false;
				break;
		}
	}
</script>
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
								<div id="toolbar_panel">
									<div id="toolbar_btn">
										<a href="../admin/edit_article.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('editbtn','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="editbtn" width="32" height="32" align="absmiddle" border="0">Edit</a>						
									</div>
									<div id="toolbar_btn">
										<a href="../admin/submit_to_editor.php" onClick="return submitbutton('submit2editor');"  onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/new_f2.png',1)"><img src="../admin/images/new.png" name="Image2" width="32" height="32" align="absmiddle" border="0">Submit to News Editor</a>													
									</div>
									<div id="toolbar_btn">
										<a href="javascript:void window.open('{LINK}', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/preview_f2.png',1)"><img src="../admin/images/preview.png" name="Image3" width="32" height="32" align="absmiddle" border="0">Preview</a>
									</div>
								</div>								
								<h1 class="asterisk">Content Item: Details</h1>	
								<table width="100%" border="0" class="ctable2">
								<tr>
								<td width="12%" class="caption2">Article Title : </td>
								<td class="data">
								{ARTICLE_TITLE}
								<!-- <input type="text" name="title" value="{ARTICLE_TITLE}"> -->
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
								<td class="caption2">Author : </td>
								<td class="data">{AUTHOR}</td>
								</tr>
								
								<tr>
								<td class="caption2" valign="top">Article Body : </td>
								<td class="data" width="80%">{ARTICLE_BODY}</td>								
								</tr>
								</table>
			<div class="clear"></div>					
			<div id="imagepanel3">
				  <p class="orange">&nbsp;&nbsp;<b>Uploaded images:</b></p>
				<div id="imageexplorer3">
				  {THUMBNAIL}
				 </div> 
			</div>				
						</div><!-- end panel -->				
				</div><!-- end outerpanel -->				
			</div>
		</div>
	<div class="clear">&nbsp;</div>
	<div id="footer">
		{FOOTER}
	</div>	
		
	</div>
		
</body>
</html>
