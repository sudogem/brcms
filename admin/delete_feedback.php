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
$fb = new feedbacks();
if ( isset( $_POST['cid']) ) { 
	$n = count( $_POST['cid'] );
	for( $i = 0; $i < $n; $i++ ){
		foreach( $_POST['cid'] as $key => $value ) {
			$fb->delete_feedback( $value );	
			$_SESSION['task'] = 'delete';
		}
	}
}
switch($_SESSION['commenttype'] ) {
	case 'feedback':
		header( 'location: feedback_manager.php' );
		break;
	case 'sources':	
		header( 'location: other_sources.php' );
		break;	
}
?>