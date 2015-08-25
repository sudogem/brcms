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
$title = addslashes ( $_SESSION['title'] );
$article_body = addslashes ( $_SESSION['article_body'] );
$created = $_SESSION['created'];
$d = $_SESSION['created_day'];
$m =  $_SESSION['created_month'];
$y = $_SESSION['created_year'];
$dateline = $_SESSION['dateline'];
//$edited_by = $_SESSION['userID']; // MYSTERY BUG HERE...
//$edited_by = 0;
$stageID = $_SESSION['stageID'];
//print_r($_POST);
// print_r($_SESSION);

$sql = "select * from article_tasks where articleID = '$articleID' ";
$db->query($sql);
while( $articletask[] = $db->fetcharray());
if ( $db->getnumrows() > 0 ) {
	$articletaskID = $articletask[0]->taskID;
	/* check if the article met the deadline */                                     
	$currenttime = time();
	$sql = "select * from tasks where taskID = '$articletaskID' ";
	$db->query($sql);
	if ( $db->getnumrows() > 0 ) {
		$gettask = array();
		while ($gettask[] =  $db->fetcharray());
		$duedate = $gettask[0]->enddate;
		if ( $currenttime > $duedate ) {
			echo '<script>alert("Sorry, the article is no longer accepted because you haven\'t met the deadline of this task which is ' . friendlydate5($duedate) . '.     If you really want to submit the article kindly contact the editor.");</script>';
			echo '<script>history.go(-1);</script>';
			exit;
		}
		else{
			$sql = "update tasks set status = 'Completed' where taskID = '$articletaskID' ";
			$db->query($sql);				
		}
	}
}


$sql = " select * from articles a";
$sql .= " where a.articleID=" . intval($articleID);
$db->query( $sql );
$db->fetcharray();
// Lets check first, if the article is already exists, if exist..lets update ok.
if ($db->getnumrows() > 0 ){
	$sql = " update articles ";
	$sql .= " set articles.stageID = 2 , articles.status = '--' , ";
	$sql .= " articles.title = '$title' , ";
	$sql .= " articles.article_body = '$article_body' ";
	$sql .= " where articles.articleID=" . intval($articleID);
	$result = $db->query( $sql );
}
else { // otherwise, lets save the article to the database..no problem..
	$sql = " insert into articles ( stageID, status, created, created_day, created_month, created_year, title, article_body) ";
	$sql .= " values( $stage, '--', $created, $created_day, $created_month, $created_year, '$article_title', '$article_body' )";
	$result = $db->query( $sql );
}
// Again, let's also check in the article versions if it exists..
$sql = " select * from article_versions av ";
$sql .= " where av.articleID=" . intval($articleID);
$db->query( $sql );
$db->fetcharray();
if ( $db->getNumrows() > 0 ) { // yes weve found it,,then lets just update it ok
	$sql = " update article_versions ";
	$sql .= " set article_versions.stageID= '2' , ";
	$sql .= " article_versions.title= '$title' , ";
	$sql .= " article_versions.edited_by = " . intval( $userID );
	$sql .= " , article_versions.article_body = '$article_body' , ";
	$sql .= " article_versions.created= '$created' , ";
	$sql .= " article_versions.status = '--' ";
	$sql .= " where article_versions.articleID=" . intval($articleID);
	if (!($result = $db->query( $sql ))) {
		die ( 'Error:' . $db->error() );
	}
}
else{ // else, we hav to make a separate copy frm the original article..
	$sql = " insert into article_versions ( articleID, stageID, status, created, created_day, created_month, created_year, title, article_body )";
	$sql .= " values ( $articleID, 2, '--',  $created, $d, $m, $y, '$title', '$article_body' ) ";
	if (!($result = $db->query( $sql ))) {
		die ( 'Error:' . $db->error() );
	}
}
$_SESSION['task'] = 'submit';
$_SESSION['title'] = $article_title;
$_SESSION['to'] = 'News Editor';
header( 'Location: ../admin/my_articles2.php' );
?>