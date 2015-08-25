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
$feedbackID = $_GET['feedbackID'];
$feedback_detail = array();
$fb = new feedbacks;
$fb->set_read_feedback($feedbackID);
$feedback_detail  = $fb->read_feedback($feedbackID);
$_SESSION['quoteID'] = $quoteID;
$_SESSION['quote_message'] = $quote_message;
$_SESSION['quote_author'] = $quote_author;

switch( $_SESSION['commenttype'] ) {
	case 'feedback':
		$heading = "Feedback/Comments";
		$feedback = "Feedback";
		break;
	case 'sources':	
		$heading = "External Sources";
		$feedback = "Message";		
		break;
}
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->viewing_quotes, 'Viewing the category detail of '.$category_name );
// start compiling the page..
$tpl = new template_parser( "../templates/view_feedback_detail.tpl.php" );
$tags = array(
		'{NAME}'			=> $feedback_detail[0]->name ,
		'{EMAIL}'			=> $feedback_detail[0]->emailAddress ,
		'{FEEDBACK_MSG}'	=> $feedback_detail[0]->feedback ,	
		'{HEADING}'			=> $heading ,
		'{FEEDBACK}'		=> $feedback,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{CONTENT}' 		=> $row_data,
		'{FOOTER}' 			=>  'footer.php' 
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>