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

$bannerID = $_SESSION['bannerID'];
$bannername = $_SESSION['banner_name'];
$showbanner = $_POST['showbanner'];
$from_date = mktime(0,0,0, $_POST['from_month'], $_POST['from_date'], $_POST['from_year']);			#the date when the topic was created	
$expiry_date = mktime(0,0,0, $_POST['expiry_month'], $_POST['expiry_date'], $_POST['expiry_year']);	#the date when the topic will expire
// print_r($_POST);
$db = new database;



if (isset($_POST['save'])){
	$sql = " update corporate_partners_imgs 
			 set banner_show = '$showbanner' ,
			 startdate = '$from_date' ,
			 expirydate = '$expiry_date' 
			 where bannerID = '$bannerID'
			 ";
 	$result = $db->query($sql);
	if( $result ){
		$_SESSION['task'] = 'edit';	
		$_SESSION['title'] = $bannername;
		// Log the activity
		$action = new activity;
		$action->track_activity( $userID, $action->saving_bannerads, $bannername );
		header( 'location: banner_ads_manager.php' );
	}
}
if (isset($_POST['cancel'])) {
		header( 'location: banner_ads_manager.php' );
}
?>