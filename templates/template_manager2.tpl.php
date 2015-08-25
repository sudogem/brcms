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
				<h1 class="asterisk">Template Manager</h1>						
					<div id="templateSection">
						<h2>{CURRENT_TEMPLATE}</h2>
						{DETAILS_CURRENT_TEMPLATE}
						<div id="currentTemplate">
							<div id="templateThumbnail">
								<div id="thumbnailbody">
									<h1>{TEMPLATE_NAME}</h1>
									<h2>{CREATED_BY}:{TEMPLATE_AUTHOR}</h2>
										<div class="thumbnail">
											<a href = "javascript:openPopup('../{LINK_THUMBNAIL}','1024x768','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=1000,height=600')"><img src="../{SRC_THUMBNAIL}" alt="" width="180" border="0"></a>
										</div>
								</div>
							</div>
						</div>
						<div class="clear">&nbsp;</div> 				
					</div>
					<div id="templateSection">
						<h2>{BROWSE_TEMPLATE}</h2>
						<p>{LIST_OF_TEMPLATES}</p>
						<div id="browseTemplate">
							<div class="quickJumpNav">
								<a href="../admin/template_manager2.php?view_start={VIEW_START_DESC}"><img src="../admin/images/previous_icon.gif" width="16" height="16" border="0"></a>
								<select name="menu1" onChange="MM_jumpMenu('parent',this,0)">
								{OPTION_VALUES} 
								</select>				
								<a href="../admin/template_manager2.php?view_start={VIEW_START_ASC}"><img src="../admin/images/next_icon.gif" width="16" height="16" border="0"></a>
							</div>
							<br>
							{ALL_TEMPLATES}	
										<div class="clear">&nbsp;</div> 			
				
						</div>
					</div>
				</div>			</div>
		</div>
	<div class="clear">&nbsp;</div>
	<div id="footer">
		{FOOTER}
	</div>	
		
	</div>
</body>
</html>

