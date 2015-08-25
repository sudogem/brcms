<?php
// current activity: Listening with my favorite 'e-heads' 'With a smile'..
require ( 'admin/coreclass.php' );
include('autoresponder/responder.php');

$db = new database();
$x = new online_tracker;
$x->tracker();

$gerger = new gerger_timer();
$gerger->start();
$gerger->setprecision(4);

/**
 * retrieve all the news articles on live 
 */
$sql = " select * from article_versions av "; 
$sql .= " where av.stageID = '6' ";
$sql .= " order by av.dateline DESC ";
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
$allarticles = array();
while( $row = $db->fetcharray() ) {
	$allarticles[] = $row;
}
$totalarticles = count( $allarticles );

/**
 * Get the headline news 
 */
$sql = " select * from article_versions av , ";
$sql .= " article_frontpage af ";
$sql .= " where af.frontpage_sectionID = 1 ";
$sql .= " and av.stageID = 6 ";
$sql .= " and af.articleID = av.articleID";
//$sql .= " and av.isarchive = 1 ";
$sql .= " group by av.articleID ";
$sql .= " order by av.dateline desc limit 1 ";
//echo  $sql;
$db->query( $sql );
$headline = array();
while ( $headline[] = $db->fetcharray() );
$db->freeresult();
//print_r($headline);
// get the dateline of the headline news..
$day = $headline[0]->published_day;
$month = $headline[0]->published_month;
$year = $headline[0]->published_year;
$articleID = $headline[0]->articleID;
// fullstory link
$fullstory = '<p><a href="view_article.php?articleID=' . $articleID . '" >FULLSTORY &gt;&gt;</a></p>';

/**
 * Get the "other top stories" 
 * Note: the date of topstories news was based on
 * the dateline of the headline news...am i right or wrong ??
 */
$sql = " select * from article_versions av , ";
$sql .= " article_frontpage af ";
$sql .= " where af.frontpage_sectionID = '2'";
$sql .= " and av.stageID = '6' ";
$sql .= " and af.articleID = av.articleID ";
$sql .= " and av.published_day = '$day' ";
$sql .= " and av.published_month = '$month' ";
$sql .= " and av.published_year = '$year' ";
$sql .= " group by av.articleID ";
//$sql .= " order by av.dateline desc ";

$db->query( $sql );
$other_topstoriesnews = array();
while ( $other_topstoriesnews[] = $db->fetcharray() );
//print_r($other_topstoriesnews);
$db->freeresult();
$other_topstories = '';
for( $i = 0; $i < count( $other_topstoriesnews ) - 1; $i++ ){
	foreach( $other_topstoriesnews as $field => $data ) {
		if ( $field == 'title' ) {
			$other_topstories .= '<li><a href="view_article.php?articleID=' . $other_topstoriesnews[$i]->articleID . '"' . ' class="bold">' . $other_topstoriesnews[$i]->title . '</a>';		
			$other_topstories .= '</li>';
		}
	}
}

/**
 * obtain list of the category 
 */
$sql = "select * from category order by category_name ASC";
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
$categories = array();
while($categories[] = $db->fetcharray());
$totalcategories = count($categories);
$categorylist = '';
for( $i = 0; $i < $totalcategories-1; $i++ ) {
	foreach($categories as $field => $value){
		if ($field == 'category_name'){
			$categorylist .= '<li><a href="' . VIEW_CATEGORY_URL . $categories[$i]->categoryID.'">'.$categories[$i]->category_name.'</a></li>';
		}
	}
}

/**
 * Get the set of image of the article...it will put beside the headline news
  ( its better to have (1)one photo per article mas nindot cya taw-awon!!..  )
 */
$imagesets = getArticle_imageSets( $headline[0]->articleID );
if( count($imagesets) > 1 ) {
	$photo = '';
	$photo .= '<div id="column2">';
	for( $i = 0; $i < count($imagesets)-1; $i++ ){
		foreach( $imagesets as $field => $value ) {
			if ( $field == 'article_imgID' ) {
				$photo .= '<img src="' . makeRelativePath( $imagesets[$i]->image_filename, 7 ) . '" alt="" width="200" height="240" class="photob" border="0">';
				$photo .= '<p class="photocaption">' . $imagesets[$i]->image_captions . '</p>';			
				$photo .= '<p class="photocaption">Photo by: ' . $imagesets[$i]->image_photographer_author . '</p>';							
			}
		}
	}
	$photo .= '</div>';
}
else $photo = '';

/**
 * Get all live articles on each category
 */
