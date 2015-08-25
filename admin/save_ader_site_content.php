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
$db = new database;



//print_r($_POST);
$id = $_SESSION['id'];
$title = $_POST['title'];
$body = $_POST['elm1'];
$status = $_POST['status'];
$category = $_POST['category'];
$ispublished = $_POST['ispublished'];
$created = time();
$author = $userID;
switch( $_POST['task'] ) {
	case 'update':
		$sql = " update other_site_content ";
		$sql .= " set title = '$title' , ";
		$sql .= " category = '$category' , ";
		$sql .= " body = '$body' ";
		$sql .= " where id = '$id' ";
		if (!($result = $db->query($sql))) {
			die('Error:'.$db->error() );
		}
		$_SESSION['task'] = 'edit';
		$_SESSION['title'] = $title;
		break;
	default:
		$sql = " insert into other_site_content ( title, body, status, created, author, category ) 
				values( '$title' , '$body' ,'$status', '$created', '$author' , '$category' ) ";
		if (!($result = $db->query($sql))) {
			die('Error:'.$db->error() );
		}
		$_SESSION['task'] = 'add';
		$_SESSION['title'] = $title;
		break;	
}

if ( $ispublished ) {
	$sql = " update other_site_content ";
	$sql .= " set status = 'Published'  ";
	$sql .= " where id = '$id' ";		
	if (!($result = $db->query($sql))) {
		die('Error:'.$db->error() );
	}
}
else {
	$sql = " update other_site_content ";
	$sql .= " set status = 'Unpublished'  ";
	$sql .= " where id = '$id' ";		
	if (!($result = $db->query($sql))) {
		die('Error:'.$db->error() );
	}
}
header('location: other_site_content.php');
?>