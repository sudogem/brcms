<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript">
	function submitbutton(pressbutton){
		switch(pressbutton){
			case 'reject':
				var ans = confirm("Are you sure you want to reject this article ?");
				if (ans == true) {
					return true;
				}else return false;
				break;
			case 'revise':
				var ans = confirm("Are you sure you want to return this article to the Editor ?");
				if (ans == true) {
					return true;
				}else return false;
				break;
			case 'approve':
				var ans = confirm("Are you sure you want to approve this article ? ");
				if (ans == true) {
					return true;
				}else return false;
				break;
				
		}
	}
</script>

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
				<div id="outerpanel">
					<div id="panel">
						<div id="toolbar_panel">
							<div id="toolbar_btn">
								<a href="new_article_evaluation.php?status=reject" onClick="return submitbutton('reject');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('reject','','../admin/images/cancel_f2.png',1)"><img src="../admin/images/cancel.png" name="reject" width="32" height="32" align="absmiddle" border="0">Reject</a>						
							</div>
							<div id="toolbar_btn">
								<a href="new_article_evaluation.php?status=revise"  onClick="return submitbutton('revise');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('revise','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="revise" width="32" height="32" align="absmiddle" border="0">Revise</a>													
							</div>
							<div id="toolbar_btn">
								<a href="new_article_evaluation.php?status=approve"  onClick="return submitbutton('approve');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/apply_f2.png',1)"><img src="../admin/images/apply.png" name="Image2" width="32" height="32" align="absmiddle" border="0">Approve</a>													
							</div>							
							<div id="toolbar_btn">
								<a href="javascript:void window.open('{LINK}', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/preview_f2.png',1)"><img src="../admin/images/preview.png" name="Image3" width="32" height="32" align="absmiddle" border="0">Preview</a>
							</div>							
						</div>
						
							<!-- <input type="submit" value="Approve" name="status" class="formbutton" >
							<input type="submit" value="Reject" name="status" class="formbutton" > -->
							<h1 class="asterisk">Content Item: Details</h1>	
							<table width="100%" border="0" class="ctable2">
							<tr>
							<td width="12%" class="caption2">Article Title : </td>
							<td class="data">
							{ARTICLE_TITLE}
							<!-- <input type="text" name="title" value="{ARTICLE_TITLE}"> -->
							</td> 
							
							</tr>
							<tr>
							<td class="caption2">Category : </td>
							<td class="data">{CATEGORY}
							</td>
							</tr>
							<tr>
							<td class="caption2">Date Created  : </td>
							<td class="data">{DATE_CREATED}
							</td>
							</tr>
							
							<tr>
							<td class="caption2">Author : </td>
							<td class="data">{AUTHOR}
							</td>
							</tr>
							
							<tr>
							<td align="left" valign="top" class="caption2">Article Body : </td>
							<td width="86%"><p>{ARTICLE_BODY}</p>
							
							</tr>
							</table>
							<div id="imagepanel3">
								  <p class="orange">&nbsp;&nbsp;<b>Uploaded images:</b></p>
								<div id="imageexplorer3">
								  {THUMBNAIL}
								 </div> 
							</div>							
						
					</div>
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
