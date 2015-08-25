<?php
/* 
 * background music: Eraserheadz..current track: "Alapaap" -{mh}
 */
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
// we will get the form variable name "filter_text" coming from the my_articles.php
// since the archive.php will get the POST DATA of "filter_text" but
// not the my_articles.php
if ( isset( $_POST['filter_text'] ) ) {
	$_SESSION['filter_text'] = $_POST['filter_text'];
	header('location: ' . $_SERVER['HTTP_REFERER']); // send back the page to my_articles.php	
}
// same here for the form var "status"
if ( isset($_POST['status']) ) {
	$_SESSION['optstatus'] = $_POST['status'];
	header('location: ' . $_SERVER['HTTP_REFERER']);	
}
// also here for the form var "category"
if ( isset($_POST['category']) ) {
	$_SESSION['optcategory'] = $_POST['category'];
	header('location: ' . $_SERVER['HTTP_REFERER']);	
}
//print_r($_POST);
$checkitem = array();
if ( isset( $_POST['cid'])) {
	foreach( $_POST['cid'] as $idx => $value ) {
		$checkitem[] = $value;			
	}
}
$db = new database;



if ( isset($_POST['archive']) && isset( $_POST['cid'] )) {
	switch( $_POST['archive'] ) {
		case 'Archive':
			$_SESSION['task'] = 'archive';
			$set_archive = '1';
			break;
		case 'unarchive':	
			$_SESSION['task'] = 'unarchive';		
			$set_archive = '0';		
			break;
	}
}
if ( isset( $_SESSION['stageID'] ) ){
	switch( $_SESSION['stageID'] ) {
		case 1: // writing
		case 2:
			foreach( $checkitem as $idx => $value ) {
				$sql = " update articles set articles.isarchive=" . intval( $set_archive ) ;
				$sql .= " where articleID=" . intval( $value ); 	
				if (!($result = $db->query($sql))) {
					die('Error:'.$db->error() );
				}
			}
			break;
		
		case 3:
		case 4:
		case 5: // live stage
		case 6:
			foreach( $checkitem as $idx => $value ) {
				$sql = " update article_versions set isarchive=" . intval( $set_archive ) ;
				$sql .= " where articleID=" . intval( $value ); 	
				if (!($result = $db->query($sql))) {
					die('Error:'.$db->error() );
				}
			}
			break;
	}
}
header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
?>