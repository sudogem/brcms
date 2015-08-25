<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="brainwired@gmail.com" />
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../Editor/editor.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />
<script type="text/javascript" language="javascript">
	function hideSpans(showSpan) {
		document.getElementById("userspan").style.display="none";
		document.getElementById("button").style.display="none";
		//document.getElementById("allspan").style.display="none";
		if(showSpan==1) {
			document.getElementById("userspan").style.display="block";
		}
		if(showSpan==2) {
			document.getElementById("button").style.display="block";
		}
		if(showSpan==3) {
			//document.getElementById("allspan").style.display="block";
		}
	}
</script>
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
					<form name="users" method="post" >
						<div id="toolbar_panel">&nbsp;
							<!--<div id="toolbar_btn">
								<a href="#" onClick="popupWindow('../admin/popups/uploadimage2.php','win1',250,100,'no','yes');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/upload_f2.png',1)"><img src="../admin/images/upload.png" name="Image1" width="32" height="32" border="0">Upload</a>						
							</div>-->
						</div>
					<h1 class="asterisk">Image Manager </h1>
					
          <div id="image_explorer"> 
		  <form name="adminForm" method ="post" action="image_manager.php">
		  <table width="89%" border="0">
			  <tr>
				<td width="132" align="right">View By :			    </td>
				<td width="170"></td>
				<td width="1066">
				</td>
			  </tr>
			  <tr>
			    <td align="right"><input name="view" type="radio" value="uploads" onClick="hideSpans(2);" checked></td>
			    <td>All Uploaded images </td>
			    <td><span id="button" >
			      <input name="submit" class="formbutton" type="submit" value="Go" >
			    </span></td>
		    </tr>
			  <tr>
			    <td align="right"><input name="view" type="radio" value="cpartners" onClick="hideSpans(1);" ></td>
			    <td>Corporate partners</td>
		        <td><span id="userspan" style="display: none;">Select partners : 
				    <select name="cp" >
						{CP}
   				    </select>
					<input name="submit" type="submit" class="formbutton" value="Go">
					</span></td>
		    </tr>
			</table>
		</form>
					<div id="image_content_area">
							{DIR_IMAGES}
						</div>
					</div>
					</form>
					</div>
			</div>
		</div>
	<div class="clear">&nbsp;</div>
	<div id="footer">
		{FOOTER}
	</div>	
		
	</body>
</html>

