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




$articleID = $_SESSION['articleID'];
$title = $_SESSION['title'];
$article_body = $_SESSION['article_body'];
$created = $_SESSION['created'];
$dateline = $_SESSION['dateline'];

// override the variables
if ( $_POST['title'] ) {
	$frontpage 		= $_POST['frontpage'];
	$title 			= $_POST['title'];
	$article_body 	= $_POST['article_body'];
	$created 		= $_POST['created'];
	$keywords		= $_POST['keywords'];
	$categoryID 	= $_POST['category'];
}
$frontpage 		= $_POST['frontpage'];	
// echo $_SESSION['articleID'];
// echo $articleID ;
// print_r($_POST);
//print_r($_SESSION);


// Now the article has been passed to stage 3 in which the newsdirector will review it :)
$sql = " update articles ";
$sql .= " set articles.stageID='3' , ";
$sql .= " articles.status='edited' ";
$sql .= " where articles.articleID=" . intval($articleID);
if (!($result = $db->query( $sql ))) {
	die ( 'Error:' . $db->error() );
}

$sql = " select * from article_versions av ";
$sql .= " where av.articleID=" . intval($articleID);
// print $sql;
$db->query( $sql );
$db->fetcharray();
if ( $db->getNumrows() > 0 ) {
	$sql = " update article_versions ";
	$sql .= " set article_versions.stageID= '3' , ";
	$sql .= " article_versions.edited_by= $userID , ";
	$sql .= " article_versions.status='edited' ";
	$sql .= " where article_versions.articleID=" . intval($articleID);
	if (!($result = $db->query( $sql ))) {
		die ( 'Error:' . $db->error() );
	}
}
else{
	$sql = " insert into article_versions ( articleID, stageID, status, created, dateline, title, article_body, edited_by )";
	$sql .= " values ( '$articleID', '3' , 'edited', $created, $dateline, '$title', '$article_body' , '$userID') ";
	if (!($result = $db->query( $sql ))) {
		die ( 'Error:' . $db->error() );
	}
}
//print_r($_POST);
if( isset($_POST['imageID']) ){// is image checked??
	$article_images = $_POST['imageID'];
	if ( $article_images == -1 ){
		$sql = " select * from article_imgs ai";
		$sql .= " where ai.articleID=" . intval( $articleID );
		$db->query( $sql );
		$result = array();
		while( $row = $db->fetcharray()) $imagesets[] = $row;
		$photo = new stockphoto;
		$photo->notshowArticle_image( $imagesets, $articleID );
	}
	if ( $article_images ) {
		$photo = new stockphoto;
		$photo->showArticle_image( $article_images, $articleID );
	}
}

// if keywords was set by the editor
if( $keywords ){
	$sql = " select * from article_keywords ak ";
	$sql .= " where ak.articleID=" . intval( $articleID );
	$db->query( $sql );
	if ( $db->getnumrows() > 0) {
		$sql = " update article_keywords ";
		$sql .= " set keywords= '$keywords' ";
		$sql .= " where articleID=" . intval( $articleID );
		$db->query( $sql );
	}
	else{
		$sql = " insert into article_keywords ( articleID, keywords )";
		$sql .= " values( '$articleID', '$keywords' )";
		$db->query( $sql );
	}
}

if ( $frontpage ) {
	// Let check if this article has been set on the frontpage
	$sql = " select * from article_frontpage af ";
	$sql .= " where af.articleID =" . intval( $articleID );
	if (!($result = $db->query( $sql ))) {
		die ( 'Error:' . $db->error() );
	}
	$db->fetcharray();
	if ( $db->getNumrows() > 0 ) { // if found, just leave it.. 
	}
	else { // oh i like this ***story, lets put this on the frontpage ok :)
		$sql = " insert into article_frontpage ( articleID , frontpage_sectionID ) ";
		$sql .= " values( '$articleID', '$frontpage' ) ";
		//echo $sql;
		if (!($result = $db->query( $sql ))) {
			die ( 'Error:' . $db->error() );
		}
	}
}
$_SESSION['task'] = 'sent';
$_SESSION['title'] = $title ;
$_SESSION['to'] = 'News Director';
header( 'Location: view_article_versions.php?stageID=3' );
//header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
?>