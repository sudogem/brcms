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
$db = new database;



//print_r($_POST);
//echo count($_POST['cid']);
$delete_err = 0;
if ( isset( $_POST['cid']) ) { 
	if (count( $_POST['cid'] ) > 1) { // if more than 1 messages to delete..
		foreach( $_POST['cid'] as $key => $value ) {
			$sql = "delete from poll_topic ";
			$sql .= " where topic_id = '$value' ";
			if (!($result = $db->query($sql))) {
				die('Error:'.$db->error() );
			}
			if ( $done ) {
				// Log the activity
				$action = new activity;
				$action->track_activity( $userID, $action->deleting_msg, 'Deleting a message "'. $title .'"' );
			}
			else{
				$delete_err++;
			}
		}
		$_SESSION['task'] = 'delete_some_msgs';
	}
	else{ // she checked only 1 message to delete..
		$value = $_POST['cid'][0];
		$sql = "delete from poll_topic ";
		$sql .= " where topic_id = '$value' ";
		if (!($result = $db->query($sql))) {
			die('Error:'.$db->error() );
		}
		if ( $done ) {
			// Log the activity
			$action = new activity;
			$action->track_activity( $userID, $action->deleting_msg, 'Deleting a message "'. $title .'"' );
		}
		else{
			$delete_err++;
		}
		$_SESSION['task'] = 'delete';
		$_SESSION['title'] = $title;	
	}
}
if( $delete_err > 0 ){
	$_SESSION['task'] = 'faileddelete';
	header( 'Location: list_poll_survey.php' );	
}
else{
	header( 'Location: list_poll_survey.php' );
}

?>