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
				<form name="users" method="post" action="save_user_sperms.php">
					<div id="toolbar_panel">
						<div id="toolbar_btn">
								<input type="submit" onClick="return mh();"  value="Save" name="save" class="formbutton" >
								<input type="submit" value="Cancel" name="cancel" class="formbutton" >								
						</div>
				    </div>
				
				<input type="hidden" name="userID" value="{USERID}" />
				<input type="hidden" name="writing" value="-1" >
				<input type="hidden" name="editing" value="-1" >
				<input type="hidden" name="evaluating" value="-1" >
				<input type="hidden" name="publishing" value="-1" >
					<h1 class="asterisk">User Access Permissions : Edit </h1>
				
					<table width="100%" cellpadding="4"  cellspacing="2" class="ctable" id="tdata">
					<tr class="table_header" align="left" >
						<th colspan="5" class="tdcaptions">
						Details
						</th>
					</tr>
					<tr>
						<td width="168" >
						Name:
						</td>
						<td width="1349" >
						<!-- <input type="text" name="name" class="inputbox" size="40" value="" /> -->
						<label>{FULLNAME}</label>					  </td>
					</tr>
					
					<tr>
					  <td valign="top">Position : </td>
					  <td>{LIST_USERTYPEID} </td>
					  </tr>
					<tr>
					  <td valign="top">&nbsp;</td>
					  <td>&nbsp;</td>
					  </tr>
					<tr>
					  <td valign="top">Stage Access: </td>
					  <td>Description</td>
					  </tr>
					<tr>
					  <td valign="top"><input type="checkbox" name="writing" value="1" {wischecked} >
				      Writing </td>
					  <td>The user allows to write an article.</td>
					  </tr>
					<tr>
					  <td valign="top"><input type="checkbox" name="editing" value="1" {EDISCHECKED} > 
					    Editing
</td>
					  <td>The user allows to proofread the written article. </td>
					  </tr>
					<tr>
					  <td valign="top"><input type="checkbox" name="evaluating" value="1" {EVISCHECKED} > 
				      Evaluating</td>
					  <td>The user allows to evaluate the article which has already been proofread.</td>
					  </tr>
					<tr>
						<td valign="top"><input type="checkbox" name="publishing" value="1" {PISCHECKED}> 
						  Publishing
</td>
						<td>The user allows to publish the article on live site. </td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;
					
						</td>
					</tr>
					</table>
				</form>
				</div>	
</div>
	<div class="clear">&nbsp;</div>
	<div id="footer">{FOOTER}</div>	

</div>
	</div>
		
</body>
</html>

