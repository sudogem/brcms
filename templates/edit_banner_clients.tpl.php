<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="brainwired@gmail.com" />
<script type="text/javascript" language="javascript" src="templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="admin/admin_scripts.js" ></script>

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

				<form name="users" method="post" action="save_client_profile.php">
					<!--<div id="toolbar_panel">
						<div id="toolbar_btn">
								<input type="submit" value="cancel" name="cancel" class="formbutton" >
								<input type="submit" value="save" name="save" class="formbutton" >
								<input type="hidden" value="edit" name="task" >
						</div>
					</div>-->					
						<div id="toolbar_panel">
							<div id="toolbar_btn">
								<a href="#" onClick="popupWindow('admin/popups/uploadimage3.php','win1',250,100,'no');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','admin/images/edit_f2.png',1)"><img src="admin/images/edit.png" name="Image1" width="32" height="32" border="0">Upload</a>						
							</div>
						</div>
					
					<h3 class="msginfo">{MESSAGE}</h3>	
					<h1 class="asterisk">Banner Ads: New </h1>
<table width="100%" class="ctable"  >
		<tr>
			<td width="100%"  valign="top">
				<table width="622" class="ctable" id="tdata"  cellspacing="0" border="0"  >
                  <tr class="table_header"> 
                    <th colspan="2"> Banner Ads Details</th>
                  </tr>
                  <tr> 
                    <td width="353"> Banner Name: </td>
                    <td width="257"> <input type="text" name="clientname" class="inputbox" size="40" value="{BANNERNAME}" /> 
                    </td>
                  </tr><tr> 
                    <td> Owner : </td>
                    <td>{OWNER}
					 </td>
                  <tr>
                    <td>Banner URL:</td>
                    <td><select name="clickurl"></select></td>
                  </tr>
                  <tr> 
                    <td>Banner Description :</td>
                    <td> <input type="text" name="address" class="inputbox" size="40" value="{ADDRESS}" /> 
                    </td>
                  </tr>
                  <tr> 
                    <td> Clicks : 
                    <input class="inputbox" type="submit" name="resetclicks" value="Reset clicks"  /></td>
                    <td>{CLICKS}  
                    </td>
                  </tr>
                  <tr>
                    <td>Show Banner: </td>
                    <td>{STATUS} </td>
                  </tr>
                  <tr> 
                    <td>Banner Image:  </td>
                    <td>&nbsp; </td>
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

		