<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="brainwired@gmail.com" />
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
		<script language="javascript">
		<!--
		function changeDisplayImage() {
			if (document.adminForm.imageurl.value !='') {
				document.adminForm.imagelib.src='../images/ads/' + document.adminForm.imageurl.value;
			} else {
				document.adminForm.imagelib.src='../images/blank.png';
			}
		}
		function validate() {
			var form = document.adminForm;
			// do field validation
			if (form.bannername.value == "") {
				alert( "You must provide a banner name." );
				return false;
			} 
			if (!getSelectedValue('adminForm','imageurl')){
				alert( "Please select an image." );return false;
			}
			if (form.clickurl.value == "") {
				alert( "Please fill in the URL for the banner." );
				return false;				
			}
			document.adminForm.submit();
			
			return true;
		}
		function getSelectedValue( frmName, srcListName ) {
			var form = eval( 'document.' + frmName );
			var srcList = eval( 'form.' + srcListName );
		
			i = srcList.selectedIndex;
			if (i != null && i > -1) {
				return srcList.options[i].value;
			} else {
				return null;
			}
		}		
		//-->
		</script>

<link rel="stylesheet" type="text/css" href="{STYLESHEET}" />
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
					<div id="panel" >
				<form name="adminForm" method="post"  action="save_banner.php" >
					<div id="toolbar_panel">
							<div id="toolbar_btn">
								<a href="#" onClick="return validate();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/save_f2.png',1)"><img src="../admin/images/save.png" name="Image2" width="32" height="32" align="absmiddle" border="0">Save</a>													
							</div>							
							<div id="toolbar_btn">
								<a href="add_banner.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('refresh','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="refresh" width="32" height="32" align="absmiddle"border="0">Refresh</a>
							</div>
							<div id="toolbar_btn">
								<a href="my_banners.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/cancel_f2.png',1)"><img src="../admin/images/cancel.png" name="Image3" width="32" height="32" align="absmiddle"border="0">Cancel</a>
							</div>
					  </div>
					
					<h3 class="msginfo">{MESSAGE}</h3>	
					<h1 class="asterisk">Banner Ads: New</h1>
<table width="100%" class="ctable"  >
		<tr>
			<td width="100%"  valign="top">
				<table width="100%" class="ctable" id="tdata"  cellspacing="0" border="0"  >
                  <tr class="table_header"> 
                    <th colspan="2" align="left" class="tdcaptions"> Details</th>
                  </tr>
                  <tr>
                    <td colspan="2"><span class="hsmall">Items marked with a * are required unless stated otherwise.</span>
</td>
                  </tr>
                  <tr> 
                    <td width="128"> Banner Name: * </td>
                    <td width="651"> <input type="text" name="bannername" class="inputbox" size="40" value="" /> 
                    </td>
                  </tr><tr>
                    <td>Banner URL : *</td>
                    <td><select name="imageurl" class="inputbox"  onchange="changeDisplayImage();">{BANNERURL}</select>
					</td>
                  </tr>
                  <tr>
                    <td>Banner Size :* </td>
                    <td><select name="bannersize"  class="inputbox" onchange="changeDisplayImage();">{BANNERTYPE}</select></td>
                  </tr>
                  <tr>
                    <td>Click  URL:*</td>
                    <td><input type="text" name="clickurl" class="inputbox" size="40" value="" /></td>
                  </tr>
				  
                  <tr> 
                    <td>Banner Description :</td>
                    <td><textarea name="desc" cols="38" rows="5" class="inputbox"></textarea></td>
                  </tr>
                  <tr> 
                    <td valign="top">Banner Image: </td>
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

		