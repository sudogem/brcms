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
			  <div class="clear"></div>
			  <h1 class="captions">advertisements</h1>
			  <div id="banner_area" class="left_vert_rectangle_ads1">
				  {ADS_148x300}		
			  </div>
			  
  </div>
			<div id="contentx"><!-- begin content -->
				<div id="feedback">
					<h1 class="pageheading">Feedback </h1>
					<p>Send your feedbacks or comments here. Thanks.</p>
<form method="post" action="submit_feedback.php" name="feedback_form" onSubmit="confirmSubmit();" >
<table style="float:left;">
		<tr>
			<td>Name: </td>
			<td><input name="username" type="text" class="inputbox" size="53" ></td>
		</tr>
		
		<tr>
			<td>Email Address: </td>
			<td><input name="emailAddress" type="text" class="inputbox" size="53"></td>
		</tr>
		
		<tr>
			<td valign="top">Feedbacks / Comments: </td>
			<td><textarea name="feedback" cols="40" rows="10" class="inputbox"></textarea></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>		    <input type="submit" onClick="return validate();" value="Submit Feedback/Comments" name="submit" class="button2">
		    <input type="reset" value="Clear fields" name="reset" class="button2"></td>
		</tr>
			
	</table>				
</form>	
			 
			 
			  <div id="banner_area" class="right_bigrectangle_ads1">
				  </div>

	
				</div>
		    </div><!-- end content -->
			
	  <div class="clear">&nbsp;</div>	  
	<div class="centertext" id="footer">
		{FOOTER}
	<h1>Page was generated in {PAGE_GENERATED} seconds. </h1>
	</div>
</div>
</body>
</html>
