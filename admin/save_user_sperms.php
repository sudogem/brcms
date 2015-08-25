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
$db = new database;



$writing = $_POST['writing'];
$editing = $_POST['editing'];
$evaluating = $_POST['evaluating'];
$publishing = $_POST['publishing'];
$userID = $_POST['userID'];
if (isset($_POST['cancel'])){
	header( 'location: user_access_permissions.php' );
}
if ( isset($_POST['save'])) {
	// WRITE ACCESS PERMISSION
	if ( $_POST['writing'] > 0 ) {
		$sql = "select * from user_stage where userID = '$userID' and stageID = 2 ";
		$db->query($sql);
		$db->fetcharray();
		if ( !$db->getnumrows() > 0 ) {
			$sql = "insert into user_stage(userID, stageID) values( '$userID', '2' ) ";
			$db->query($sql);
		}
	}
	else{ // remove user rights
		$sql = "delete from user_stage where userID = '$userID' and stageID = 2 ";
		$db->query($sql);
	}
	
	// EDITIING ACCESS PERMISSION
	if ( $_POST['editing'] > 0 ) {
		$sql = "select * from user_stage where userID = '$userID' and stageID = 3 ";
		$db->query($sql);
		$db->fetcharray();
		if ( !$db->getnumrows() > 0 ) {
			$sql = "insert into user_stage(userID, stageID) values( '$userID', '3' ) ";
			$db->query($sql);
		}
	}
	else{ // remove user rights
		$sql = "delete from user_stage where userID = '$userID' and stageID = 3 ";
		$db->query($sql);
	}
	
	// EVALUATING ACCESS PERMISSION
	if ( $_POST['evaluating'] > 0 ) {
		$sql = "select * from user_stage where userID = '$userID' and stageID = 4 ";
		$db->query($sql);
		$db->fetcharray();
		if ( !$db->getnumrows() > 0 ) {
			$sql = "insert into user_stage(userID, stageID) values( '$userID', '4' ) ";
			$db->query($sql);
		}
	}
	else{ // remove user rights
		$sql = "delete from user_stage where userID = '$userID' and stageID = 4 ";
		$db->query($sql);
	}
	
	// PUBLISHING ACCESS PERMISSION
	if ( $_POST['publishing'] > 0 ) {
		$sql = "select * from user_stage where userID = '$userID' and stageID = 5 ";
		$db->query($sql);
		$db->fetcharray();
		if ( !$db->getnumrows() > 0 ) {
			$sql = "insert into user_stage(userID, stageID) values( '$userID', '5' ) ";
			$db->query($sql);
		}
	}
	else{ // remove user rights
		$sql = "delete from user_stage where userID = '$userID' and stageID = 5 ";
		$db->query($sql);
	}
	$_SESSION['task'] = 'edit';
	$_SESSION['title'] = getUser_info( $userID, 'fullname' );
	header('location: user_access_permissions.php');
}


?>