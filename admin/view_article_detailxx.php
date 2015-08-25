<?php
require ( 'coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login']) ) { 
	header('Location: login.php');
}
if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}
$db = new database;



// GET articleID
$articleID = $_GET['articleID'];
$_SESSION['articleID'] = $articleID;
// NOTE: stageID here will get wath stage we have based on the user menu not on the article
switch ( $_SESSION['stageID'] ) { 
	case 1: // writing
	case 2:
		$sql = " select * from articles a, ";
		$sql .= " article_author aa, ";
		$sql .= " article_category ac ";			
		$sql .= " where aa.userID = " . intval($userID);
		$sql .= " and aa.articleID = " . $articleID;
		$sql .= " and a.articleID = aa.articleID ";
		$set_template = "../templates/view_article_detail.tpl.php";		
		$link = "preview_article.php?articleID=$articleID";
		break;
	case 3: // editing
		$sql = " select * from article_versions av , ";
		$sql .= " article_category ac , ";	
		$sql .= " category c ";
		//$sql .= " where av.stageID=2";
		$sql .= " where ac.categoryID = c.categoryID ";		
		$sql .= " and ac.articleID = av.articleID ";
		$sql .= " and av.articleID=".$_SESSION['articleID'];
 		$set_template = "../templates/view_article_detail_editor_review.tpl.php";		
		$link = "preview_article_versions.php?articleID=$articleID";
		break;
	case 4: // evaluating
		$sql = " select * from article_versions av , ";
		$sql .= " article_category ac , ";	
		$sql .= " category c ";
		$sql .= " where av.stageID=3";
		$sql .= " and ac.categoryID = c.categoryID ";
		$sql .= " and ac.articleID = av.articleID ";
		$sql .= " and av.articleID=".$_SESSION['articleID'];		
		$set_template = "../templates/view_article_detail_review.tpl.php";
		$link = "preview_article_versions.php?articleID=$articleID";
		break;
	case 5: // publishing
		$sql = " select * from article_versions av ";	
		$sql .= " where av.stageID=4";
		$sql .= " and av.articleID=".$_SESSION['articleID'];		
		$set_template = "../templates/view_article_detail_publish.tpl.php";		
		$link = "preview_article_versions.php?articleID=$articleID";
		break;
	case 6: // live show!! hehehe
		$sql = " select * from article_versions av ";	
		$sql .= " where av.stageID=6";
		$sql .= " and av.articleID=".$_SESSION['articleID'];		
		$set_template = "../templates/view_article_detail_publish_unpublish.tpl.php";		
		$link = "preview_article_versions.php?articleID=$articleID";
		break;
}
print $sql;
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$view_article_detail = array();
while( $row = $db->fetcharray() ) {
	$view_article_detail[] = $row; 
}
$db->freeresult();
print_r($_SESSION);
//print $sql;

// Save the session data
$_SESSION['articleID'] = $view_article_detail[0]->articleID;
$_SESSION['title'] = $view_article_detail[0]->title;
$_SESSION['article_body'] = $view_article_detail[0]->article_body;
$_SESSION['created'] = $view_article_detail[0]->created;
$_SESSION['created_day'] = $view_article_detail[0]->created_day;
$_SESSION['created_month'] = $view_article_detail[0]->created_month;
$_SESSION['created_year'] = $view_article_detail[0]->created_year;
$_SESSION['dateline'] = $view_article_detail[0]->dateline;
$_SESSION['edited_by'] = $view_article_detail[0]->edited_by;
$_SESSION['category'] = getCategory_info( $view_article_detail[0]->categoryID, 'category_name' );
$writer = getArticle_authors_info( $view_article_detail[0]->articleID, 'fullname' );
print $writer;
$_SESSION['created_by'] = $writer;
$articlestageID = $view_article_detail[0]->stageID; 
$_SESSION['articlestageID'] = $articlestageID;
//print_r($_SESSION);
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->viewing_article, 'Viewing the article '. addslashes($_SESSION['title'] ));
// lets get the current article stage
//print_r($_SESSION);

/**
 * Check the article if there is a revision lists..
 * if naa then allow the designated user to revise it :-) ..dah..
 */
