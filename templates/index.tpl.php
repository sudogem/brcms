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
	<div id="header"><pre class="searchpos"><form name="" method="post" action="search_results.php"><span class="whitetext"><b>Search::</b></span><input name="searchstr" type="text" size="20"><input type="submit" name="submit" value="Go" class="button" /></form></pre>
</h1></div>
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
					<div class="clear">&nbsp;</div>
					<div id="loginsection"><h1 class="captions">Client-Login Form</h1>
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
					<ul id="sponsoredlinks">
				  {SPONSORED_LINKS}
					</ul>
			  </div>
			  <div id="sections">
				  <h1 class="captions">advertisements</h1>
				  <p>{ADVERTISEMENTS}</p>		
			  </div>
  </div>
			<div id="content"><!-- begin content -->
				<div id="midcontent">
				  <h1 class="dateline">headline news // {DATELINE} (cebu, philippines)</h1>
				  <div id="headlinesection">
						{PHOTO}
					<div id="column3">
							<h1 class="headline">{HEADLINE}</h1>
							<p class="author">{AUTHOR}</p>
							<p class="text">{ARTICLE_BODY}</p>
							<p><a href="view_article.php?articleID={ARTICLEID}" >FULLSTORY &gt;&gt;</a></p>
					</div>
					<div id="column4">
						<ul id="subsection" >
							{OTHER_HEADLINES}
						</ul>
					</div>
				</div>
					<div id="column5">
					  <h1 class="titletops">other top stories</h1>
						<ul id="subsection" >				  
							{OTHER_TOPSTORIES}
						</ul>	
					</div>
				</div>	
				<div class="clear"></div>
			  <div id="column6">
				  <div id="quote">
					<h1 class="titlequote">quote of the day </h1>
					<p class="quotes">{QUOTE_MESSAGE} --- <i> {QUOTE_AUTHOR}</i></p>
				  </div>
				  <div class="clear"></div>
				  	{SUBSECTIONS}
			  </div>
      </div><!-- end content -->
	  <div class="clear"></div>	
	<div class="centertext" id="footer">
		{FOOTER}
	<h1>Page was generated in  {PAGE_GENERATED} seconds. </h1>
	  <div class="clear">&nbsp;</div>		
	</div>
</div>
</body>
</html>
