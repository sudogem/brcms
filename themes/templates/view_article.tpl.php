<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>El Nuevo Bantay Radyo Online</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="../../templates/setfooter.js" >
</script>
<link rel="stylesheet" media="screen" href="{stylesheet}" />
</head>

<body>
<div id="wrapper">
	<div id="header"><pre class="searchpos"><form name="" method="post" action="search_results.php"><span class="whitetext"><b>Search::</b></span><input name="searchstr" class="inputbox" type="text" size="20"><input type="submit" name="submit" value="Go" class="button2" /></form></pre></div>
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
					<div id="loginsection"><h1 class="captions">Login Form</h1>
					<form name="login" method="post" action="client/login.php" id="loginsection">
					<b>Username: </b>
					<input class="inputbox"name="username" type="text">
					<b>Password: </b>
					<input class="inputbox"name="password" type="password">
					<input type="submit" name="submit" value="Login" class="button2" />
					</form>
					</div>
			<div class="clear">&nbsp;</div>		   	
					
			  <div id="sections"><h1 class="captions">sponsored links</h1>
					<ul id="sponsoredlinks">
				  {SPONSORED_LINKS}
					</ul>
			  </div>
			   <h1 class="captions">advertisements</h1>
			  <div id="banner_area" class="left_vert_rectangle_ads1">{ADS_148x300}</div>
  </div>
			<div id="contentx"><!-- begin content -->
			<h1 class="captions"><span class="dateline">headline news // {DATELINE} (cebu, philippines)</span></h1>
 				<div class="heading">
					{HEADING_CATEGORY}
				</div>
				<div id="view_article">
						<h1 class="headline2">{TITLE}</h1>
						<p class="author2">By {AUTHOR}</p>
						<p class="blacktext">{PHOTO}{ARTICLE_BODY}</p>
						<div class="clear"></div>
						<table width="373" border="0" id="downloadformat">
						<tr>
						<td width="180"><a href="{LINK}" style="font:normal 12px Verdana, Arial, Helvetica, sans-serif; ">Download DOC Format</a></td>
						<td width="183"><a href="javascript:window.print();" style="font:normal 12px Verdana, Arial, Helvetica, sans-serif; ">Print this article</a></td>
						</tr>
						</table>
					<div id="column4_right">
						<ul id="subsection" >
						  <h1 class="captions">{OTHER_HEADLINES_CAT}</h1>
							{OTHER_HEADLINES}
						</ul>
						<div class="clear">&nbsp;</div>
						<h1 class="captions">ADVERTISEMENTS</h1>
						<div id="banner_area" class="bottom_horiz_rectangle_ads2">{ADS_600x140}</div> 
					</div>
					
			    </div>
				
				<div id="column5">
				<h1 class="captions">ADVERTISEMENTS</h1>
					<div  id="banner_area" class="right_vert_rectangle_ads1">{ADS_180x700}</div> 
				</div>
				<div id="column6">
				 <div class="clear"></div>
				</div>
				
  </div><!-- end content -->  
<div class="clear">&nbsp;</div>
<div id="footer"  class="centertext">
		{FOOTER}
	<h1>Page was generated in {PAGE_GENERATED} seconds. </h1>
		
</div>
</div>

</body>
</html>
