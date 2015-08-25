<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />
<!-- TinyMCE -->
<script language="javascript" type="text/javascript" src="../Editor/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,contextmenu,paste,directionality,fullscreen",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		//theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "iespell,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		content_css : "example_word.css",
	    plugi2n_insertdate_dateFormat : "%m-%d-%Y",
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
	
	function submitbutton(pressbutton){
		var f = document.adminForm;
		if (f.title.value == "" ) {
			alert( "You need to enter a title of the article." );
			return false;
		}
		else{
			switch(pressbutton){
				case 'publish':
					var ans = confirm("Are you sure you want to publish the content?");
					if (ans == true) {
						submitform(pressbutton);
						return true;
					}
					break;
			
				case 'saveasdraft':
					var ans = confirm("Are you sure you want to save the content?");
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
			}
		}
	}
</script>
<!-- /TinyMCE -->
<script language="javascript" type="text/javascript" src="../jscripts/tiny_mce/plugins/emotions/editor_plugin.js"></script>
<body >
<div id="wrapper">
		<div id="container">
			<div id="header">
				{HEADER}
			</div>
			<div id="topnav">
				{TOPNAV}
			</div>
			<div id="contentx">
			<div id="outerpanelx">
				<h3 class="msginfo">{MESSAGE}</h3>
				<div id="panel2">
			<form name="adminForm" id="adminForm"  method="post" action="../admin/save_ader_site_content.php"  >
				<input type="hidden" name="stageID" value="1" >
				<input type="hidden" name="task" value="add" >
				<div class="clear">&nbsp;</div>
				<div id="toolbar_panel">
					<div id="toolbar_btn">
						<a href="../admin/other_site_content.php"  onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/cancel_f2.png',1)"><img src="../admin/images/cancel.png" name="Image2" width="32" height="32" align="absmiddle" border="0">Cancel</a>						
					</div>				
				
					<div id="toolbar_btn">
						<a href="#"  onClick="submitbutton('saveasdraft');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','../admin/images/save_f2.png',1)"><img src="../admin/images/save.png" name="Image4" width="32" height="32" align="absmiddle" border="0">Save</a>						
					</div>
			  </div>
				<table width="100%" border="0" class="ctable4">
                  <h1 class="asterisk">Content Item: New</h1>
                  <tr>
                    <td colspan="4" class="table_header" >Details</td>
                  </tr>
                  <tr>
                    <td width="100" class="caption3"><strong>Title:</strong></td>
                    <td width="273"><input name="title" value="" size="80" class="inputbox"></td>
                    <td width="56">&nbsp;</td>
                    <td width="56" rowspan="8">&nbsp; </td>
                  </tr>
                  <tr>
                    <td class="caption3"><strong>Date Created:</strong></td>
                    <td>{DATE_CREATED}</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="caption3"><strong>Author : </strong></td>
                    <td>{AUTHOR}</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="caption3">Published :</td>
                    <td><input type="checkbox" name="ispublished" value="1">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" valign="top" >
                      <textarea id="elm1" name="elm1" rows="35" cols="80" style="width: 100%; font:normal 12px Verdana, Arial, Helvetica, sans-serif;" >
						  </textarea>
                    </td>
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
