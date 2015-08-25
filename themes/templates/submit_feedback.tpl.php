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
<script type="text/javascript" language="javascript">
	function validate(){
		var f = document.feedback_form;
		if ( f.username.value == "" ){
			alert( "You must provide a name." );
			return false;
		}
		if ( f.emailAddress.value == "" ){
			alert( "You must provide your email." );
			return false;
		}
		if ( f.feedback.value == "" ){
			alert( "You must provide a feedback or comments." );
			return false;
		}
		
		return true;
	}
</script>

<link rel="stylesheet" media="screen" href="{STYLESHEET}" />
</head>

<body>
<div id="wrapper">
	<div id="header"><h1>&nbsp;</h1></div>
		<div id="topnavbar">
			<ul id="topnavlist">				
				<li><a href="aboutus.php"> About the ENBR</a></li>
				<li><a href="sitemap.php"> Site Map</a></li>				
				<li><a href="archive.php"> Archives</a></li>
				<li><a href="external_source_int.php"> Community Patrol</a></li>
				<li><a href="feedback.php"> Feedback</a></li>
				<li><a href="advertise.php"> Advertise</a></li>
				<li><a href="index.php"> Home</a></li>
			</ul>
		</div>	    
		<div class="clear"></div>
		   <div id="column1">
					<ul id="navlist">
						{CATEGORY}
					</ul>
					<div class="clear">&nbsp;</div>
					<div id="loginsection"><h1 class="captions">Client-Login Form</h1>
					<form name="login" method="post" action="client/login.php" id="loginsection">
					<b>Username: </b>
					<input name="username" type="text" class="inputbox">
					<b>Password: </b>
					<input name="password" type="password" class="inputbox">
					<input type="submit" name="submit" value="Login" class="button2" />
					</form>
					</div>
			<div class="clear">&nbsp;</div>		   	
			  <div id="sections"><h1 class="captions">sponsored links</h1>
					<ul id="sponsoredlinks">
				  {SPONSORED_LINKS}
					</ul>
			  </div>
  </div>
			<div id="contentx"><!-- begin content -->
				<div id="feedback">
					<h1>Feedback </h1>
					<p>Thank you very much for your comments / feedbacks. <br>This will surely help improve our public service.</p>
					<div align="left">&nbsp;&nbsp;&nbsp;&nbsp;<a href="feedback.php">&lt;&lt;&lt;Back</a></div>
				</div>
		    </div>
			<div class="clear">&nbsp;</div>	  
	<div class="centertext" id="footer">
		{FOOTER}
	<h1>Page was generated in {PAGE_GENERATED} seconds. </h1>
	</div>
</div>
</body>
</html>
