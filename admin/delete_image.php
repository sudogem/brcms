<?php
include( 'configuration.php' );
require ( '../admin/coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: ../admin/login.php');
}

if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}

$imageID = $_GET['imageID'];
$db = new database;



$sql = " select * from stockphotos where imageID= '$imageID' ";
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
$image = array();
while($image[] = $db->fetcharray());
$imagename = $image[0]->image_filename; 

$sql = " delete from stockphotos 
		 where imageID= '$imageID' ";

if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
//unlink( makeRelativepath($imagename, 4) );
if ( $result ) {
	// Log the activity
	$action = new activity;
	$action->track_activity( $userID, $action->deleting_image, makeRelativepath($imagename, 7)  );
}
header( 'location: ' . $_SERVER['HTTP_REFERER']);
?>