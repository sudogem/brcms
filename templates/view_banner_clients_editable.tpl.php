<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
		<script language="javascript">
		<!--
		function changeDisplayImage() {
			if (document.adminForm.imageurl.value !='') {
				//document.adminForm.imagelib.src='images/ads/' + document.adminForm.imageurl.value;
				document.adminForm.imagelib.src='../images/ads/' + document.adminForm.imageurl.value;
			} else {
				document.adminForm.imagelib.src='images/blank.png';
			}
		}
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			var x;
			/*if (pressbutton == "cancel") { 
				//document.adminForm.task.value = pressbutton;
				submitform( pressbutton );
				return;
			}
			if (pressbutton == "add") { 
				//document.adminForm.task.value = pressbutton;
				submitform( pressbutton );
				return;
			}*/
			x = validate();
			if (x) {
				submitform( pressbutton );
				return;
			}
		}	
			// do field validation
			function validate() {
				var form = document.adminForm;
				// do field validation
				if (form.bannername.value == "") {
					alert( "You must provide a banner name." );
					return false;
				} 
				if (!getSelectedValue('adminForm','imageurl')){
					//alert( "Please select an image." );return false;
				}
				if (form.clickurl.value == "") {
					alert( "Please fill in the URL for the banner." );
					return false;				
				}
				return true;
			}
		//-->
		</script>

<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />
</head>

<body onLoad="changeDisplayImage();">
	<div id="wrapper">
		<div id="container">
			<div id="header">
				{HEADER}
			</div>
			<div id="topnav">
				{TOPNAV}
			</div>
			<div id="content">
					<div id="panel" >
			<form name="adminForm" method="post" action="save_banner.php" >
			<input type="hidden" name="task" />
			<!-- <input type="hidden" value="save" name="task" >
			<input type="hidden" value="add" name="task" >-->
					<div id="toolbar_panel">
							<div id="toolbar_btn">
									<a href="#" onClick="popupWindow('../admin/popups/uploadimage3.php','win1',250,100,'no');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/upload_f2.png',1)"><img src="../admin/images/upload.png" name="Image1" width="32" height="32" align="absmiddle"border="0">Upload</a>						
									
							</div>
							<div id="toolbar_btn">
								<a href="#" onClick="submitbutton('add');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/save_f2.png',1)"><img src="../admin/images/save.png" name="Image2" width="32" height="32" align="absmiddle" border="0">Save</a>													
							</div>							
							<div id="toolbar_btn">
								<a href="#" onClick="submitbutton('refresh');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/restore_f2.png',1)"><img src="../admin/images/restore.png" name="Image3" width="32" height="32" align="absmiddle"border="0">Refresh</a>
							</div>
							<div id="toolbar_btn">
								<a href="#" onClick="submitbutton('cancel');"onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('cancel','','../admin/images/cancel_f2.png',1)"><img src="../admin/images/cancel.png" name="cancel" width="32" height="32" align="absmiddle"border="0">Cancel</a>
							</div>			  
					</div>
					
					<h3 class="msginfo">{MESSAGE}</h3>	
					<h1 class="asterisk">Banner Client: {TASK}</h1>
                    <table width="100%" class="ctable"  >
		<tr>
			<td width="100%"  valign="top">
				<table width="100%" class="ctable" id="tdata"  cellspacing="0" border="0"  >
                  <tr class="table_header"> 
                    <th colspan="2" align="left" class="tdcaptions"> Details</th>
                  </tr>
                  <tr> 
                    <td width="150"> Banner Name:: </td>
                    <td width="653"> <input type="text" name="bannername" class="inputbox" size="40" value="{BANNERNAME}" />
                    </td>
                  </tr><tr>
                    <td>Banner Filename::</td>
                    <td>
					<select name="imageurl" class="inputbox"  size="5" onchange="changeDisplayImage();">
							{BANNERURL}
                    </select><input type="submit" name="remove"  class="formbutton" value="Remove image" >
					</td>
                  </tr>
                  <tr>
                    <td>Click  URL::</td>
                    <td><input type="text" name="clickurl" class="inputbox" size="40" value="{CLICKURL}" /></td>
                  </tr>
				  
                  <tr> 
                    <td valign="top">Banner Description ::</td>
                    <td><textarea name="desc" cols="42" rows="5" class="inputbox">{BANNERDESC}</textarea></td>
                  </tr>
                  <tr>
                    <td valign="top">Banner Size : </td>
                    <td valign="top">{BANNERSIZE}</td>
                  </tr>
                  <tr>
                    <td valign="top">Impressions Purchased : </td>
                    <td valign="top">{IMPTOTAL}</td>
                  </tr>
                  <tr>
                    <td valign="top">Impressions Made : </td>
                    <td valign="top">{IMPMADE}</td>
                  </tr>
                  <tr>
                    <td valign="top">Impressions Left : </td>
                    <td valign="top">{IMPLEFT}</td>
                  </tr>
                  <tr>
                    <td valign="top">Clicks : </td>
                    <td valign="top">{CLICKS}</td>
                  </tr>
                  <tr>
                    <td valign="top">Banner status : </td>
                    <td valign="top">{STATUS}</td>
                  </tr>
                  <tr> 
                    <td valign="top">Banner Image::  </td>
                    <td valign="top">
							{BANNERIMAGE}
					</td>
                  </tr>
                  <tr> 
                    <td colspan="2">&nbsp;</td>
                  </tr>
                </table>
			</td>
			</tr>
			  </table>
					</form>
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

		