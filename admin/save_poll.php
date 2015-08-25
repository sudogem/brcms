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

if(($_POST['topic'] == "") || $_POST['label'] == "") {
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit();
}



$topic_id = $_SESSION['topic_id'];
$topic = $_POST['topic'];				#the topic inserted by the user
$response_label = $_POST['label'];		#the responses label
$from_date = date("Y-m-d ", mktime(0,0,0, $_POST['from_month'], $_POST['from_date'], $_POST['from_year']));			#the date when the topic was created	
$expiry_date = date("Y-m-d ", mktime(0,0,0, $_POST['expiry_month'], $_POST['expiry_date'], $_POST['expiry_year']));	#the date when the topic will expire

if ( isset( $_POST['save'] ) ) {
	switch( $_POST['task'] ) {
		case 'add' :
			$sql = "INSERT INTO poll_topic VALUES('', '$topic', '$response_label', '$from_date', '$expiry_date')";	
			$_SESSION['task'] = 'add';		
			$_SESSION['title'] = $topic;
			break;
		case 'edit' :	
			$sql = "update poll_topic ";
			$sql .= " set topic = '$topic' , ";
			$sql .= " response_label = '$response_label' , ";	
			$sql .= " topic_date = '$from_date' , ";
			$sql .= " expiry_date = '$expiry_date' ";
			$sql .= " where topic_id =" . intval( $topic_id );
			$_SESSION['task'] = 'edit';
			$_SESSION['title'] = $topic;
			break;
	}
	$con = new database();
	if(!$con->query($sql)) {
		echo 'Error: '.$con.error();
	}
}
if ( isset( $_POST['cancel'] ) ) {
	header('Location: list_poll_survey.php');
}
header('Location: list_poll_survey.php');
?>