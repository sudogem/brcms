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
$quoteID = $_GET['quoteID'];
$q = new quote_of_the_day();
$quotes = $q->view_quote( $quoteID );
$quote_message = $quotes[0]->quote_message;
$quote_author = $quotes[0]->quote_author; 
$_SESSION['quoteID'] = $quoteID;
$_SESSION['quote_message'] = $quote_message;
$_SESSION['quote_author'] = $quote_author;
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->viewing_quotes, 'Viewing the category detail of '.$category_name );
// start compiling the page..
$tpl = new template_parser( "../templates/view_quote_detail.tpl.php" );
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