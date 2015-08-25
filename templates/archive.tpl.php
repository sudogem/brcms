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
				<li><a href="#">About the ENBR</a></li>
				<li><a href="sitemap.php"> \ Site Map</a></li>
				<li><a href="archive.php">Archives</a></li>
				
				<li><a href="ads.php">Advertisements</a></li>
				<li><a href="index.php">Home</a></li>
			</ul>
		</div>	    

		<div class="clear"></div>
		   <div id="xcontent"><!-- begin content -->
		   <div id="archive">
				<form name="search_results" method="post" action="archive.php">
&nbsp;&nbsp;&nbsp;Go to  : 
<select name="month" >
							<option value=""> &nbsp;- Select Month - &nbsp;</option>
							<option value="1" >January</option>
							<option value="2"  >February</option>
							<option value="3"  >March</option>
							<option value="4" >April</option>
							<option value="5"  >May</option>
							<option value="6"  >June</option>
							<option value="7"  >July</option>
							<option value="8"  >August</option>
							<option value="9" >September</option>
							<option value="10"  >October</option>
							<option value="11"  >November</option>
							<option value="12"  >December</option>
				  </select>
						<select name="day" >
							<option value=""> &nbsp;- Select Day - &nbsp;</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
							<option value="31">31</option>
							
				  </select>						  
						<select name="year" >
							<option value=""> &nbsp;- Select Year - &nbsp;</option>
							{LIST_OF_YEARS}
						  </select>		
						<select name="order_by" >
							<option value="asc" {ASC} > &nbsp;ASCENDING&nbsp;</option>
							<option value="desc" {DESC} > &nbsp;DESCENDING&nbsp;</option>
				  </select>			
						  <br>
				&nbsp;&nbsp;&nbsp;Article title :<input type="text" name="title" value="{SEARCH_TITLE}" >  
				<select name="category" >
							<option value=""> &nbsp;- Select Category - &nbsp;</option>
							{LIST_OF_CATEGORY}
						  </select>
                <input type="submit" name="go" value="Go" class="button">						  
		        </form>
						  <h3>All News</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="archive_page">
									<tr class="table_header">
									<td width="2%" class="tdcaptions">#</td>
									<td width="20%" class="tdcaptions">{DATE_PUBLISHED}</td>
									<td width="40%" class="tdcaptions">{ARTICLE_TITLE}</td>
									<td width="10%" class="tdcaptions">{CATEGORY}</td>
									</tr>
								  {TABLE_DATA}
									<tr class="table_header">
									<td colspan="100%" id="paging"  class="tdcaptions" align="center">{PAGELINK}&nbsp;</td>
									</tr>
								</table>				
			</div>	
  			</div><!-- end content -->
	  <div class="clear"></div>	  
	<div class="centertext" id="footer">
		{FOOTER}
	</div>
</div>
</body>
</html>
