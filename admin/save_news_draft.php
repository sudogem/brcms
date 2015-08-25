<?php
include( 'configuration.php' );
require ( '../admin/coreclass.php' );

session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: ../admin/login.php');
}

if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}

$categoryID = $_POST['category'];
$created = $_POST['created'];
$dateline = $_POST['dateline'];
$article_title = $_POST['title'];
$article_body = $_POST['editor_content'];
$stage = $_POST['stage'];

$db = new database;




//print 'post=';
print_r($_POST);

$userID = $_SESSION['userID'];
$created = time();
$dateline = time();
$sql = " insert into articles ( stageID, created, dateline, title, article_body) ";
$sql .= " values( $stage, $created, $dateline, '$article_title', '$article_body' )";
//print 'add='.$sql ;					  
$result = $db->query( $sql );
if ( $result ) {
	$_SESSION['task'] = 'add';	
	$_SESSION['title'] = $article_title;
}
// yknow waht, i like this girl the way she smile,, :)	
// TODO : must use the accessor methods here later, but not 
// directly accessing the variable..ex. $db->getInsertID().. 
$insertID = $db->insertID; 
if ( $insertID ) { // now lets insert the article with corresponding author
	$sql = " insert into article_author ( articleID , userID ) ";
	$sql .= " values( '$insertID' , '$userID') ";
	$result = $db->query( $sql );
	// after saving the article with the author..then
	// lets save this article to the his corresponding category :)
	$sql = " insert into article_category ( articleID , categoryID ) ";
	$sql .= " values( '$insertID' , '$categoryID' ) ";
	$result = $db->query( $sql );
	if ( $result ) {
		$gotoURL = "../admin/my_articles2.php";
	}
}
	
?>