<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
<link rel="stylesheet" href="../templates/admin2.css" />
<script type="text/javascript" language="javascript">
	function hideSpans(showSpan) {
		document.getElementById("selectmonth").style.display="none";
		document.getElementById("selectyear").style.display="none";
		document.getElementById("selectmonth2").style.display="none";
		document.getElementById("selectyear2").style.display="none";
		if(showSpan==3) {
			document.getElementById("selectmonth").style.display="block";
			document.getElementById("selectyear").style.display="block";
			document.getElementById("selectmonth2").style.display="block";
			document.getElementById("selectyear2").style.display="block";
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
						<!--<div id="toolbar_panel">
							<div id="toolbar_btn">
								<a href="../editor/edit_article.php" onClick="document.adminForm.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="Image1" width="32" height="32" border="0">Edit</a>						
							</div>
							<div id="toolbar_btn">
								<a href="../editor/add_article.php"  onClick="document.adminForm.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/new_f2.png',1)"><img src="../admin/images/new.png" name="Image2" width="32" height="32" border="0">New</a>													
							</div>
						</div> -->
				<h3 class="msginfo">{MESSAGE}</h3>
					<div id="panel">
					<form name="adminForm" method="post" action="../admin/report_admin.php" >
						
					<h1 class="asterisk">Admin Reports</h1>
                    <table width="100%" border="0"  >
					  <tr>
						<td width="146">Select Report: </td>
					    <td><span id="selectmonth" style="display:none; " >Select Month:</span></td>
					    <td><span id="selectyear" style="display:none; ">Select Year:</span></td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					  </tr>
					  <tr>
						<td height="30"><select name="reportype" class="inputbox" onChange="hideSpans(options[selectedIndex].value);" >
							{REPORTYPE}
                        </select></td>
						<td><select name="month" class="inputbox"  id="selectmonth2" style="width:100px; display:none;" >
                          <option value="1">January</option>
                          <option value="2">February</option>
                          <option value="3">March</option>
                          <option value="4">April</option>
                          <option value="5">May</option>
                          <option value="6">June</option>
                          <option value="7">July</option>
                          <option value="8">August</option>
                          <option value="9">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12">December</option>
                        </select>				</td>
						<td><select name="year" class="inputbox" id="selectyear2" style="display:none; " >
					      
							{LISTOFYEAR}
				        
				        </select></td>
						<td width="116">&nbsp;</td>
						<td width="87">&nbsp;</td>
						<td width="375">&nbsp;</td>
						<td width="163">&nbsp;</td>
					  </tr>
					  <tr>
					    <td><input type="submit" name="submit" value="View Report" class="button"></td>
					    <td width="86" ></td>
					    <td width="98" ></td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td >&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td colspan="7" class="ctable3">&nbsp;{DATA}</td>
					  </tr>
</table>					 
								
					  </form>
					</div>
		</div>
		<div class="clear">&nbsp;</div>
		<div id="footer">{FOOTER}</div>
		</div>	<!-- CONTINER -->
	</div><!-- WRAPPER -->
</body>
</html>
