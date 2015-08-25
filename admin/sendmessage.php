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
// print_r($_POST);
if ( isset($_POST['send'])) {
	$to = $_POST['to'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$date_msg_created = time();
	$msg = new messages();
	$result = $msg->sendMessage (  $_SESSION['userID'], $to, $date_msg_created, 'Unread', $subject, $message );
	if ($result) {
		$_SESSION['task'] = 'sent';
		$_SESSION['title'] = $subject;
		$_SESSION['to'] = $to;
		// Log the activity
		$action = new activity;
		$action->track_activity( $userID, $action->sending_msg, 'Sending a message " '. $_SESSION['title'] . ' " to ' . getUser_info($_SESSION['to'], 'fullname'));
		header('location: view_messages.php');
	}
}
if(isset($_POST['cancel'])) {
	header('location: view_messages.php');
}
?>