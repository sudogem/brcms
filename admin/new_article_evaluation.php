<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: login.php');
}

if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}
$articleID = $_SESSION['articleID'];
$title = $_SESSION['title'];
$article_body = $_SESSION['article_body'];
$created = $_SESSION['created'];
$dateline = $_SESSION['dateline'];
if (isset($_SESSION['edited_by']) && $_SESSION['edited_by']){
	$editorID = $_SESSION['edited_by'];
}else{
	$editorID = $userID;
}
// Get the writers name of the article
$writer_name = getArticle_authors_info( $articleID, 'fullname' );
// Get the editor's name of the article
$editor_name = getUser_info( $editorID, 'fullname' );
// Get the category name of this article

$category_name = getCategory_name ( $articleID );
if ( isset( $_GET['status'] ) ) {
	switch ( $_GET['status'] ) {
		case 'reject':
			$msg = " The article was rejected by the News Director. ";
			$subject = "REJECTED " . $title ;
			$_SESSION['status'] = 'Reject';
			break;
		case 'approve':	
			$msg = " The article was approved by the News Director. "; 
			$subject = "APPROVED " . $title ;
			$_SESSION['status'] = 'Approve';
			break;
		case 'revise':	
			$msg = " Kindly revise the article. "; 
			$subject = "REVISE " . $title ;
			$_SESSION['status'] = 'Revise';
			break;
	}
}
$date_msg_created = time();
$_SESSION['date_msg_created'] = $date_msg_created;
//print_r($_SESSION) ;
$tpl = new template_parser( '../templates/new_article_evaluation.tpl.php' );
$tags = array(
		'{ARTICLE_TITLE}' 	=> $title,
		'{CATEGORY}' 		=> $category_name,
		'{AUTHOR}' 			=> $article_authors,
		'{SUBJECT}' 		=> $subject,
		'{DATE}' 			=> friendlyDate ( $date_msg_created ),
		'{DATE_CREATED}' 	=> friendlyDate ( $created ),
		'{ARTICLE_BODY}'	=> $article_body,
		'{WRITER_NAME}' 	=> $writer_name,
		'{EDITOR_NAME}' 	=> $editor_name,
		'{ASSIGN}'			=> $assign,
		'{MESSAGE}' 		=> $msg,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();


?>