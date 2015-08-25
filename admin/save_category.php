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

$categoryID = $_SESSION['categoryID'];
//print_r($_POST);
$db = new database;



$category_name = $_POST['category_name'];
$category_desc = $_POST['category_desc'];
if ( isset($_POST['cancel']) ) {
	header( 'Location: category_manager.php' );
	exit();
}
// modify the existing category
if ($_POST['task'] == 'edit' ){
	$sql = " update category ";
	$sql .= " set category_name = '$category_name' ,"; 
	$sql .= " category_desc = '$category_desc' ";
	$sql .= " where categoryID=" . intval($categoryID);
	if (!($result = $db->query($sql))) {
		die('Error:'.$db->error() );
	}
	if ( $result ){
		// Log the activity
		$action = new activity;
		$action->track_activity( $userID, $action->saving_category, 'Saving the category detail of '.$category_name );
	}
	$_SESSION['task'] = 'edit';
	$_SESSION['title'] = $category_name;
	if ( $result ) {
		/*echo '<script>alert("Successfully saved the category.");</script>';	*/
		header( 'location: category_manager.php' );
		exit;
	}
}
// add new category 
if ($_POST['task'] == 'add') {
	$sql = " insert into category ( category_name, category_desc)";
	$sql .= " values( '$category_name', '$category_desc' ) ";
	if (!($result = $db->query($sql))) {
		die('Error:'.$db->error() );
	}
	if ( $result ){
		// Log the activity
		$action = new activity;
		$action->track_activity( $userID, $action->saving_category, $category_name );
	}
	$_SESSION['task'] = 'add';
	$_SESSION['title'] = $category_name;
	if ( $result ) {
		/*echo '<script>alert("Successfully saved the category.");</script>';*/
		header( 'location: category_manager.php' );
		exit;
	}
}
?>