<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="brainwired@gmail.com" />
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
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
				<div id="panel" >
				<form name="users" method="post" action="edit_user_profile.php">
					<div id="toolbar_panel">
						<div id="toolbar_btn">
							<input type="submit" value="edit" name="edit" class="formbutton" >
							<!-- <a href="index.php?option=user_manager&task=save" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/save_f2.png',1)"><img src="../admin/images/save.png" name="Image1" width="32" height="32" border="0">Save</a> -->
						</div>
						<!-- <div id="toolbar_btn">
							<a href="index.php?option=user_manager&task=close" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image2" width="32" height="32" border="0">Edit</a> 
						</div>-->
				    </div>
					<h1 class="asterisk">Category Details </h1>
				
					<table width="100%" cellpadding="4"  cellspacing="1"  class="ctable" id="tdata">
					<tr class="table_header" align="left">
						<th colspan="5">
						Category Details
						</th>
					</tr>
					<tr>
						<td width="220">
						Category Name:
						</td>
						<td width="1039">
						<!-- <input type="text" name="name" class="inputbox" size="40" value="" /> -->
						<input type="text" name="name" class="inputbox" size="40" value="{CATEGORY_NAME}" />	
									  </td>
					</tr>
					<tr>
						<td valign="top">
						Category Description:
						</td>
						<td>
<textarea class="inputbox" name="interests" cols="42" rows="">{CATEGORY_DESC}</textarea>						<!-- <input type="text" name="username" class="inputbox" size="40" value="" />-->
						</td>
					
					<tr>
						<td colspan="2">&nbsp;
					
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

