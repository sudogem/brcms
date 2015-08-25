<?php
require ( 'admin/coreclass.php' );
$categoryID = $_GET['categoryID'];
$db = new database;



$x = new online_tracker;
$x->tracker();

$gerger = new gerger_timer();
$gerger->start();
$gerger->setprecision(4);

/**
 * Get the headline news of this selected category
 */
$sql = " select * from article_versions av , ";
$sql .= " article_frontpage af , ";
$sql .= " article_category ac ";
$sql .= " where av.stageID = 6 ";
//$sql .= " and af.frontpage_sectionID = 1 ";
//$sql .= " and af.articleID = av.articleID";
$sql .= " and ac.articleID = av.articleID ";
$sql .= " and ac.categoryID= " . intval( $categoryID );
$sql .= " group by av.articleID ";
$sql .= " order by av.dateline desc limit 1";
if (!($result = $db->query( $sql ))) {
	die('Error:'. $db->error());
}
$headline = array();
while ( $headline[] = $db->fetcharray() );
$db->freeresult();

// get the dateline of the headline news..
$day = $headline[0]->published_day;
$month = $headline[0]->published_month;
$year = $headline[0]->published_year;
$articleID = $headline[0]->articleID;
$fullstory = '<p><a href="view_article.php?articleID=' . $articleID . '" >FULLSTORY &gt;&gt;</a></p>';

/**
 * Get the set of images of the article...( its better to have 1 image per article,, ok na!!)
 */
$imagesets = getArticle_imageSets( $headline[0]->articleID );
if( count($imagesets) > 1 ) {
	$photo = '';
	$photo .= '<div id="column2">';
	for( $i = 0; $i < count($imagesets)-1; $i++ ){
		foreach( $imagesets as $field => $value ) {
			if ( $field == 'article_imgID' ) {
				$photo .= '<img src="' . makeRelativePath( $imagesets[$i]->image_filename, 7 ) . '" alt="" width="199" height="240">';
				$photo .= '<p class="photocaption2">' . $imagesets[$i]->image_captions . '</p>';			
				$photo .= '<p class="photocaption2">Photo by: ' . $imagesets[$i]->image_photographer_author . '</p>';							
			}
		}
	}
	$photo .= '</div>';
}
else $photo = '';


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
for( $i = 0; $i < $totalcategories -1; $i++ ) {
	foreach($categories as $field => $value){
		if ($field == 'category_name'){
			$categorylist .= '<li><a href="' . VIEW_CATEGORY_URL . $categories[$i]->categoryID.'">'.$categories[$i]->category_name.'</a></li>';
		}
	}
}

$categoryID = $_GET['categoryID'];
$heading_category = getCategory_info( $categoryID , 'category_name' );

/**
 * Get the other news on this category
 */
$categoryID = $_GET['categoryID'];
$sql = " select * from article_versions av , ";
$sql .= " article_category ac ";
$sql .= " where av.stageID = '6' ";
$sql .= " and ac.articleID = av.articleID ";
$sql .= "and av.articleID != '$articleID' ";
$sql .= " and ac.categoryID = " . intval( $categoryID );
$sql .= " and av.published_day = '$day' ";
$sql .= " and av.published_month = '$month' ";
$sql .= " and av.published_year = '$year' ";
$sql .= " group by av.articleID ";
$sql .= " order by av.dateline DESC ";

$db->query( $sql );
$other_headlinenews = array();
while ( $other_headlinenews[] = $db->fetcharray() );
//echo count( $other_headlinenews );
$db->freeresult();
$other_headlines = '';
for( $i = 0; $i < count( $other_headlinenews )-1; $i++ ){
	foreach( $other_headlinenews as $field => $data ) {
		if ( $field == 'articleID' ) {
			$other_headlines .= '<li><a href="view_article.php?articleID=' . $other_headlinenews[$i]->articleID . '">' . $other_headlinenews[$i]->title . '</a>';		
						$other_headlines .= '<p class="graytext">'. makeAShortIntro( strip_tags( $other_headlinenews[$i]->article_body ) ). '</p>';
			$other_headlines .= '</li>';
		}
	}
}
$other_headlines_cat = ' other '. $heading_category . ' headlines';
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



/**
 * Get the active banner ads 148x300
 */
$banner = new rotate_banner();
$bannerdata = $banner->view_banner( '148x300' );
$ads148x300 = '';
if ( $bannerdata ) {
	if ( checkhttptext( $bannerdata->banner_clickURL )){
		$ads148x300 .= '<p><a href="' . $PHP_SELF . '?bannerID='. $bannerdata->bannerID .'">';
		$ads148x300 .= '<img src="' . makeRelativePath( $bannerdata->banner_imageurl, 7) .'" border="0" ></a>';
		$ads148x300 .= '</p>';
	}
	else{
		$ads148x300 .= '<p><a href="' . $PHP_SELF . '?bannerID='. $bannerdata->bannerID .'">';
		$ads148x300 .= '<img src="' . makeRelativePath( $bannerdata->banner_imageurl, 7) .'" border="0" ></a>';
		$ads148x300 .= '</p>';
	}		
}

