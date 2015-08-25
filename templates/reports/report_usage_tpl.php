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
		if(showSpan==1 || showSpan==3) {
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
				<h3 class="msginfo">{MESSAGE}</h3>
					<h1 class="asterisk">Usage Report</h1>
					<div id="panel">
					{DATE_PEAKER}
						{DATA}
					</div>
		</div>
		<div class="clear">&nbsp;</div>
		<div id="footer">{FOOTER}</div>
		</div>	<!-- CONTINER -->
	</div><!-- WRAPPER -->
</body>
</html>