$subsections = ''; 
for( $i = 0; $i < $totalcategories; $i++ ) {
	foreach( $categories as $field => $values ) {
		if ( $field == 'categoryID' ) $categoryID = $categories[$i]->categoryID;
	}
	$article_category = getLiveArticleOnCategory( $categoryID, $day, $month, $year,'' );
	$n = count($article_category)-1;
	//print "$categoryID=$n,";
	if ($n > 0) {
		$subsections .= '<div id="subsections"><h1 class="captions">' . $categories[$i]->category_name . '</h1>';
		$subsections .= '<ul id="subsection">';
			for( $j = 0; $j < $n ; $j++ ){
				foreach( $article_category as $field => $values ) {
					if ( $field == 'articleID' ) {
						$img = getArticle_imageSets( $article_category[$j]->articleID );
						if ( $j == 0 ) {
							if ( count($img)-1 > 0 ) { // if image found, make it a thumbnail
								$subsections .= '<li>';
								$subsections .= '<img alt="' . $img[0]->image_alttext . '" src="' . makeRelativePath($img[0]->image_filename, 7) .'" width="59" height="75" class="imageleft">';
								//$subsections .= '<a href="' . VIEW_ARTICLE_URL2 . $article_category[$j]->articleID . '">' . strip_tags($article_category[$j]->title) . '</a>';
								$subsections .= '<b />'. ( strip_tags($article_category[$j]->title ) ) ;
								$subsections .= '<a href="' . VIEW_ARTICLE_URL2 . $article_category[$j]->articleID . '">'; 								
								//$subsections .= '<p class="graytext">'. makeAShortIntro( strip_tags($article_category[$j]->article_body ) ) . '</p>';
								$subsections .= '<p class="graytext">'. makeAShortIntro( strip_tags($article_category[$j]->article_body ) ) . '</p>';
								$subsections .= '</a>';
								$subsections .= '</li>';								
							}
							else{
								$subsections .= '<li>';
								$subsections .= '<b />'. ( strip_tags($article_category[$j]->title ) ) ;
								$subsections .= '<a href="' . VIEW_ARTICLE_URL2 . $article_category[$j]->articleID . '">'; 								
								//$subsections .= '<p class="graytext">'. makeAShortIntro( strip_tags($article_category[$j]->article_body ) ) . '</p>';
								$subsections .= '<p class="graytext">'. makeAShortIntro( strip_tags($article_category[$j]->article_body ) ) . '</p>';
								$subsections .= '</a>';
								$subsections .= '</li>';								
							}	
						}
						else{
							$subsections .= '<li><a href="' . VIEW_ARTICLE_URL2 . $article_category[$j]->articleID . '">' . strip_tags($article_category[$j]->title) . '</a></li>';				
						}
					}
				}
			}
			$subsections .= '</ul>';
			$subsections .= '</div>';
			if ( ( ($t = ($i+1) ) % 2) == 0 ) $subsections .= '<div class="clear"></div>';
	}
}

/**
 * Get the active banner ads 148x300
 */
$banner = new rotate_banner();
$bannerdata = $banner->view_banner( '148x300' );
$ads148x300 = '';
if ( $bannerdata ) {
	if ( checkhttptext( $bannerdata->banner_clickURL )){
		$ads148x300 .= '<p><a href="' . $PHP_SELF . '?bannerID='. $bannerdata->bannerID .'">';
		$ads148x300 .= '<img src="' . makeRelativePath( $bannerdata->banner_imageurl, 7) .'" border="0" width="130" ></a>';
		$ads148x300 .= '</p>';
	}
	else{
		$ads148x300 .= '<p><a href="' . $PHP_SELF . '?bannerID='. $bannerdata->bannerID .'">';
		$ads148x300 .= '<img src="' . makeRelativePath( $bannerdata->banner_imageurl, 7) .'" border="0" width="130" ></a>';
		$ads148x300 .= '</p>';
	}		
}

/**
 * Get the active banner ads 800x140
 */
$banner = new rotate_banner();
$bannerdata = $banner->view_banner( '800x140' );
$ads800x140 = '';
if ( $bannerdata ) {
	if ( checkhttptext( $bannerdata->banner_clickURL )){
		$ads800x140 .= '<p><a href="' . $PHP_SELF . '?bannerID='. $bannerdata->bannerID .'">';
		$ads800x140 .= '<img src="' . makeRelativePath( $bannerdata->banner_imageurl, 7) .'" border="0" ></a>';
		$ads800x140 .= '</p>';
	}
	else{
		$ads800x140 .= '<p><a href="' . $PHP_SELF . '?bannerID='. $bannerdata->bannerID .'">';
		$ads800x140 .= '<img src="' . makeRelativePath( $bannerdata->banner_imageurl, 7) .'" border="0" ></a>';
		$ads800x140 .= '</p>';
	}		
}

/**
 * Get the clicked banner from the rotated banner...
 */
$bannerclick = new rotate_banner();
$bannerclick->getclicks( $_REQUEST['bannerID'] ); 

/**
 * Get the sponsored links.., esp. the active clients 
 */
$sql = " select website from corporate_partners cp "; 
$sql .= " where cp.status = '1' ";
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
$links = array();
while($links[] = $db->fetcharray());
$db->freeresult();
$sponsoredlinks = '';
$n = count($links)-1;
for( $i = 0; $i < $n; $i++ ){ // Count the active banners
	foreach( $links as $field => $values ){
		if ( $field == 'clientID' ) {
			if ( checkhttptext( $links[$i]->website )){
				$url =splithttptext($links[$i]->website);
				$sponsoredlinks .= '<li><a href="' . $links[$i]->website . '">' . $url[1] . '</a></li>';								
			}
			else{ 
				$sponsoredlinks .= '<li><a href="http://' . $links[$i]->website . '">' . $links[$i]->website . '</a></li>';											
			} 
		}
	}
}
###################################################
# get station segments here
$rs = get_table_data('news_segments');

