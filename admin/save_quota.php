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



//print_r($_POST);

$quotaID = $_POST['cid'][0];
if ( isset($_SESSION['quotaID'] ) ) {
	$quotaID = $_SESSION['quotaID'];// override quotaID values...
	unset($_SESSION['quotaID']); // remove pre-existing session..for clean-up purposes
}
$quota = $_POST['quota'];
$default = $_POST['isdefault'];

if ( isset($_POST['cancel']) ) {
	header( 'Location: quota.php' );
	exit();
}
else {
	switch( $_POST['task'] ) {
		case 'add':
			if ( $default ) {
				$sql = "update quota set isdefault=0 ";
				$db->query( $sql );
			}
			$sql = "insert into quota values('', '$quota', '$default' )";
			if (!($result = $db->query($sql))) {
				die('Error:'.$db->error() );
			}
			$_SESSION['title'] = $quota;
			$_SESSION['task'] = 'add';
			break;
		case 'edit':
			$sql = "update quota set quota ='$quota' where quotaID = '$quotaID' ";		
			if (!($result = $db->query($sql))) {
				die('Error:'.$db->error() );
			}
			break;	
		case 'default':
			$sql = "update quota set isdefault=0";
			if (!($result = $db->query($sql))) {
				die('Error:'.$db->error() );
			}
			$sql = "update quota set isdefault=1 where quotaID = '$quotaID' ";
			if (!($result = $db->query($sql))) {
				die('Error:'.$db->error() );
			}
			break;	
		case 'delete':	
			$sql = "delete from quota where quotaID = '$quotaID' ";
			if (!($result = $db->query($sql))) {
				die('Error:'.$db->error() );
			}
			$_SESSION['task'] = 'delete';
			break;		
	}
}
header( 'location: quota.php' );
?>