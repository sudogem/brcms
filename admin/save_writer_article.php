<?php 
include( 'configuration.php' );
	//This script is for saving updates to
	//the database.
	session_start();	
	include('../admin/db_fns.php');
	
	//$articleID = $_POST['articleID'];
	//$userID = $_POST['userID'];
	$categoryID = $_POST['category'];
	$stageID = $_POST['stageID'];
	$created = $_POST['created'];
	$dateline = $_POST['dateline'];
	$article_title = $_POST['title'];
	$article_body = $_POST['editor_content'];
	
//print_r ($_POST);
	$userID = $_SESSION['userID'];
	
	//$created = date("F d, Y h:i:s A");
	$created = time();

	$query = " insert into articles ( stageID, created, dateline, title, article_body) ";
	$query .= " values( '$stageID', $created, '$dateline', '$article_title', '$article_body' )";
print $query ;					  
	$db = new database;




	$result = $db->query( $query );
	if ( $result ) {
		// ok ..
	} else { 
		print $db->error();
	}
//	cge nash, a2 kuhaon ang id sa bag-o nga na-insert nga record ha.. 
//	TODO: must use the accessor methods here, but not 
//	directly accessing the variable..ex. $db->getInsertID()
	$insertID = $db->insertID; 
	if ( $insertID ) { // now lets insert the article with corresponding author
		$query = " insert into article_author ( articleID , userID ) ";
		$query .= " values( '$insertID' , '$userID') ";
		$result = $db->query( $query );
		
		$query = " insert into article_category ( articleID , categoryID ) ";
		$query .= " values( '$insertID' , '$categoryID' ) ";
		$result = $db->query( $query );
		
	}
	if ( $result ) {
		
		//$_SESSION['task'] = 'save';
		//header( 'Location: ../admin/my_articles2.php' );
	}
?>