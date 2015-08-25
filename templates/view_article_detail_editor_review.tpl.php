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
			case 'return2writer':
				var ans = confirm("Are you sure you want to return the article to the Writer ?");
				if (ans == true) {
					return true;
				}else return false;
				break;
			case 'submit2newsdirector':
				var ans = confirm("Are you sure you want to submit the article to the News Director?");
				if (ans == true) {
					document.adminForm.task.value=pressbutton;
					document.adminForm.submit();
					//return true;
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
					 <form name="adminForm" method="post" action="../admin/submit_to_newsdirector.php" >
					 	<input type="hidden" name="task" >
					 	<input type="hidden" name="frontpage" value="3" > 
						<input type="hidden" name="imageID" value="-1" > 
					<div class="clear"></div>
						<div id="toolbar_panel">
							<div id="toolbar_btn">
								<a href="../admin/edit_article.php"  onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image10','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image10" width="32" height="32" border="0" align="absmiddle">Edit</a>						
							</div>
							<div id="toolbar_btn">
								<a href="../admin/new_article_evaluation.php?status=revise" onClick="return submitbutton('return2writer');"   onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/new_f2.png',1)"><img src="../admin/images/new.png" name="Image2" width="32" height="32" border="0" align="absmiddle">Return to Writer</a>													
							</div>
							<div id="toolbar_btn">
								<a href="#" onClick="submitbutton('submit2newsdirector');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/new_f2.png',1)"><img src="../admin/images/new.png" name="Image3" width="32" height="32" border="0" align="absmiddle">Submit to News Director</a>				
							</div>
							<div id="toolbar_btn">
								<a href="javascript:void window.open('{LINK}', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','../admin/images/preview_f2.png',1)"><img src="../admin/images/preview.png" name="Image4" width="32" height="32" align="absmiddle" border="0">Preview</a>
							</div>							
						</div>	
								<h1 class="asterisk">Content Item: Details</h1>	
								<table width="100%" border="0" class="ctable2">
								<tr>
								<td width="10%" class="caption2">Article Title : </td>
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
								<td class="data">{AUTHOR}
								</td>
								</tr>
								<!-- 
								<tr>
								<td class="caption">Frontpage Section: </td>
								<td class="data">
								<select name="frontpage" >{FRONTPAGE_SECTIONS}</select>
								</td>
								</tr>
								-->
								<tr>
								<td align="left" valign="top" class="caption2">Article Body : </td>
								<td class="data"width="83%">{ARTICLE_BODY}	</td>
								</tr>
								</table>			<div class="clear"></div>					

							<div id="imagepanel3">
				  <p class="orange">&nbsp;&nbsp;<b>Uploaded images:</b></p>
				<div id="imageexplorer3">
				  {THUMBNAIL}
				 </div> 
			</div>							
					</form>	
					</div><!-- panel -->
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
