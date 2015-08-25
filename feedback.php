<?php
require ( 'admin/coreclass.php' );
session_start();
$db = new database;



$x = new online_tracker;
$x->tracker();

$gerger = new gerger_timer();
$gerger->start();
$gerger->setprecision(4);


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

/*
 * Get the default stylesheets
 */
include( 'admin/template.configuration.php' );
$stylesheet = ' themes/'.$default_template_name.'/'.$default_template_stylesheet; 
$db->close();
$gerger->stop();
$pagegenerated = $gerger->display();

// Generate the page now
$tpl = new template_parser( 'themes/templates/feedback_form_tpl.php' );
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
		'{ADS_148x300}'			=> $ads148x300,
		'{MESSAGE}'				=> $message,
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
