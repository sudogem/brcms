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
//print_r($_POST);
$msg = new messages;
switch( $_POST['task'] ) {
	case 'new':
		$gotoURL = "..admin/new_private_message.php";	
		header("location: $gotoURL");
		exit;
		break;
	case 'delete':
		$delete_err = 0;
		if ( isset( $_POST['cid']) ) { 
			foreach( $_POST['cid'] as $key => $value ) {
				$msg->archive_message( $userID, $value );
			}
		}	
		$_SESSION['task'] = 'delete';
		$gotoURL = "..admin/view_messages.php";				
		break;
	case 'archive':
		if ( isset($_SESSION['msgID'] ) ) {
			$value = $_SESSION['msgID'];
			$msg->archive_message( $userID, $value );	
			unset($_SESSION['msgID']);	
		}
		else{
			foreach( $_POST['cid'] as $key => $value ) {
				$msg->archive_message( $userID, $value );
			}
		}
		$_SESSION['task'] = 'archive';
		$gotoURL = "view_messages.php";		
		break;	
	case 'unarchive':
		foreach( $_POST['cid'] as $key => $value ) {
			$msg->unarchive_message( $userID, $value );
		}
		$_SESSION['task'] = 'unarchive';
		$gotoURL = "message_archive_manager.php";
		break;	
}
//echo $gotoURL;
header("location: $gotoURL ");
exit;
?>