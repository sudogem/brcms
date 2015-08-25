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
$quote_message = $_SESSION['quote_message'];
$quote_author = $_SESSION['quote_author'];
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->viewing_quotes, 'Viewing the category detail of '.$category_name );
// start compiling the page..
$tpl = new template_parser( "../templates/edit_quote_detail.tpl.php" );
$tags = array(
		'{QUOTE}' 			=> $quote_message,
		'{AUTHOR}'			=> $quote_author,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{CONTENT}' 		=> $row_data,
		'{FOOTER}' 			=>  'footer.php' 
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>