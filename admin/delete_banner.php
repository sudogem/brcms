<?php
include( 'configuration.php' );
require('../admin/coreclass.php');
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



if ( isset( $_POST['cid']) ) { 
	$n = count( $_POST['cid'] );
	for( $i = 0; $i < $n; $i++ ){
		foreach( $_POST['cid'] as $key => $value ) {
			if ( $key == $i ) {
				$sql = " delete from corporate_partners_imgs where bannerID = '$value' ";
				$db->query( $sql );
				$_SESSION['task'] = 'delete';							
			}
		}
	}
	if ( $err ) {
		echo '<script>history.go(-1);</script>';
	}
}
header( 'location: banner_ads_manager.php' );
?>