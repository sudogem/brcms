<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="brainwired@gmail.com" />
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../Editor/editor.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />
<script type="text/javascript" language="javascript">
	function validate(){
		var f = document.adminForm;
		if ( f.title.value=="" ) {
			alert( "You need to enter a title of the article." );return false;
		}
	 	editor.prepareSubmit();
		return true;
	}
</script>
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
			<form name="adminForm" id="adminForm" onSubmit="return validate();" method="post" action="save.php"  >
				<input type="hidden" name="stageID" value="1" >
				<input type="hidden" name="task" value="edit" >
				<div id="toolbar_panel">
					<div id="toolbar_btn">
						<a href="../admin/my_articles2.php"  onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/cancel_f2.png',1)"><img src="../admin/images/cancel.png" name="Image2" width="32" height="32" align="absmiddle" border="0">Cancel</a>						
					</div>				
				
					<div id="toolbar_btn">
						<a href="edit_article.php"   onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image3" width="32" height="32" align="absmiddle" border="0">Refresh</a>
					</div>							
				
					<div id="toolbar_btn">
						<a href="#" onClick="popupWindow('../admin/popups/uploadimage.php','win1',350,350,'no');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('savebtn','','../admin/images/upload_f2.png',1)"><img src="../admin/images/upload.png" name="savebtn" width="32" height="32" align="absmiddle" border="0">Upload image</a>						
					</div>
					<div id="toolbar_btn">
						<a href="#" onClick="document.adminForm.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','../admin/images/save_f2.png',1)"><img src="../admin/images/save.png" name="Image4" width="32" height="32" align="absmiddle" border="0">Save</a>						
					</div>					
				</div>

			   
				<h1 class="asterisk">Content Item: New</h1>	
				
			<!-- <div id="editor1"> -->
				<!-- Article Information -->
				<table width="523" border="0" class="ctable2">
					<tr>
						<td width="100" class="caption2"><strong>Article Title:</strong></td> 
						<td width="273"><input name="title" value="{ARTICLE_TITLE}" size="40"></td>
						<td width="56">&nbsp;</td>
					</tr>
				
					<tr>
						<td class="caption2"> <strong>Category:</strong></td>      
						<td><select name="category">
						  
							{CATEGORY_NAMES}
						
					    </select></td>
						<td>
						<!--<input name="category" value=""> -->
						</td>
					</tr>
				
					<tr>
						<td class="caption2"><strong>Date Created:</strong></td>  
						<td>{DATE_CREATED}</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td class="caption2"><strong>Stage :</strong></td>      
						<td class="data"><select name="stage">
						  
						{STAGE}
						
					    </select></td>
						<td class="data">&nbsp;
						</td>
					</tr>
					
					<tr>
						<td class="caption2"><strong>Author : </strong></td>  
						<td>{AUTHOR}</td>
						<td>&nbsp;</td>
					</tr>
					<tr>

						<td colspan="2">
							<script type="text/javascript">
								var editor = new WYSIWYG_Editor('editor', '{BODY}', '.', 600, '', 'style.css', '' );
								editor.display();
							</script>
						</td>
					</tr>
					</table>
					

			<!-- </div><!-- editor -->
				<div id="imagepanel2">
				  <p class="orange">&nbsp;&nbsp;<b>Uploaded images:</b></p><br>
					<div id="imageexplorer2">
					  {THUMBNAIL}
					</div> 
				</div>
			</form>
			</div><!-- PANEL-->
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
