<?php
require ( 'admin/coreclass.php' );
$db = new database;



$x = new online_tracker;
$x->tracker();

$gerger = new gerger_timer();
$gerger->start();
$gerger->setprecision(4);

/**
 * obtain list of all client ads, images 
 */
$sql = " select * from corporate_partners_imgs ";
$sql .= " where banner_show = '1' ";
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
$alladvertisements = array();
while($alladvertisements[] = $db->fetcharray());
$ads = '';
for( $i = 0; $i < count( $alladvertisements )-1; $i++ ) {
	foreach($alladvertisements as $field => $value){
		if ($field == 'bannerID'){
			if ( checkhttptext( $alladvertisements[$i]->banner_clickURL )){
				$ads .= '<div id= "banner_imgs" >';
				$ads .= '<a href="' . $alladvertisements[$i]->banner_clickURL .'" >';
				$ads .= '<img src= "' . makeRelativepath($alladvertisements[$i]->banner_imageurl, 7) . '" border="0" ></a>';
				$ads .= '</div>';
			}
			else{
				$ads .= '<div id= "banner_imgs" >';
				$ads .= '<a href="http://' . $alladvertisements[$i]->banner_clickURL .'" >';
				$ads .= '<img src= "' . makeRelativepath($alladvertisements[$i]->banner_imageurl, 7) . '" border="0" ></a>';
				$ads .= '</div>';
			}
		}
	}
}

/**
 * Get the sponsored links
 */
$sql = " select banner_clickURL from corporate_partners_imgs ba "; 
$sql .= " where ba.banner_show = '1' ";
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
$links = array();
while($links[] = $db->fetcharray());
$db->freeresult();
$sponsoredlinks = '';
for( $i = 0; $i < count($links)-1; $i++ ){ // Count the active banners
	foreach( $links as $field => $values ){
		if ( $field == 'bannerID' ) {
			if ( checkhttptext( $links[$i]->banner_clickURL )){
				$url =splithttptext($links[$i]->banner_clickURL);
				$sponsoredlinks .= '<li><a href="' . $links[$i]->banner_clickURL . '">' . $url[1] . '</a></li>';								
			}
			else{ 
				$sponsoredlinks .= '<li><a href="http://' . $links[$i]->banner_clickURL . '">' . $links[$i]->banner_clickURL . '</a></li>';											
			} 
		}
	}
}



/**
 * obtain list of the category 
 */
$sql = "select * from category";
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

/*
 * Get the default stylesheets
 */
include( 'admin/template.configuration.php' );
$stylesheet = ' themes/'.$default_template_name.'/'.$default_template_stylesheet; 
$db->close();
$gerger->stop();
$pagegenerated = $gerger->display();

// Generate the page now
$tpl = new template_parser( 'themes/templates/ads_page.tpl.php' );
$tags = array(
		'{DATELINE}'			=> niceDate( $headline[0]->dateline ) ,
		'{ARTICLEID}'			=> $headline[0]->articleID ,	
		'{HEADLINE}' 			=> $headline[0]->title ,
		'{AUTHOR}' 				=> 'By '. getArticle_authors_info( $headline[0]->articleID, 'fullname' )  . ' / BR</p>' ,
		'{ARTICLE_BODY}' 		=> makeAShortIntro( strip_tags($headline[0]->article_body)) ,
		'{PHOTO}'				=> $photo,	
		'{VIEW_ARTICLE_URL}' 	=> $my_profile[0]->homeaddress ,
		'{OTHER_HEADLINES}' 	=> $other_headlines ,
		'{OTHER_TOPSTORIES}'	=> $other_topstories ,
		'{QUOTE_OF_THE_DAY}' 	=> $quote ,
		'{SUBSECTIONS}' 		=> $subsections ,
		'{ALL_ADVERTISEMENTS}' 	=> $ads ,
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
