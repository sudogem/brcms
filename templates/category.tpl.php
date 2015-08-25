<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>El Nuevo Bantay Radyo Online</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../../templates/setfooter.js" ></script>
<link rel="stylesheet" media="screen" href="{stylesheet}" />
</head>

<body>
<div id="wrapper">
	<div id="header"><h1>&nbsp;</h1></div>
		<div id="topnavbar">
			<ul id="topnavlist">				
				<li><a href="#"> \ About the ENBR</a></li>
				<li><a href="sitemap.php"> \ Site Map</a></li>				
				<li><a href="archive.php"> \ Archives</a></li>
				<li><a href="ads.php"> \ Advertisements</a></li>
				<li><a href="index.php">\ Home</a></li>
			</ul>
		</div>	    
		<div class="clear"></div>
		   <div id="column1">
					<ul id="navlist">
						{CATEGORY}
					</ul>
					<div class="clear">&nbsp;</div>
					<div id="loginsection"><h1 class="captions">Login Form</h1>
					<form name="login" method="post" action="client/login.php" id="loginsection">
					<b>Username: </b>
					<input name="username" type="text">
					<b>Password: </b>
					<input name="password" type="password">
					<input type="submit" name="submit" value="Login" class="button" />
					</form>
					</div>
			<div class="clear">&nbsp;</div>		   	
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
			<h1 class="captions"><span class="dateline">headline news // {DATELINE} (cebu, philippines)</span></h1>
 				<div class="heading">
					{HEADING_CATEGORY}
				</div>
				{PHOTO}
				<div id="column3">
						<h1 class="headline2">{HEADLINE}</h1>
						<p class="author2">{AUTHOR}</p>
						<p class="blacktext">{ARTICLE_BODY}</p>
						<p><a href="view_article.php?articleID={ARTICLEID}">FULLSTORY &gt;&gt;</a></p>
			    </div>
				<div id="column4">
					<ul id="subsection" >
					  <h1 class="captions">{OTHER_HEADLINES_CAT}</h1>
						{OTHER_HEADLINES}
					</ul>
			  	</div>
				
				<div class="clear">&nbsp;</div>
			  <div id="column6">
				  <div class="clear"></div>
				  	{SUBSECTIONS}
			  </div>
  </div><!-- end content -->
		   <div id="footer" class="centertext">
				{FOOTER}
 		   </div>
</div>
</body>
</html>