$revision_lists_found = checkRevisionLists( $articleID, $articlestageID );
if ( $revision_lists_found ) {
	switch( $articlestageID ) {
		case 2: // on writing stage
			switch( $_SESSION['stageID'] ) {
				case 1:
					$set_template = "../templates/view_article_detail.tpl.php";		
					$link = "preview_article.php?articleID=$articleID";
					break;
				case 2:	
					$set_template = "../templates/view_article_detail.tpl.php";	
					$link = "preview_article_versions.php?articleID=$articleID";
					break;
			}
			break;
		case 3: // on editing stage
			switch( $_SESSION['stageID'] ) {
				case 1:
					$set_template = "../templates/view_article_detail_live.tpl.php";		
					$link = "preview_article.php?articleID=$articleID";
					break;
				case 2:	
					$set_template = "../templates/view_article_detail_editor_review.tpl.php";		
					$link = "preview_article_versions.php?articleID=$articleID";
					break;
				case 3:	
					$set_template = "../templates/view_article_detail_editor_review.tpl.php";		
					$link = "preview_article_versions.php?articleID=$articleID";
					break;
					
			}
			break;
		case 4: // on evaluating stage
			switch( $_SESSION['stageID'] ) {
				case 1:
					$set_template = "../templates/view_article_detail.tpl.php";		
					$link = "preview_article.php?articleID=$articleID";
					break;
				case 2:	
					$set_template = "../templates/view_article_detail_live.tpl.php";		
					$link = "preview_article_versions.php?articleID=$articleID";
					break;
			}
			break;
			
	}
		
}
else{ // echo 'no revisions lists';
	switch( $articlestageID ) {
		case 2:
			switch ( $_SESSION['stageID'] ){
				case 1:
					$set_template = "../templates/view_article_detail_live.tpl.php";		
					break;
				case 2:	
					$set_template = "../templates/view_article_detail_editor_review.tpl.php";
					break;
				case 3:	
					$set_template = "../templates/view_article_detail_editor_review.tpl.php";
					break;
				case 4:
					$set_template = "../templates/view_article_detail_publish.tpl.php";		
					break;
			}
			break;
		case 3:
			switch ( $_SESSION['stageID'] ){
				case 1:
					$set_template = "../templates/view_article_detail_live.tpl.php";		
					break;
				case 2:	
					$set_template = "../templates/view_article_detail_editor_review.tpl.php";
					break;
				case 3:	
					$set_template = "../templates/view_article_detail_review.tpl.php";		
					break;
				case 4:
					$set_template = "../templates/view_article_detail_review.tpl.php";			
					break;
			}
			break;
		case 4:
			switch ( $_SESSION['stageID'] ){
				case 1:
					$set_template = "../templates/view_article_detail_live.tpl.php";		
					break;
				case 2:	
					$set_template = "../templates/view_article_detail_editor_review.tpl.php";
					break;
				case 3:	
					$set_template = "../templates/view_article_detail_review.tpl.php";		
					break;
				case 4:	
					$set_template = "../templates/view_article_detail_publish.tpl.php";		
					break;
			}
			break;
		case 5:
		case 6:
			$set_template = "../templates/view_article_detail_live.tpl.php";		
			break;
	}
	
}

/**
 * Get the image sets of the article
 */
$sql = " select * from stockphotos s, ";
$sql .= " article_imgs ai ";
$sql .= " where ai.articleID=" . $_SESSION['articleID'];
$sql .= " and ai.imageID = s.imageID ";
$db->query( $sql );
$article_images = array();
while( $article_images[] = $db->fetcharray() ); 
$_SESSION['article_images'] = $article_images;
$thumbnail = '';
for( $i = 0; $i< count( $article_images )-1; $i++ ){
	foreach( $article_images as $field => $value ) {
		if ( $field == 'imageID' ) {
			$x = makeRelativePath($article_images[$i]->image_filename, 4);
			$thumbnail .= '<div class="xpthumbnail">';
			$thumbnail .= '<img src="' . $x . '" name="Image1" class="" width="200"  height="100" border="0" >';		
			$thumbnail .= '<p><b>Photo by:</b>' . $article_images[$i]->image_photographer_author . '</p>';
			$thumbnail .= '<p><b>Caption:</b>' . $article_images[$i]->image_captions . '</p>';
			$thumbnail .= '<p><b>Alt:</b>' . $article_images[$i]->image_alttext . '</p>';
			if( $article_images[$i]->show_image ) {
				$thumbnail .= '<div align="center"><img src="images/apply_f2.png"  border="0" alt="" align="" />';	
				$thumbnail .= '<p class="orange"><b>Selected</b></p>';
				$thumbnail .= '</div>';
			}
			else{
				$thumbnail .= '<div align="center">&nbsp;';	
				$thumbnail .= '<p>&nbsp;</p><p>&nbsp;</p>';
				$thumbnail .= '</div>';
			}
			$thumbnail .= '</div>';
		}
	}
}
		
// Get the category name
$category_name = getCategory_name ( $articleID );
// Get the writer of the article
$article_authors = getArticle_authors_info ( $articleID , 'fullname' );
// link for print preview
//$link = "preview_article.php?articleID=$articleID";
// Retrieve the frontpage
$sql = " select * from frontpage_sections ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$frontpage_sections = array();
while( $row = $db->fetcharray() ) {
	$frontpage_sections[] = $row; 
}
$db->freeresult();
// Populate all the frontpage-sections into an array..
$optfrontpage_sections = '';
$frontpage = array();
foreach( $frontpage_sections as $field => $data ) {
	$optfrontpage_sections .= '<option value="' . $data->frontpage_sectionID . '" >';
	$optfrontpage_sections .= $data->frontpage_section;
	$optfrontpage_sections .= '</option>';
}
// ok baby, let start compiling the page now..go! go! go! {mh}
//print $set_template;
$tpl = new template_parser( $set_template );
$tags = array(
		'{ARTICLE_TITLE}' 		=> $view_article_detail[0]->title,
		'{CATEGORY}' 			=> $category_name,
		'{AUTHOR}' 				=> $article_authors,
		'{DATE_CREATED}' 		=> friendlyDate($view_article_detail[0]->created),
		'{ARTICLE_BODY}'		=> $view_article_detail[0]->article_body,
		'{FRONTPAGE_SECTIONS}' 	=> $optfrontpage_sections,
		'{THUMBNAIL}'			=> $thumbnail,
		'{LINK}' 				=> $link,
		'{SITENAME}' 			=> 'CMS Adminss',
		'{HEADER}' 				=> ' ',
		'{TOPNAV}' 				=> '../admin/top_menu.php',
		'{FOOTER}' 				=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>