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
	<div id="header"><h1>&nbsp;</h1></div>
		<div id="topnavbar">
			<ul id="topnavlist">				
				<li><a href="#">About the ENBR</a></li>
				<li><a href="archive.php">Archives</a></li>
				<!--<li><a href="#">Site Map</a></li>-->
				<li><a href="ads.php">Advertisements</a></li>
				<li><a href="index.php">Home</a></li>
			</ul>
		</div>	    
		<div class="clear"></div>
		   <div id="column1">
					<ul id="navlist">
						{CATEGORY}
					</ul>

			  <div id="sections"><h1 class="captions">Login Form</h1>
			  <form name="login" method="post" action="client/login.php">
			  <b>Username: </b>
			  <input name="username" type="text">
			  <b>Password: </b>
			  <input name="password" type="password">
			  <input type="submit" name="submit" value="Login" class="button" />
			  </form>
			  </div>
		   
			  <div id="sections"><h1 class="captions">sponsored links</h1>
				  <p class="text">
				  {SPONSORED_LINKS}
			  </div>
			  <div id="sections">
				  <h1 class="captions">advertisements</h1>
				  <p>{ADVERTISEMENTS}</p>		
			  </div>
  </div>
			<div id="content"><!-- begin content -->
				<div id="ads_pane">
					<h1>Below are the list of our Corporate Partners :</h1>
				{ALL_ADVERTISEMENTS}
				</div>
		    </div><!-- end content -->
	  <div class="clear"></div>	  
	<div class="centertext" id="footer">
		{FOOTER}
	</div>
</div>
</body>
</html>
