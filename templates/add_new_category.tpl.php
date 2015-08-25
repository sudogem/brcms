<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />
<script type="text/javascript" language="javascript">
	function mh(){
		var f = document.adminForm;
		if ( f.category_name.value == "" ){
			alert( "You must provide a category name." );
			return false;
		}
		return true;
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
				<div id="outerpanel">
					<div id="panel" >
			
					<form name="adminForm" method="post" action="save_category.php">
					<div id="toolbar_panel">
						<div id="toolbar_btn">
							<input type="submit" value="Cancel" name="cancel" class="formbutton" >
							<input type="hidden" value="add" name="task" >
							<input type="submit" onClick="return mh();" value="Save" name="save" class="formbutton" >
						</div>	
					</div>	
						<h1 class="asterisk">{HEADING}</h1>
					    <table width="100%" class="ctable" >
							<tr>
								<td valign="top">
									<table width="100%" class="ctable" id="tdata"  cellspacing="0" border="0"  >
									<tr class="table_header">
										<th colspan="2" align="left">
										 Details
										</th>
									</tr>
									<tr>
										<td colspan="100%">
									<span class="hsmall">Items marked with a * are required unless stated otherwise.</span>
										</td>
									</tr>
									<tr>
										<td width="174">
										Category Name:
					*					</td>
										<td width="1350">
										<input type="text" name="category_name" class="inputbox" size="40" value="{CATEGORY_NAME}" />
										</td>
									</tr>
									<tr>
										<td>
										Category Description: </td>
										<td>
										<textarea class="inputbox" name="category_desc" cols="42" rows="">{CATEGORY_DESC}</textarea>
										</td>
									
									<tr>
										<td colspan="2">&nbsp;
					
										</td>
									</tr>
									</table>
								</td>
								</tr>
									</table>
				
			</td>
		</tr>
		
					</form>
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

		