/**
 * Get the active banner ads 600x140
 */
$banner = new rotate_banner();
$bannerdata = $banner->view_banner( '600x140' );
$ads600x140 = '';
if ( $bannerdata ) {
	if ( checkhttptext( $bannerdata->banner_clickURL )){
		$ads600x140 .= '<p><a href="' . $PHP_SELF . '?bannerID='. $bannerdata->bannerID .'">';
		$ads600x140 .= '<img src="' . makeRelativePath( $bannerdata->banner_imageurl, 7) .'" border="0" ></a>';
		$ads600x140 .= '</p>';
	}
	else{
		$ads600x140 .= '<p><a href="' . $PHP_SELF . '?bannerID='. $bannerdata->bannerID .'">';
		$ads600x140 .= '<img src="' . makeRelativePath( $bannerdata->banner_imageurl, 7) .'" border="0" ></a>';
		$ads600x140 .= '</p>';
	}		
}

/**
 * Get the active banner ads 180x700
 */
$banner = new rotate_banner();
$bannerdata = $banner->view_banner( '180x700' );
$ads180x700 = '';
if ( $bannerdata ) {
	if ( checkhttptext( $bannerdata->banner_clickURL )){
		$ads180x700 .= '<p><a href="' . $PHP_SELF . '?bannerID='. $bannerdata->bannerID .'">';
		$ads180x700 .= '<img src="' . makeRelativePath( $bannerdata->banner_imageurl, 7) .'" border="0" ></a>';
		$ads180x700 .= '</p>';
	}
	else{
		$ads180x700 .= '<p><a href="' . $PHP_SELF . '?bannerID='. $bannerdata->bannerID .'">';
		$ads180x700 .= '<img src="' . makeRelativePath( $bannerdata->banner_imageurl, 7) .'" border="0"></a>';
		$ads180x700 .= '</p>';
	}		
}

/**
 * Get the clicked banner from the rotated banner...
 */
$bannerclick = new rotate_banner();
$bannerclick->getclicks( $_REQUEST['bannerID'] ); 

/*
 * Get the default stylesheets
 */
include( 'admin/template.configuration.php' );
$stylesheet = ' themes/'.$default_template_name.'/'.$default_template_stylesheet; 

$db->close();
$gerger->stop();
$pagegenerated = $gerger->display();

// Generate the page now
$tpl = new template_parser( 'themes/templates/category.tpl.php' );
$tags = array(
		'{FULLSTORY}'			=> $fullstory,
		'{DATELINE}'			=> niceDate( $headline[0]->dateline ) ,
		'{ARTICLEID}'			=> $headline[0]->articleID ,	
		'{HEADLINE}' 			=> $headline[0]->title ,
		'{HEADING_CATEGORY}'	=> $heading_category,	
		'{PHOTO}'				=> $photo,	
		'{AUTHOR}' 				=> 'by '. getArticle_authors_info( $headline[0]->articleID, 'fullname' )  . ' / BR</p>' ,
		'{ARTICLE_BODY}' 		=> makeAShortIntro( $headline[0]->article_body ),
		'{VIEW_ARTICLE_URL}' 	=> $my_profile[0]->homeaddress ,
		'{OTHER_HEADLINES_CAT}'	=> $other_headlines_cat,
		'{OTHER_HEADLINES}' 	=> $other_headlines ,
		'{OTHER_HEADLINES2}' 	=> $other_headlines2 ,
		'{OTHER_TOPSTORIES}'	=> $other_topstories ,
		'{QUOTE_OF_THE_DAY}' 	=> $quote ,
		'{SUBSECTIONS}' 		=> $subsections ,
		'{ADVERTISEMENTS}' 		=> $ads ,
		'{ADS_148x300}'			=> $ads148x300 ,
		'{ADS_600x140}'		   	=> $ads600x140 ,
		'{ADS_180x700}'		   	=> $ads180x700 ,
		
		'{ADVERTISEMENTS2}'		=> $ads2 ,
		'{PAGE_GENERATED}'		=> '&nbsp;'.$pagegenerated,
		'{SPONSORED_LINKS}' 	=> $sponsoredlinks ,
		'{SUBSECTIONS}' 		=> $subsections ,
		'{CATEGORY}'			=> $categorylist , 	
		'{FOOTER}' 				=> 'themes/templates/footer.tpl.php' ,
		'{STYLESHEET}'			=> $stylesheet
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>