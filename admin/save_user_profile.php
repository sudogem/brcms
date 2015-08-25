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
$group = getGroup_name ( $usertypeID );
$db = new database;



//print_r($_SESSION);
$fullname 		= $_POST['name'];
$username 		= $_POST['username'];
$email 			= $_POST['email'];
$homeaddress 	= $_POST['homeaddress'];
$interests 		= $_POST['interests'];
$celno 			= $_POST['celno'];
$phoneno 		= $_POST['phoneno'];
$password 		= $_POST['password'];
$password2 		= $_POST['password2'];
$usertype 		= $_POST['usertype'];
$category 		= $_POST['category'];
$is_enabled		= $_POST['enabled'];

if ( isset($_POST['cancel']) ){
	switch( $group ){
		case 'Administrator':
			header( 'location: user_manager2.php' );
			exit();
			break;
		default:
			header('location: user_profile.php');
			exit();			
			break;	
	}
}

$mh = new validator();
if ( !$mh->validateEmail($email) ){ // TODO: changeme
	echo '<script>alert( "Please input a valid e-mail address." );window.history.go(-2);</script>';
	exit();
}
$registerDate 	= time();
// print_r($_POST);

// modify the user profile
if ( $_POST['task'] == 'edit' ){
	$sql = "select * from content_users where username = '$username' and userID !=" . $_SESSION['clickuserID'];
	$db->query( $sql );
	$db->fetcharray();
	if ( $db->getnumrows() > 0 ){
		echo '<script>alert("Username is already taken by someone, Please choose another username.");history.go(-2);</script>';
		exit;
	}
	$sql = "select * from content_users where email = '$email' and userID !=" . $_SESSION['clickuserID'];
	$db->query( $sql );
	$db->fetcharray();
	if ( $db->getnumrows() > 0 ){
		echo '<script>alert("This email is already registered. If you forgot the password click on Lost your Password and new password will be sent to you.");window.history.go(-2);</script>';	
		exit;	
	}	
	$sql = " update content_users ";
	$sql .= " set fullname = '$fullname' ,";
	if ( $username ) {
		$sql .= " username = '$username' ,";
	} 
	$sql .= " email = '$email' , ";
	$sql .= " homeaddress = '$homeaddress' , ";
	$sql .= " interest = '$interests' ,";
	if ( $is_enabled )	$sql .= " is_enabled = '$is_enabled' ,";
	$sql .= " celno = '$celno' , ";
	$sql .= " phoneno = '$phoneno' ";
	$sql .= " , usertypeID = '$usertype' ";		
	if ( $password != '' ) {
		$password = md5($password);
		$sql .= " , password = '$password' ";
	}
	if ( $usertype != "unchanged" ) {
		//$sql .= " , usertypeID = '$usertype' ";		
	}
	$sql .= " where userID=" . $_SESSION['clickuserID'];// userID of specific user
	// echo $sql;
	if (!($result = $db->query($sql))) {
		die('Error:'.$db->error() );
	}
	if ( $result ){
		if ( $password != "" ){
			// Log the activity
			$action = new activity;
			$action->track_activity( $userID, $action->changing_password, $username );
		}
		if ( $usertype != "unchanged" ){
			// Log the activity
			$action = new activity;
			$action->track_activity( $userID, $action->changing_group, $fullname . ' has changed '. 'from ' . $_SESSION['group_name'] . ' to ' . getGroup_name( $usertype ) );
		}
		
	}
	// code below is used for the administrator 
	if ( $usertype ) {
		$userID = $_SESSION['clickuserID'];
		$sql = " select * from user_stage us ";
		$sql .= " where us.userID=" . intval($userID);
		//$sql .= " and stageID = '$usertype'";
		$db->query( $sql );
		$db->fetcharray();
		if ( $db->getNumrows() > 0 ) {
			$userID = $_SESSION['clickuserID'];
			$sql = "select * from user_stage where userID='$userID' and stageID='$usertype'";
			$db->query($sql);
			if ($db->getnumrows()>0){
				$sql = " update user_stage ";
				if ( $_SESSION['group_name'] == 'Administrator' ) {
					$sql .= " set stageID = '6' ";			
				}
				else{
					$sql .= " set stageID = '$usertype' ";			
				}
				$sql .= " where userID='$userID' ";
				$db->query( $sql );
			}
			else{
				$sql = " insert into user_stage ( userID, stageID) ";	   
				$sql .= " values( $userID, '$usertype' )";
				if (!($result = $db->query( $sql ))){
					die ( 'Error:' . $db->error());
				}
			}
		}
		else{
			$userID = $_SESSION['clickuserID'];
			$sql = " insert into user_stage ( userID, stageID) ";	   
			$sql .= " values( $userID, '$usertype' )";
			if (!($result = $db->query( $sql ))){
				die ( 'Error:' . $db->error());
			}
		}
	}
	// Log the activity
	$action = new activity;
	$action->track_activity( $userID, $action->saving_user_profile, $username );
	
	if ( $category && $usertype == 3 ) {// if the user is an editor..
		$userID = $_SESSION['clickuserID'];
		$sql = "select * from content_editor where userID='$userID' ";
		$db->query($sql);
		if ($db->getnumrows()>0){
			$sql = " update content_editor ";
			$sql .= " set categoryID = '$category' ";
			$sql .= " where userID=" . $userID;
			if (!($result = $db->query( $sql ))){
				die ( 'Error:' . $db->error());
			}
		}
		else {
			$sql = " insert into content_editor values( '', '$userID', '$category' ) ";
			if (!($result = $db->query( $sql ))){
				die ( 'Error:' . $db->error());
			}
		}
	}
	$_SESSION['task'] = 'edit';
	$_SESSION['title'] = $fullname;
	// redirect back to the user profile of the user
	if ( $result && ($group != 'Administrator') ) {
		header( 'location: user_profile.php' );
	}
	else{ // back to the user manager
		header( 'location: user_manager2.php' );
	}
}
// add a new content users
if ( $_POST['task'] == 'add' ) {
	$sql = "select * from content_users where username = '$username' ";
	// echo $sql;
	$db->query( $sql );
	$db->fetcharray();
	if ( $db->getnumrows() > 0 ){
		echo '<script>alert("Username is already taken by someone, Please choose another username.");window.history.go(-1);</script>';		
	}
	$sql = "select * from content_users where email = '$email' ";
	$db->query( $sql );
	$db->fetcharray();
	if ( $db->getnumrows() > 0 ){
		echo '<script>alert("This email is already registered. If you forgot the password click on Lost your Password and new password will be sent to you.");window.history.go(-1);</script>';		
	}	
	else{
		$password = md5($password);
		$enabled = !$enabled;
		$sql = " insert into content_users ( username, password ,is_enabled, is_loggedin, 
				 usertypeID, fullname, homeaddress, interest, email, photo, celno, phoneno, registerDate, lastvisitDate )
				 values( '$username' , '$password', '$enabled' , '0', '$usertype' , '$fullname' , '$homeaddress' , '$interests' , 
				 '$email' , '' , '$celno' , '$phoneno' , $registerDate , '0')
			   ";
		
		if (!($result = $db->query( $sql ))){
			die ( 'Error:' . $db->error());
		}
		$insertID = $db->insertID; // use accessor methods here later..
		if ( $result ) {
			// Log the activity
			$action = new activity;
			$action->track_activity( $userID, $action->creating_user, $username );
		}
		if( $category != "" ) {
			$sql = "INSERT INTO content_editor VALUES('', $insertID, '$category')";
			if(!$db->query($sql)) {
				die("Error: ".$db->error());
			}
		}
		
		$sql = " select * from user_stage us ";
		$sql .= " where us.userID=" . $insertID;
		$db->query( $sql );
		$db->fetcharray();
		if ( $db->getNumrows() > 0 ) {
			$sql = " update user_stage ";
			$sql .= " set stageID = '$usertype' ";
			$sql .= " where userID=" . $insertID;
			$db->query( $sql );		
		}
		else {
			$sql = " insert into user_stage ( userID, stageID) ";	   
			$sql .= " values( $insertID, '$usertype' )";
			if (!($result = $db->query( $sql ))){
				die ( 'Error:' . $db->error());
			}
		}
		if ( $result ) {
			$_SESSION['task'] = 'add';
			$_SESSION['title'] = $fullname;
			header( 'location: user_manager2.php' );
		}
		
	}
}
?>