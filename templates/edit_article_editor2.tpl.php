<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript">
</script>

</head>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />
<!-- TinyMCE -->
<script language="javascript" type="text/javascript" src="../Editor/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "specific_textareas",
		theme : "advanced",
		plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,contextmenu,paste,directionality,fullscreen",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add : "emotions,iespell,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		content_css : "example_word.css",
	    plugi2n_insertdate_dateFormat : "%Y-%m-%d",
	    plugi2n_insertdate_timeFormat : "%H:%M:%S",
		external_link_list_url : "example_link_list.js",
		external_image_list_url : "example_image_list.js",
		flash_external_list_url : "example_flash_list.js",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		paste_auto_cleanup_on_paste : true,
		paste_convert_headers_to_strong : false,
		paste_strip_class_attributes : "all",
		paste_remove_spans : false,
		paste_remove_styles : false		
	});

	function fileBrowserCallBack(field_name, url, type, win) {
		// This is where you insert your custom filebrowser logic
		alert("Filebrowser callback: field_name: " + field_name + ", url: " + url + ", type: " + type);

		// Insert new URL, this would normaly be done in a popup
		win.document.forms[0].elements[field_name].value = "someurl.htm";
	}
	function validate(){
		var f = document.adminForm;
		if ( f.title.value=="" ) {
			alert( "You need to enter a title of the article." );return false;
		}
	 	//editor.prepareSubmit();
		document.adminForm.submit();
		return true;
	}
	function submitbutton(pressbutton){
		var f = document.adminForm;
		if (f.title.value == "" ) {
			alert( "You need to enter a title of the article." );
			return false;
		}
		else{
			switch(pressbutton){
				case 'edit' :
					var ans = confirm("Are you sure you want to save the article?");
					if (ans == true) {
						submitform(pressbutton);
						return true;
					}
					break;
				
				case 'saveasdraft':
					var ans = confirm("Are you sure you want to save the article?");
					if (ans == true) {
						submitform(pressbutton);
						return true;
					}
					break;
				case 'submit2editor':
					var ans = confirm("Are you sure you want to submit the article to the News Editor?");
					if (ans == true) {
						submitform(pressbutton);
						return true;
					}
					break;
				case 'submit2newsdirector':
					var ans = confirm("Are you sure you want to submit the article to the News Director?");
					if (ans == true) {
						document.adminForm.task.value=pressbutton;
						document.adminForm.submit();
						return true;
					}else return false;
					break;	
				case 'return2writer':
					var ans = confirm("Are you sure you want to return the article to the Writer?");
					if (ans == true) {
						return true;
					}else return false;
					break;	
					
			}
		}
	}
	
	
</script>
<!-- /TinyMCE -->

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
				<h3 class="msginfo">{MESSAGE}</h3>
				<div id="panel">
			<form name="adminForm" id="adminForm"  method="post" action="../admin/save.php"  >
				<!-- <input type="hidden" name="stage" value="2" >-->
				<input type="hidden" name="task" value="edit" >
				<div id="toolbar_panel">
					<div id="toolbar_btn">
						<a href="../admin/view_article_versions.php?stageID=3"  onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/cancel_f2.png',1)"><img src="../admin/images/cancel.png" name="Image2" width="32" height="32" align="absmiddle" border="0">Cancel</a>						
					</div>				
				
					<div id="toolbar_btn">
						<a href="edit_article.php"   onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image3" width="32" height="32" align="absmiddle" border="0">Refresh</a>
					</div>							
				
					<div id="toolbar_btn">
						<a href="#" onClick="popupWindow('../admin/popups/uploadimage4.php','win1',300,300,'no');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('savebtn','','../admin/images/upload_f2.png',1)"><img src="../admin/images/upload.png" name="savebtn" width="32" height="32" align="absmiddle" border="0">Upload image</a>						
					</div>
					<div id="toolbar_btn">
						<a href="#"  onClick="submitbutton('edit');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','../admin/images/save_f2.png',1)"><img src="../admin/images/save.png" name="Image4" width="32" height="32" align="absmiddle" border="0">Save</a>						
					</div>
					<div id="toolbar_btn">
								<a href="#"  onClick="submitbutton('submit2newsdirector');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('direc','','../admin/images/new_f2.png',1)"><img src="../admin/images/new.png" name="direc" width="32" height="32" border="0" align="absmiddle">Submit to News Director</a>				
					</div>					
					<div id="toolbar_btn">
								<a href="../admin/new_article_evaluation.php?status=revise" onClick="return submitbutton('return2writer');"   onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('returnw','','../admin/images/new_f2.png',1)"><img src="../admin/images/new.png" name="returnw" width="32" height="32" border="0" align="absmiddle">Return to Writer</a>													
					</div>										
				</div>
				
<table width="100%" border="0" class="ctable4">
				<h1 class="asterisk">Content Item: Edit</h1>	

					<tr>
					  <td colspan="4" class="table_header" >Details</td>
			  </tr>
					<tr>
						<td width="100" class="caption3"><strong>Article Title:</strong></td> 
						<td width="273"><input name="title" value="{ARTICLE_TITLE}" size="100" class="inputbox"></td>
						<td width="56">&nbsp;</td>
						<td width="56" rowspan="9">
				<div id="imagepanel2">
				  <p class="orange">&nbsp;&nbsp;<b>Uploaded images:</b></p><br>
					<div id="imageexplorer2">
					  {THUMBNAIL}
					</div> 
				</div>						
						</td>
					</tr>
				
					<tr>
						<td class="caption3"> <strong>Category:</strong></td>      
						<td><select name="category" class="inputbox">
						  
							{CATEGORY_NAMES}
						
					    </select></td>
						<td></td>
					</tr>
				
					<tr>
						<td class="caption3"><strong>Date Created:</strong></td>  
						<td>{DATE_CREATED}</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
					  <td class="caption3" valign="top">Keywords :<br></td>
					  <td valign="top"><textarea name="keywords" cols="100" rows="5" class="inputbox">{KEYWORDS}</textarea><br><b class="red">Note: Keywords must be separated by comma.</b></td>
					  <td>&nbsp;</td>
			  </tr>
					<tr>
					  <td class="caption3">Section : </td>
					  <td><select name="frontpage" class="inputbox">
						{FRONTPAGE}
						</select>
					</td>
					  <td>&nbsp;</td>
			  </tr>
					<tr>
					  <td class="caption3"><strong>Author : </strong></td>
					  <td>{AUTHOR}</td>
					  <td>&nbsp;</td>
			  </tr>
					<tr>
					  <td colspan="3" valign="top" >
<textarea id="elm1" name="elm1" rows="35" cols="80" style="width: 100%" mce_editable="true">
{BODY}
</textarea>					  </td>
			  </tr>
										<tr>
											<td colspan="2"></td>
										</tr>
										</table>
				
										
				
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
