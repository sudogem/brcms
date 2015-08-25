<?php
require ( '../admin/coreclass.php' );
session_start();
$db = new database;



if ( isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql = " select * from corporate_partners ";
	$sql .= " where username= '$username'" ;
	$sql .= " and password = '$password' ";
	//$sql .= " and status = '1' ";
	$db->query( $sql );
	while ($result[] = $db->fetcharray());
	if ( $db->getNumRows() > 0 ) { // the userlogin is found..saved his userdata.
		if ( $result[0]->status > 0 ) {
			$_SESSION['login'] = true;
			$_SESSION['username'] = $result[0]->username;
			$_SESSION['clientID'] = $result[0]->clientID;
			$_SESSION['clientname'] = $result[0]->clientname;
			header( 'Location: client_window.php' );	
		}
		else{
			echo '<script>alert("Sorry, this account was blocked by the administrator. Please contact the administrator to enable the account. Thanks.");history.go(-1);</script>';
			session_unset();
			session_destroy();
			exit;
		}
	}
	else{
		echo '<script>alert("Incorrect username or password. Please try again.");history.go(-1);</script>';
		session_unset();
		session_destroy();
		exit;
	}
}

?>