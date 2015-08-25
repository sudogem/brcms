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
		if ( f.quote.value == "" ){
			alert( "You must provide a quote." );
			return false;
		}
		if ( f.author.value == "" ){
			alert( "You must provide an author of the quote." );
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
			
					<form name="adminForm" method="post" action="save_quote.php">
					<div id="toolbar_panel">
						<div id="toolbar_btn">
							<input type="submit" value="Cancel" name="cancel" class="formbutton" >
							<input type="submit"  onClick="return mh();" value="Save" name="save" class="formbutton" >
							<input type="hidden" value="edit" name="task" >
						</div>	
					</div>	
						<h1 class="asterisk">Quote: Edit </h1>
					    <table width="100%" class="ctable" id="tablebgcolor">
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
										<td width="183" valign="top">
										Quote :
					*					</td>
									  <td width="240">
										<textarea class="inputbox" name="quote" cols="30" rows="10">{QUOTE}</textarea>
										</td>
									</tr>
									<tr>
										<td>
										Author : * </td>
										<td><input type="text" name="author" class="inputbox" size="40" value="{AUTHOR}" />
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

		