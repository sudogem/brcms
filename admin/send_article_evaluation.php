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

if ( isset($_POST['send']) ) {
	$db = new database;



	$articleID = $_SESSION['articleID'];
	//$title = $_SESSION['title'];
	$categoryname = $_SESSION['category_name'];
	$article_body = $_SESSION['article_body'];
	$created = $_SESSION['created'];
	$dateline = $_SESSION['dateline'];
	$editorID = $_SESSION['edited_by'];
	$stageID = $_SESSION['stageID'];
	$articlestageID = $_SESSION['articlestageID'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$date_msg_created = time();
	$writerID = getArticle_authors_info( $articleID, 'userID' );
	//print 'w='. $writerID;
	//print_r($_SESSION) ;
	// ok lets determine whether the article was approve or rejected..
	// this article was reject by the news-director..
	if ( $_SESSION['status'] == 'Reject' ) {
		$sql = " update article_versions ";
		$sql .= " set article_versions.status = 'rejected' , ";
		$sql .= " article_versions.stageID = 4 ";
		$sql .= " where article_versions.articleID=" . $articleID;
		if (!($result = $db->query( $sql ))) {
			die( 'Error:' .$db->error() );
		}
		
		$sql = " update articles ";
		$sql .= " set articles.stageID='4' , articles.status='rejected' ";
		$sql .= " where articles.articleID=" . intval($articleID);
		$result = $db->query( $sql );
	
		$receiverID = array($editorID, $writerID );
		$_SESSION['task'] = 'reject';
		$_SESSION['to'] = ' Writer ';		
		$msg = new messages();
		$msg->sendMessage (  $_SESSION['userID'], $receiverID, $date_msg_created, 'Unread', $subject, $message );
		header( 'Location: view_article_versions.php?stageID=' . $_SESSION['stageID'] );
	}
	
	// if this article was approve by the news director..
	// then lets set this article as approved
	if ( $_SESSION['status'] == 'Approve' ) {
		$sql = " update article_versions ";
		$sql .= " set article_versions.status = 'approved' , ";
		$sql .= " article_versions.stageID = 4 ";
		$sql .= " where article_versions.articleID=" . $articleID;
	
		if (!($result = $db->query( $sql ))) {
			die( 'Error:' .$db->error() );
		}
		// also we have to update the stage of the writers article so that 
		// he will know that his article is moving from diff. stages..
		$sql = " update articles ";
		$sql .= " set articles.stageID= 4 , articles.status='approved' ";
		$sql .= " where articles.articleID=" . intval($articleID);
		$result = $db->query( $sql );
	
		// then the news director will send a message to the people involved in creating the article
		$receiverID = array($editorID, $writerID );
		$_SESSION['task'] = 'approve';
		$_SESSION['to'] = ' Writer ';		
		$msg = new messages();
		$msg->sendMessage (  $_SESSION['userID'], $receiverID, $date_msg_created, 'Unread', $subject, $message );
		header( 'Location: view_article_versions.php?stageID=' . $_SESSION['stageID'] );
	}
	
	// a lists of comments were made by the news director..the article was set for revision
	if ( $_SESSION['status'] == 'Revise' ) {
		switch( $_SESSION['stageID'] ){
			case 1:
				$articlestageID = 1;
				break;
			case 2:
				$articlestageID = 1;			
				// send back the article to its previous stage where revisions were taken care of..
				$sql = " update article_versions ";
				$sql .= " set article_versions.status = 'revise' ";
				$sql .= " , article_versions.stageID = 2 ";
				//$sql .= " , article_versions.stageID = '-1' ";		
				$sql .= " where article_versions.articleID=" . intval($articleID);
				if (!($result = $db->query( $sql ))) {
					die( 'Error:' .$db->error() );
				}
				$sql = "update articles ";	
				$sql .= "set stageID = 2 , ";
				$sql .= " articles.status = 'revise' ";
				$sql .= " where articleID=" . intval($articleID);
				if (!($result = $db->query( $sql ))) {
					die( 'Error:' .$db->error() );
				}
				break;
			case 3:
				$articlestageID = 1;						
				// send back the article to its previous stage where revisions were taken care of..
				$sql = " update article_versions ";
				$sql .= " set article_versions.status = 'revise' ";
				$sql .= " , article_versions.stageID = 2";
				//$sql .= " , article_versions.stageID = '-1' ";		
				$sql .= " where article_versions.articleID=" . intval($articleID);
				if (!($result = $db->query( $sql ))) {
					die( 'Error:' .$db->error() );
				}
				
				$sql = "update articles ";	
				$sql .= " set stageID = 2 , ";
				$sql .= " articles.status = 'revise' ";
				$sql .= " where articleID=" . intval($articleID);
				if (!($result = $db->query( $sql ))) {
					die( 'Error:' .$db->error() );
				}
				$_SESSION['to'] = ' Writer ';
				break;
			case 4:
				$articlestageID = 3;						
				// send back the article to its previous stage where revisions were taken care of..
				$sql = " update article_versions ";
				$sql .= " set article_versions.status = 'revise' ";
				$sql .= " , article_versions.stageID = 3";
				//$sql .= " , article_versions.stageID = '-1' ";		
				$sql .= " where article_versions.articleID=" . intval($articleID);
				if (!($result = $db->query( $sql ))) {
					die( 'Error:' .$db->error() );
				}
				
				$sql = "update articles ";	
				//$sql .= "set stageID = 1 , ";
				$sql .= " set articles.status = 'revise' ";
				$sql .= " where articleID=" . intval($articleID);
				if (!($result = $db->query( $sql ))) {
					die( 'Error:' .$db->error() );
				}
				$_SESSION['to'] = ' Editor ';
				break;
				
		}
		$receiverID = array($editorID, $writerID );
		$_SESSION['task'] = 'return';
		$msg = new messages();
		$msg->sendMessage (  $_SESSION['userID'], $receiverID, $date_msg_created, 'Unread', $subject, $message );
		header( 'Location: view_article_versions.php?stageID=' . $_SESSION['stageID'] );
	}
}

// if cancel is press, redirect back to the list of article versions..
if ( isset( $_POST['cancel'] )) {
	if ( isset($_SESSION['stageID']) ){
		switch( $_SESSION['stageID'] ) {
			case 1:
				break;
			case 2:  
			case 3:		
			case 4:
				header( 'Location: view_article_versions.php?stageID=' . $_SESSION['stageID'] );
				exit();
				break;
		}
	}
}

?>