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
//print_r($_POST);
$db = new database;



if ( isset( $_POST['cid']) ) { 
	$n = count( $_POST['cid'] );
	for( $i = 0; $i < $n; $i++ ){
		foreach( $_POST['cid'] as $key => $value ) {
			$sql = " delete from tasks ";
			$sql .= " where taskID =" . intval( $value );
			$db->query($sql);
			$_SESSION['task'] = 'delete';				
		}
	}
}
header( 'location: task_manager.php' );
?>