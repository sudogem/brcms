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
if ( isset($_POST['cancel']) ) {
	header('location: clients_manager.php');
	exit();
}

if ( isset($_POST['save'])) {
	$clientname = $_POST['clientname'];
	$contactname = $_POST['contactname'];
	$username = $_POST['username2'];
	$password = $_POST['password'];
	//$password2 = $_POST['password2'];
	$emailadd = $_POST['email'];
	$phoneno = $_POST['phoneno'];
	$faxno = $_POST['faxno'];
	$extrainfo = $_POST['extrainfo'];
	$registerDate = $_SESSION['registerDate'];
	$address = $_POST['address'];
	$status = $_POST['status'];
	$website = $_POST['website'];
}
if ( isset($_SESSION['clientID']) ){
	$clientID = $_SESSION['clientID'];
	$_SESSION['clientname'] = $clientname;
	$_SESSION['contactname'] = $contactname;
	$_SESSION['username2'] = $username;
	$_SESSION['emailadd'] = $emailadd;
	$_SESSION['phoneno'] = $phoneno;
	$_SESSION['faxno'] = $faxno;
	$_SESSION['extrainfo'] = $extrainfo;
	$_SESSION['address'] = $address ;
	$_SESSION['status'] = $status ;
}
$db = new database;



$mh = new validator();
if ( !$mh->validateEmail($emailadd) ){ // TODO: changeme
	echo '<script>alert( "Please input a valid e-mail address." );history.go(-1);</script>';
	exit();
}

if ( isset($_POST['task'])) {
	switch($_POST['task']) {
		case 'add':
			$sql = "";
			break;
		case 'edit':	
			$sql = "select * from corporate_partners where username = '$username' and clientID !=" . $_SESSION['clickclientID'];
			$db->query( $sql );
			$db->fetcharray();
			if ( $db->getnumrows() > 0 ){
				echo '<script>alert("Username is already taken by someone, Please choose another username.");history.go(-2);</script>';
				exit;
			}
			$sql = "select * from corporate_partners where emailadd = '$emailadd' and clientID !=" . $_SESSION['clickclientID'];
			$db->query( $sql );
			$db->fetcharray();
			if ( $db->getnumrows() > 0 ){
				echo '<script>alert("This email is already registered. If you forgot the password click on Lost your Password and new password will be sent to you.");window.history.go(-2);</script>';	
				exit;	
			}	
			break;
	}
}
/*if ( $password != $password2 ) {
	$_SESSION['message'] = 'The passwords you entered did not match.';
	header( 'location: ' . $_SERVER['HTTP_REFERER']);
	exit();
}*/
//print_r($_POST);
$sql = " select * from corporate_partners cp ";
$sql .= " where cp.clientID=" . intval( $clientID );
if (!($result = $db->query( $sql ))){
	die ( 'Error:' . $db->error());
}
$db->fetcharray();
if ( $db->getNumRows() > 0 ) {
	$sql = " update corporate_partners ";
	$sql .= " set clientname = '$clientname' , ";
	$sql .= " contactname = '$contactname', ";
	$sql .= " username = '$username', ";	
	if ( $password != '' ) {
	$sql .= " password = '$password', ";
	}
	$sql .= " address = '$address', ";
	$sql .= " phoneno = '$phoneno', ";
	$sql .= " faxno = '$faxno', ";
	$sql .= " emailadd = '$emailadd', ";
	$sql .= " status = '$status', ";
	$sql .= " website = '$website' , ";
	$sql .= " extrainfo = '$extrainfo' ";
	$sql .= " where clientID = '$clientID' ";
	$_SESSION['task'] = 'edit';	
	$_SESSION['title'] = $clientname;
}
else {
	$registerDate = time();
	$sql = " insert into corporate_partners ( clientname , contactname, username, password, address, phoneno, faxno, emailadd, website, status, registerDate, extrainfo)
			 values( '$clientname' , '$contactname', '$username', '$password', '$address', '$phoneno', '$faxno', '$emailadd', '$website', '$status', '$registerDate' , '$extrainfo' )
		   ";
	$_SESSION['task'] = 'add';	
	$_SESSION['title'] = $clientname;
}
if (!($result = $db->query( $sql ))){
	die ( 'Error:' . $db->error());
}

if ( $result ) {
	// Log the activity
	$action = new activity;
	$action->track_activity( $userID, $action->saving_client_profile, 'Saving client profile ' . $clientname );
	header( 'location: clients_manager.php' );
}
?>