while($data = mysql_fetch_assoc($rs)) {
	$segments .= '<li><a href="segments.php?segmentID='.$data['autoNumber'].'">'.$data['segmentTitle'].'</li>';
}

/*
 * Generate random quote
 */
$quote = new quote_of_the_day;
$result = $quote->generate_random_quote();
$quote_author = $result[0]->quote_author;
$quote_message = $result[0]->quote_message;

/**
 * Get the poll of the day
 */
//get the current date
$date = date('Y-m-d');
$sql  = "SELECT * FROM poll_topic"; 
$sql .= " WHERE topic_date = '$date' OR '$date' BETWEEN topic_date AND expiry_date ";
//echo $sql;
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
$poll = array();
while( $poll[] = $db->fetcharray() );
$npoll = count($poll)-1;
//echo $npoll;
if ( $npoll > 0 ) $pollfound = true;
$db->freeresult();
$topicid = $poll[0]->topic_id;
$topic = $poll[0]->topic;
$labels = $poll[0]->response_label;
$labels = explode(",", $labels);

if ( $pollfound ) {
	foreach( $labels as $idx => $value ){
		$optlabel .= '<input name="label" type="radio" value="' . $value . '">' . $value ;
		$optlabel .= '<br>';
	}
	//
	$viewpollresult .= '<input type="button" class="button2" onClick=popupWindow("' . "admin/create_poll_graph.php?topic_id=" . $topicid . '","win1",640,350,"yes","yes"); name="submit" value="Results"  class="button" />';
	if ( $npoll > 1 ) {
		$viewpollresult .= '<br><a href="#"  onClick=popupWindow("view_more_poll.php","win2",300,300,"yes","yes");>';
		$viewpollresult .= '&nbsp;<b class="whitetext">View more poll&gt;&gt;</b>';
		$viewpollresult .= '</a>';
	}
	
	$polls .= '<form name="pollform" method="post" action="admin/save_poll_response2.php">';
	$polls .= '	<input type="hidden" name="topicid" value="'. $topicid . '" >';
	$polls .= $topic;
	$polls .= '<br>'; 
	$polls .= $optlabel;
	$polls .= '<input type="submit" class="button2" name="submit" value="Vote"  class="button" />';
	$polls .= $viewpollresult;
}
else{
	$polls = '<b>No Polls available</b>';
}
/*
 * Get the default stylesheets
 */
include( 'admin/template.configuration.php' );
$stylesheet = ' themes/'.$default_template_name.'/'.$default_template_stylesheet; 
$db->close();
$gerger->stop();
$pagegenerated = $gerger->display();
// Generate the page now
$tpl = new template_parser( 'themes/templates/index.tpl.php' );
$tags = array(
		'{FULLSTORY}'			=> $fullstory,
		'{DATELINE}'			=> niceDate( $headline[0]->dateline ) ,
		'{ARTICLEID}'			=> ' '.$headline[0]->articleID ,	
		'{HEADLINE}' 			=> $headline[0]->title ,
		'{AUTHOR}' 				=> 'By '. getArticle_authors_info( $headline[0]->articleID, 'fullname' )  . '</p>' ,
		'{ARTICLE_BODY}' 		=> makeAShortIntro( strip_tags($headline[0]->article_body)) ,
		'{PHOTO}'				=> $photo,	
		'{VIEW_ARTICLE_URL}' 	=> $my_profile[0]->homeaddress ,
		'{OTHER_HEADLINES}' 	=> $other_headlines ,
		'{OTHER_TOPSTORIES}'	=> $other_topstories ,
		'{OUR_SEGMENTS}'		=> $segments ,
		'{TOPICID}'				=> $topicid,
		'{POLLS}'				=> $polls,	
		'{POLL_LABELS}'			=> $optlabel,
		'{POLL_TOPIC}'			=> $topic,
		'{VIEW_POLL_RESULT}'	=> $viewpollresult,		
		'{QUOTE_MESSAGE}'	 	=> $quote_message,
		'{QUOTE_AUTHOR}' 		=> $quote_author ,
		'{SUBSECTIONS}' 		=> $subsections ,
		'{ADVERTISEMENTS}' 		=> $ads ,
		'{ADS_148x300}'			=> $ads148x300 ,
		'{ADS_800x140}'		   	=> $ads800x140 ,
		'{PAGE_GENERATED}'		=> '&nbsp;'.$pagegenerated,
		'{SPONSORED_LINKS}' 	=> $sponsoredlinks ,
		'{SUBSECTIONS}' 		=> $subsections ,
		'{CATEGORY}'			=> $categorylist , 	 
		'{FOOTER}' 				=> 'themes/templates/footer.tpl.php' ,
		'{STYLESHEET}'			=> $stylesheet,
		
		'{ENGINE_ LINK}'			=> '<a href="http://www.google.com"><img src="images/logo_google.png"></a>'
		
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>
