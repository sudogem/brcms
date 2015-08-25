<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>El Nuevo Bantay Radyo Online</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="brainwired@gmail.com" />
<meta name="keywords" content="design, css, cascading, style, sheets, xhtml, graphic design, w3c, web standards, visual, display" />
<meta name="description" content="A demonstration of what can be accomplished visually through CSS-based design." />
<meta name="robots" content="all" />
<script type="text/javascript" language="javascript" src="../../templates/setfooter.js" ></script>
<link rel="stylesheet" media="screen" href="{STYLESHEET}" />
</head>

<body>
<div id="wrapper">
	<div id="header">
</h1></div>
		<div id="topnavbar">
			<ul id="topnavlist">
				<li><a href="index.php">Home</a></li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Contact Us</a></li>
				<li><a href="#">Archives</a></li>
				<li><a href="#">Feedback</a></li>
				<li><a href="ads.php">Advertisements</a></li>
				<li><a href="#">Help</a></li>
			</ul>
		</div>
		<div class="clear"></div>
		   <div id="content"><!-- begin content -->
		   <div id="searchresults_panel">
				<form name="search_results" method="post" action="search_results.php">
&nbsp;&nbsp;&nbsp;Search : <input type="text" name="searchstr" value="{SEARCH_STR}"><input type="submit" name="go" value="Go"></form>
				<p><b>Search results for "{KEYWORDS}" returned {NUMRESULTS} matches</b></p>
				<ul id="searchres">
				{RESULTS}					
				</ul>
				<div id="paging">{PAGELINK}</div>
			</div>	
  			</div><!-- end content -->
	  <div class="clear"></div>	  
	<div class="centertext" id="footer">
		{FOOTER}
	</div>
</div>
</body>
</html>
