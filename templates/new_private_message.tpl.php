<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
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
						<form name="userform" action="../admin/sendmessage.php" method="post" >
						<div id="toolbar_panel">
								<div id="toolbar_btn">
						    <input type="submit" value="Cancel" name="cancel" class="formbutton" >
							<input type="submit" value="Send" name="send" class="formbutton" >							
								</div>
						</div>		
							<h1 class="inbox">New Private Message </h1>	
							<div class="clear">&nbsp;</div>
							<table width="100%" border="0" class="ctable2" >
							<tr>
							<td width="12%" class="caption2">To : </td>
							<td class="data">
							<select name="to" class="inputbox" >
								{TO}
							</select>
							</td> 
							</tr>
							<tr>
							<td class="caption2">Subject  : </td>
							<td class="data"><input type="text" name="subject" size="100" maxlength="100" class="inputbox" value="{MESSAGESUBJECT}" >
							</td>
							</tr>
							
							<tr>
							<td align="left" valign="top" class="caption2">Message  : </td>
							<td width="88%"><textarea name="message" class="inputbox" style="width:100%" rows="30" >{MESSAGEBODY}</textarea>
							
							  <!-- <textarea name="articlebody">{ARTICLE_BODY}</textarea> -->	</td>
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
