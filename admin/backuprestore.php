<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
session_start();
if ( !isset($_SESSION['login'])) {
	header('Location: login.php');
}
if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}

if ( isset( $_POST['backup'] ) ) {
	$time = time();
	$file = $time . '.sql'; 
	$backupfile = $backup_dir . $file;
	// load the database config vars.
	$mysql_command = "mysqldump  -h $dbservername -u $dbusername $databasename > $backupfile ";
	@set_time_limit( 1200 ); // increase maximum time execution..
	system( $mysql_command, $err );
	$_SESSION['task'] = 'backup';
	$_SESSION['title'] = $file;	
	header('location: backup_restore_database.php');exit;
}

if ( isset( $_POST['restore'] ) ) {
	// print_r($_POST);
	if ( isset( $_POST['cid'] ) ) {
		$item = $_POST['cid'][0];
		$time = time();
		$backupfile = $backup_dir . $item;
		// load the database config vars.
		$mysql_command = "mysql -h $dbservername -u $dbusername $databasename < $backupfile ";
		@set_time_limit( 1200 ); // increase maximum time execution..
		system( $mysql_command, $err );
		$_SESSION['task'] = 'restore';	
		$_SESSION['title'] = $item;
	}
	header('location: backup_restore_database.php');exit;
}

if ( isset( $_POST['delete'] ) ) {
	if ( isset( $_POST['cid'] ) ) {
		foreach( $_POST['cid'] as $id => $value ){
			unlink( $backup_dir.$value );// physically delete the file.
		}
	}
$_SESSION['task'] = 'delete';	
header('location: backup_restore_database.php');
}
?>