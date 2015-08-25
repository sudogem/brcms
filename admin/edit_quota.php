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
if ( isset($_SESSION['message']) ){
	$message = $_SESSION['message'];
	unset($_SESSION['message']);
}
$quotaID = $_GET['quotaID'];
$_SESSION['quotaID'] = $quotaID;
$db = new database;



$sql = " select * from quota where quotaID='$quotaID' ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$quota = array();
if ( $quota[] = $db->fetcharray() );
$db->freeresult();
$myquota = $quota[0]->quota;
if ( $quota[0]->isdefault ) {
	$optyesno .= '<input name="isdefault" type="radio" value="1" checked>Yes';
	$optyesno .= '<input name="isdefault" type="radio" value="0" >No';
}
else{
	$optyesno .= '<input name="isdefault" type="radio" value="1" >Yes';
	$optyesno .= '<input name="isdefault" type="radio" value="0" checked >No';
}
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->creating_category, '-' );
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/edit_quota.tpl.php' );
$tags = array(
	'{QUOTA}' 			=> $myquota ,
	'{YESNO}'			=> $optyesno,
	'{SITENAME}' 		=> 'CMS Adminss',
	'{TOPNAV}' 			=> 'top_menu.php',
	'{FOOTER}' 			=> 'footer.php' 
);
$tpl->parse_template( $tags );
print $tpl->display();
?>