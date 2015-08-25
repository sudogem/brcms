<?php  	
include('admin/coreclass.php');
session_start();
$db = new database;


	
if ( isset($_POST['submit'])) {
	$fb = new feedbacks;
	$feedbackDate	= time();				#the date when the feedback was posted.
	$username		= $_POST['username'];				#the name of the person who posted a feedback.				
	$emailAddress	= $_POST['emailAddress'];		#the email address of the person who posted the feedback.
	$feedback		= $_POST['feedback'];			#the feedback of the person.
	$category = 1;
	$fb->send_feedbacks( $username, $emailAddress, $feedback, $category );
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

/*
 * Get the default stylesheets
 */
include( 'admin/template.configuration.php' );
$stylesheet = ' themes/'.$default_template_name.'/'.$default_template_stylesheet; 
// Generate the page now
$tpl = new template_parser( 'themes/templates/submit_feedback.tpl.php' );
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
