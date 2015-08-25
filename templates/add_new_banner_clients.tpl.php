<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="admin/admin_scripts.js" ></script>
		<script language="javascript">
		<!--
		function changeDisplayImage() {
			if (document.adminForm.imageurl.value !='') {
				document.adminForm.imagelib.src='images/ads/' + document.adminForm.imageurl.value;
			} else {
				document.adminForm.imagelib.src='images/blank.png';
			}
		}
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (form.name.value == "") {
				alert( "You must provide a banner name." );
			} else if (getSelectedValue('adminForm','cid') < 1) {
				alert( "Please select a client." );
			} else if (!getSelectedValue('adminForm','imageurl')) {
				alert( "Please select an image." );
			} else if (form.clickurl.value == "") {
				alert( "Please fill in the URL for the banner." );
			} else {
				submitform( pressbutton );
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
<form name="adminForm" method="post" action="save_banner.php" >
					<div id="toolbar_panel">
						<div id="toolbar_btn">
								<input type="submit" value="cancel" name="cancel" class="formbutton" >
								<input type="submit" value="save" name="add" class="formbutton" >
								<input type="hidden" value="add" name="task" >
						</div>
							<div id="toolbar_btn">
								<a href="#" onClick="popupWindow('admin/popups/uploadimage3.php','win1',250,100,'no');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','admin/images/edit_f2.png',1)"><img src="admin/images/edit.png" name="Image1" width="32" height="32" border="0">Upload</a>						
							</div>
					  </div>
					
					<h3 class="msginfo">{MESSAGE}</h3>	
					<h1 class="asterisk">Banner Ads: New </h1>
<table width="100%" class="ctable"  >
		<tr>
			<td width="100%"  valign="top">
				<table width="100%" class="ctable" id="tdata"  cellspacing="0" border="0"  >
                  <tr class="table_header"> 
                    <th colspan="2" align="left"> Details</th>
                  </tr>
                  <tr> 
                    <td width="181"> Banner Name: </td>
                    <td width="558"> <input type="text" name="bannername" class="inputbox" size="40" value="" /> 
                    </td>
                  </tr><tr> 
                    <td> Client Name:: </td>
                    <td><select name="imageurl"  onchange="changeDisplayImage();">{BANNERURL}</select>
				    </td>
                  <tr>
                    <td>Banner URL:</td>
                    <td><select name="imageurl"  onchange="changeDisplayImage();">{BANNERURL}</select></td>
                  </tr>
                  <tr>
                    <td>Click  URL:</td>
                    <td><input type="text" name="clickurl" class="inputbox" size="40" value="" /></td>
                  </tr>
				  
                  <tr> 
                    <td valign="top">Banner Description :</td>
                    <td><textarea name="desc" cols="38" rows="5" class="inputbox"></textarea></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>
<table border="0">
			<tr>
			  <td colspan="4">Kindly set the starting date when the ads will display and the its expiration date. </td>
			  </tr>
			<tr>
				<td width="69"></td>
				<td width="48">Month</td>
				<td width="43">Day</td>
				<td width="300">Year</td>
			</tr>
			<tr>
				<td> Start Date:</td>
				
				<!-- Month -->
				<td>
					<select name="from_month">
					{FROM_MONTH}
					</select>
				</td>
				
				<!-- Day -->
				<td>
					<select name="from_date">		
					{FROM_DAY}
					</select>
				</td>
				
				<!-- Year -->
				<td>
					<select name="from_year">		
					{FROM_YEAR}
					</select>
				</td>
			</tr>
			<tr>
				<td> End Date:</td>
				
				<!-- Month -->
				<td>
					<select name="expiry_month">
						{FROM_MONTH}
					</select>
				</td>
				
				<!-- Day -->
				<td>
					<select name="expiry_date">		
						{FROM_DAY}
					</select>
				</td>
				
				<!-- Year -->	
				<td>
					<select name="expiry_year">		
						{FROM_YEAR}
					</select>
				</td>
			</tr>
		</table>					
					</td>
                  </tr>
                  <tr>
                    <td>Banner Size : </td>
                    <td><select name="imageurl"  onchange="changeDisplayImage();">{BANNERURL}</select></td>
                  </tr>
                  <tr>
                    <td>Total Amount : </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Amount paid  : </td>
                    <td><input type="text" name="bannername" class="inputbox" size="40" value="" /></td>
                  </tr>
                  <tr>
                    <td>Credit Balance : </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Show Banner: </td>
                    <td><select name="showbanner">
					<option value="1">Yes</option>
					<option value="0">No</option>
					</select></td>
                  </tr>
                  <tr> 
                    <td valign="top">Banner Image:  </td>
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

		