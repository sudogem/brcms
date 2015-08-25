<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
//global $db;
$auth = new user_authentication();
$db = new database;
//$database->connect('localhost', 'root', '', 'brcms', false );
if ( isset($_POST['submit']) ) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$auth->checkUserLogin( $username, $password, 'index.php', 'failed.php' );
}
if ( isset($_POST['cancel'])) {
	header('location: ../index.php');
}
?>