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
	$usertypeID = $_SESSION['usertypeID'];
}
//print_r($_POST);
$quote = $_POST['quote'];
$author = $_POST['author'];
$quoteID = $_SESSION['quoteID'];
$q = new quote_of_the_day();
if ( isset($_POST['cancel']) ) {
	header( 'Location: quote_manager.php' );
	exit();
}
else{
	// modify the existing quote
	if ($_POST['task'] == 'edit' ){
		$result = $q->update_quote( $quoteID, $author, $quote );	
		if ( $result ){
			// Log the activity
			$action = new activity;
			$action->track_activity( $userID, $action->saving_quote, 'Saving the quote  '.$quote );
		}
		$_SESSION['task'] = 'edit';
		$_SESSION['title'] = $quote;
		if ( $result ) {
			header( 'location: quote_manager.php' );
			exit;
		}
	}
	// add new quote 
	if ($_POST['task'] == 'add') {
		$result = $q->add_quote( $author, $quote );
		if ( $result ){
			// Log the activity
			$action = new activity;
			$action->track_activity( $userID, $action->saving_quote, $quote );
		}
		$_SESSION['task'] = 'add';
		$_SESSION['title'] = $quote;
		if ( $result ) {
			header( 'location: quote_manager.php' );
			exit;
		}
	}

}
?>