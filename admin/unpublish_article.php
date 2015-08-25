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



$clickeditem = true;
$checkitem = array();
if ( isset( $_POST['cid'])) {
	$clickeditem = false;
	foreach( $_POST['cid'] as $idx => $value ) {
		$checkitem[] = $value;			
	}
}
$date_published = time();
$m = date( 'n', $date_published);
$d = date( 'j', $date_published);
$y = date( 'Y', $date_published);
if ( $clickeditem ) {
		// if this article was publish by the publisher, set the article status as PUBLISHED
		$sql = " update articles ";
		$sql .= " set articles.stageID='6' , status = 'killed' , ";
		$sql .= " dateline= '$date_published' ,";
		$sql .= " published_day = '$d' ,";
		$sql .= " published_month = '$m' ,";
		$sql .= " published_year = '$y' ";
		$sql .= " where articles.articleID=" . $_SESSION['articleID'];
		if (!($result = $db->query( $sql ))) {
			die( 'Error:' .$db->error() );
		}
		// Also we have to update on the article versions...
		$sql = " update article_versions ";
		$sql .= " set article_versions.stageID = '6' , ";
		$sql .= " status = 'killed' ,";	
		$sql .= " dateline= '$date_published' ,";
		$sql .= " published_day = '$d' ,";
		$sql .= " published_month = '$m' ,";
		$sql .= " published_year = '$y' ";
		$sql .= " where article_versions.articleID=" . $_SESSION['articleID'];
		if (!($result = $db->query( $sql ))) {
			die( 'Error:' .$db->error() );
		}
		$receiverID = array($editorID, $writerID , $newsdirectorID );
		$msg = new messages();
		$title = $_SESSION['title'];
		$_SESSION['task'] = 'unpublish';
		$_SESSION['title'] = $title;
		$subject = " UNPUBLISHED : " . $_SESSION['title'];
		$message = " The article was successfully unpublished. Thanks =) ";
		$msg->sendMessage (  $_SESSION['userID'], $receiverID, $date_msg_created, 0, $subject, $message );
}
else{
	foreach( $checkitem as $idx => $value ) {
		// if this article was publish by the publisher, set the article status as PUBLISHED
		$sql = " update articles ";
		$sql .= " set articles.stageID='6' , status='killed' , ";
		$sql .= " dateline= '$date_published' ,";
		$sql .= " published_day = '$d' ,";
		$sql .= " published_month = '$m' ,";
		$sql .= " published_year = '$y' ";
		$sql .= " where articles.articleID=" . $value;
		$result = $db->query( $sql );
		if (!($result = $db->query( $sql ))) {
			die( 'Error:' .$db->error() );
		}
		// Also we have to update on the article versions...
		$sql = " update article_versions ";
		$sql .= " set article_versions.stageID = '6' , status = 'killed' , ";
		$sql .= " dateline= '$date_published' ,";
		$sql .= " published_day = '$d' ,";
		$sql .= " published_month = '$m' ,";
		$sql .= " published_year = '$y' ";
		$sql .= " where article_versions.articleID=" . $value;
		if (!($result = $db->query( $sql ))) {
			die( 'Error:' .$db->error() );
		}
		
		$receiverID = array($editorID, $writerID , $newsdirectorID );
		$msg = new messages();
		$title = $_SESSION['title'];
		$_SESSION['task'] = 'unpublish';
		$_SESSION['title'] = $title;
		$subject = " UNPUBLISHED : " . $_SESSION['title'];
		$message = " The article was successfully unpublished. Thanks =) ";
		$msg->sendMessage (  $_SESSION['userID'], $receiverID, $date_msg_created, 0, $subject, $message );
	}
}
header( 'Location: view_article_versions.php?stageID=5' );
?>