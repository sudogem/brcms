<?php
include( 'configuration.php' );
require( 'coreclass.php' );
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




$fullname = $_POST['fullname'];
$username = $_POST['username'];
$email = $_POST['email'];
$homeaddress = $_POST['homeaddress'];
$interests = $_POST['interests'];
$celno = $_POST['celno'];
$phoneno = $_POST['phoneno'];
$newpassword = $_POST['password'];
$verifypassword = $_POST['verifypassword'];
$group = $_POST['group'];
$enabled = $_POST['enabled'];
$registerDate = time();

//print_r($_POST);

$sql = " insert into content_users ( username, password ,is_enabled, is_loggedin, 
         usertypeID, fullname, homeaddress, interest, email, photo, celno, phoneno, registerDate, lastvisitDate )
	     values( '$username' , '$newpassword', '$enabled' , '0', '$group' , '$fullname' , '$homeaddress' , '$interests' , 
		 '$email' , '' , '$celno' , '$phoneno' , '$registerDate' , '0')
	   ";

if (!($result = $db->query( $sql ))){
	die ( 'Error:' . $db->error());
}
	   
if ( $result ){
	header( 'location: user_manager2.php' );
}

//REDIRECT BACK to user manager
?>