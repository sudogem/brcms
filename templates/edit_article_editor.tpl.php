<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="brainwired@gmail.com" />
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../Editor/editor.js" ></script>
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
				<form name="adminForm" method="post" onSubmit="editor.prepareSubmit()" action="../Editor/save.php">
				<div id="toolbar_panel">
					<div id="toolbar_btn">
						<a href="../admin/view_article_versions.php?stageID=2"  onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/cancel_f2.png',1)"><img src="../admin/images/cancel.png" name="Image2" width="32" height="32" align="absmiddle" border="0">Close</a>						
					</div>				
				
					<div id="toolbar_btn">
						<a href="edit_article.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image3" width="32" height="32" align="absmiddle" border="0">Refresh</a>
					</div>							
				
					<div id="toolbar_btn">
						<a href="#" onClick="popupWindow('../admin/popups/uploadimage.php','win1',350,350,'no');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image4" width="32" height="32" align="absmiddle" border="0">Upload</a>						
					</div>
				</div>				<input type="hidden" name="articleID" value="<?php echo $_POST['articleID']; ?>">
				<input type="hidden" name="userID" value="<?php echo $_SESSION['userID']?>">
				<input type="hidden" name="stageID" value="1" >
				<input type="hidden" name="task" value="edit" >
				<h1 class="asterisk">Content Item: Edit</h1>	
				<div id="editor">
				<table width="556">
					<tr>
						<td width="123"><h1 class="caption">Article Title :</h1></td> 
						<td width="421"><input name="title" value="{ARTICLE_TITLE}" size="65" class="inputbox"></td>
					</tr>
				
					<tr>
					  <td valign="top"><h1 class="caption">Keywords :</h1></td>
					  <td><textarea name="keywords" cols="50" rows="5" class="inputbox">{KEYWORDS}</textarea></td>
				  </tr>
					<tr>
						<td><h1 class="caption">Category :</h1> </td>      
						<td>
						<!--<input name="category" value=""> -->
						<select name="category" class="inputbox">
							{CATEGORY_NAMES}
						</select> 
						</td>
					</tr>
				
					<tr>
						<td><h1 class="caption">Date Created :</h1></td>  
						<td class="data">{DATE_CREATED}</td>
					</tr>
					<tr>
						<td><h1 class="caption">Stage :</h1></td>  
						<td class="data">
						<select name="stage" class="inputbox">
						{STAGE}
						</select>
						</td>
					</tr>
					<tr>
						<td><h1 class="caption">Section : </h1></td>  
						<td class="data">
						<select name="frontpage" class="inputbox">
						{FRONTPAGE}
						</select>
						</td>
					</tr>
					
					<tr>
						<td><h1 class="caption">Editor  :</h1></td>  
						<td class="data">{AUTHOR}</td>
					</tr>
					
					
				</table>
				
					<!-- The Editor-->
					<script type="text/javascript">
						var editor = new WYSIWYG_Editor('editor', '{BODY}' );
						editor.display();
					</script>
				</div>
				<div id="imagepanel2">
				  <p class="orange">&nbsp;&nbsp;<b>Uploaded images:</b></p>
				  <p>&nbsp;&nbsp;Note: Please select the image that will appear with the article.</p>				  
					<div id="imageexplorer2">
					  {THUMBNAIL}
					</div> 
				</div>				
				</form>
			</div><!-- PANEL -->	
			</div>
		</div>
	<div class="clear">&nbsp;</div>
	<div id="footer">
		{FOOTER}
	</div>	
</div>
</body>
</html>
