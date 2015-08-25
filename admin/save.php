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
$categoryID 	= $_POST['category'];
$created 		= $_POST['created'];
$article_title 	= $_POST['title'];
$article_body 	= $_POST['elm1'];
$stage 			= $_POST['stage'];
$frontpage 		= $_POST['frontpage'];
$keywords 		= $_POST['keywords'];
$articletask 	= $_POST['articletask'];

if (trim($article_body) == "" ){
	echo '<script>alert("You need to enter a body of the article.");history.go(-1);</script>';
	$_SESSION['article_title'] = $article_title;
	exit;
}
unset($_SESSION['article_title']);
// print_r($_POST);
// print_r($_SESSION);
if( isset($_POST['imageID']) ){// is image checked??
	$article_images = $_POST['imageID'];
}
else{
	$article_images = 0;
}

$db = new database;




if (isset( $_SESSION['articleID'] )) {
	$articleID = $_SESSION['articleID'];
}
// if there is uploaded image, save it with the article
switch ( $_POST['task']) {
	case 'saveasdraft':
		$userID = $_SESSION['userID'];
		$created = time();
		$m = date( 'n', $created);
		$d = date( 'j', $created);
		$y = date( 'Y', $created);
		$sql = " insert into articles ( stageID, created, created_day, created_month, created_year, title, article_body) ";
		$sql .= " values( 1, $created, $d, $m, $y, '$article_title', '$article_body' )";
		//print 'add='.$sql ;					  
		$result = $db->query( $sql );
		// TODO : must use the accessor methods here later, not directly accessing the variable...
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
			
			// link the article to  the tasks.
			$sql = " insert into article_tasks ( articleID, taskID )";
			$sql .= " values( '$insertID', '$articletask' )";
			$db->query( $sql );
			
			// update the task status              
			$sql = "update tasks set status = 'In Progress' where taskID = '$articletask' ";
			$db->query( $sql );
			
			// if naay image then ...attach it to the article
			if (isset( $_SESSION['article_imgs'] )) {
				$photo = new stockphoto;
				$photo->addImageToArticle( $_SESSION['article_imgs'], $insertID );
			}
			
			if ( $result ) {
				$_SESSION['task'] = 'add';	
				$_SESSION['articleID'] = $insertID;
				$_SESSION['title'] = $article_title;
				$_SESSION['article_body'] = $article_body;
				$_SESSION['dateline'] = $dateline;
				$_SESSION['created'] = $created;
				// Log the activity
				$action = new activity;
				$action->track_activity( $userID, $action->saving_article, 'Saving the article '.$_SESSION['title'] );
				$gotoURL = "../admin/my_articles2.php";			
			}
		}
		break;
	case 'submit2editor':
		if  ( isset( $articletask ) ) {
			$currenttime = time();
			$sql = "select * from tasks where taskID = '$articletask' ";
			$db->query($sql);
			$gettask = array();
			while ($gettask[] =  $db->fetcharray());
			$duedate = $gettask[0]->enddate;
			if ( $db->getnumrows()>0 ) {
				if ( $currenttime > $duedate ) {
					echo '<script>alert("Sorry, the article is no longer accepted because you haven\'t met the deadline of this task which is ' . friendlydate5($duedate) . '.     If you really want to submit the article kindly contact the editor.");</script>';
					echo '<script>history.go(-1);</script>';
					exit;
				}
				else{
					$sql = "update tasks set status = 'Completed' where taskID = '$articletask' ";
					$db->query($sql);				
				}
			}
		}
		
		if ( isset($_SESSION['articleID']) ) {
			$created = $_SESSION['created'];
			$d = $_SESSION['created_day'];
			$m =  $_SESSION['created_month'];
			$y = $_SESSION['created_year'];
			$dateline = $_SESSION['dateline'];	
			$articleID = $_SESSION['articleID'];
			$sql = " select * from articles a";
			$sql .= " where a.articleID=" . intval($articleID);
			$db->query( $sql );
			$db->fetcharray();
			// Lets check first, if the article is already exists, if exist..lets update ok.
			if ($db->getnumrows() > 0 ){
				$sql = " update articles ";
				$sql .= " set articles.stageID = 2 , articles.status = '--' , ";
				$sql .= " articles.title = '$article_title' , ";
				$sql .= " articles.article_body = '$article_body' ";
				$sql .= " where articles.articleID=" . intval($articleID);
				$result = $db->query( $sql );
			}
			else { // otherwise, lets save the article to the database..no problem..
				$sql = " insert into articles ( stageID, status, created, created_day, created_month, created_year, title, article_body) ";
				$sql .= " values( 2, '--', $created, $created_day, $created_month, $created_year, '$article_title', '$article_body' )";
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
				$sql .= " article_versions.title= '$article_title' , ";
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
				$sql .= " values ( $articleID, 2, '--',  $created, $d, $m, $y, '$article_title', '$article_body' ) ";
				if (!($result = $db->query( $sql ))) {
					die ( 'Error:' . $db->error() );
				}
			}
		
		}
		else{ // submit automatic to editor...
			$created = time();
			$m = date( 'n', $created);
			$d = date( 'j', $created);
			$y = date( 'Y', $created);
			$categoryID 	= $_POST['category'];
			$article_title 	= $_POST['title'];
			$article_body 	= $_POST['elm1'];
			
			$sql = " insert into articles ( stageID, status, created, created_day, created_month, created_year, title, article_body) ";
			$sql .= " values( 2, '--', $created, $d, $m, $y, '$article_title', '$article_body' )";
			$result = $db->query( $sql );
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
				// add to article version.
				$sql = " insert into article_versions ( articleID, stageID, status, created, created_day, created_month, created_year, title, article_body )";
				$sql .= " values ( $insertID, 2, '--',  $created, $d, $m, $y, '$article_title', '$article_body' ) ";
				if (!($result = $db->query( $sql ))) {
					die ( 'Error:' . $db->error() );
				}
				if ( $result ) {
					$_SESSION['task'] = 'add';	
					$_SESSION['articleID'] = $insertID;
					$_SESSION['title'] = $article_title;
					$_SESSION['article_body'] = $article_body;
					$_SESSION['dateline'] = $dateline;
					$_SESSION['created'] = $created;
					// Log the activity
					$action = new activity;
					$action->track_activity( $userID, $action->saving_article, 'Saving the article '.$_SESSION['title'] );
					$gotoURL = "../admin/my_articles2.php";			
				}
			}
		}
		$_SESSION['task'] = 'submit';
		$_SESSION['title'] = $article_title;
		$_SESSION['to'] = 'News Editor';
		$gotoURL = "../admin/my_articles2.php";	
		break;
	case 'edit':
		// update the task status              
		$sql = "update tasks set status = 'In Progress' where taskID = '$articletask' ";
		$db->query( $sql );

		if (isset( $_SESSION['article_imgs'] )) {
			$photo = new stockphoto;
			$photo->addImageToArticle( $_SESSION['article_imgs'], $_SESSION['articleID'] );
		}

		switch( $_SESSION['stageID'] ){
			case 1:
				// this article belongs to news draft stage, but it is edited by the writer..
				// maybe he has left to put something on the article, right..
				$modified = time();
				$sql = " update articles ";
				$sql .= " set articles.stageID=" . $_SESSION['stageID'];
				$sql .= " , articles.title = '$article_title' ";
				$sql .= " , articles.modified = '$modified' , ";
				$sql .= " articles.status = '--' ";
				$sql .= " , articles.article_body = '$article_body' ";
				$sql .= " where articles.articleID=" . $_SESSION['articleID'];
				$result = $db->query( $sql );
				if ( $result ) {
					// Log the activity
					$action = new activity;
					$action->track_activity( $userID, $action->saving_article, 'Saving the article ' . $article_title );
					$_SESSION['task'] = 'edit';	
					$_SESSION['title'] = $article_title;
				}
				// if the writer decided to change the category of the article..
				// then lets update it ok..
				if ( $categoryID ) {
					$sql = " select * from article_category ac ";
					$sql .= " where ac.articleID=" . intval( $articleID );
					if (!($result = $db->query( $sql ))) {
						die ( 'Error:' . $db->error() );
					}
					$db->fetcharray();
					if ( $db->getNumrows() > 0 ) {
						$sql = " update article_category ";
						$sql .= " set categoryID= '$categoryID' ";
						$sql .= " where articleID=" . intval( $articleID );
						$result = $db->query( $sql );
					}
					else{
						$sql = " insert into article_category ( articleID , categoryID ) ";
						$sql .= " values( '$insertID' , '$categoryID' ) ";
						$result = $db->query( $sql );
					}
				}					
				$gotoURL = "../admin/my_articles2.php";	
				break;
			case 2:
			case 3:
				$stage = 2;
				$sql = "update articles ";
				$sql .= "set stageID= $stage, status = '--' ";
				$sql .= " where articleID=" . $_SESSION['articleID'];	
				$result = $db->query( $sql );
				
				$modified = time();
				$sql = " update article_versions ";
				$sql .= " set article_versions.stageID=" . $stage;
				$sql .= " , article_versions.title = '$article_title' ";
				$sql .= " , article_versions.article_body = '$article_body' ";
				$sql .= " , article_versions.modified = '$modified' ";
				$sql .= " , article_versions.status = '--' ";
				$sql .= " , article_versions.edited_by=" . $_SESSION['userID'];
				$sql .= " where article_versions.articleID=" . $_SESSION['articleID'];
				$result = $db->query( $sql );
				if ( $result ) {
					// Log the activity
					$action = new activity;
					$action->track_activity( $userID, $action->saving_article, 'Saving the article ' . $article_title );
					$_SESSION['task'] = 'edit';	
					$_SESSION['title'] = $article_title;
					$gotoURL = "../admin/view_article_versions.php?stageID=".$_SESSION[ 'stageID' ];
				}
				break;
			case 4:
			case 5:
			case 6:
			break;			
		}// END OF switch( $_SESSION['stageID'] ) 
		// if the writer decided to change the category of the article..
		// then lets update it ok..
		if ( $categoryID ) {
			$sql = " select * from article_category ac ";
			$sql .= " where ac.articleID=" . intval( $articleID );
			if (!($result = $db->query( $sql ))) {
				die ( 'Error:' . $db->error() );
			}
			$db->fetcharray();
			if ( $db->getNumrows() > 0 ) {
				$sql = " update article_category ";
				$sql .= " set categoryID= '$categoryID' ";
				$sql .= " where articleID=" . intval( $articleID );
				$result = $db->query( $sql );
			}
			else{
				$sql = " insert into article_category ( articleID , categoryID ) ";
				$sql .= " values( '$insertID' , '$categoryID' ) ";
				$result = $db->query( $sql );
			}
		}					
		break;
		case 'submit2newsdirector':
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
				$sql .= " , article_versions.title = '$article_title' ";
				$sql .= " , article_versions.article_body = '$article_body' ";
				$sql .= " , article_versions.modified = '$modified' ";
				$sql .= " where article_versions.articleID=" . intval($articleID);
				//echo $sql;
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
			$_SESSION['task'] = 'sent';
			$_SESSION['title'] = $article_title ;
			$_SESSION['to'] = 'News Director';
			$gotoURL =  " view_article_versions.php?stageID=3";
		break;
}

// continue here...my bitok is hungry,,eat sa ko...tara na eat tau may petsa-pie ako d2
// if the news editor set the article to the frontpage..then lets put it to the frontpage ok.
// Let check if this article has been set on the frontpage
//print_r($_POST);
if ( $frontpage ) {
	$sql = " select * from article_frontpage af ";
	$sql .= " where af.articleID =" . intval( $articleID );
	if (!($result = $db->query( $sql ))) {
		die ( 'Error:' . $db->error() );
	}
	$db->fetcharray();
	if ( $db->getNumrows() > 0 ) { // if found, lets update it..
		$sql = " update article_frontpage ";
		$sql .= " set frontpage_sectionID = " . intval( $frontpage );
		$sql .= " where articleID=" . intval( $articleID );
		if (!($result = $db->query( $sql ))) {
			die ( 'Error:' . $db->error() );
		}
	}
	else { // oh i like this **x story, lets put this on the frontpage ok :)
		$sql = " insert into article_frontpage ( articleID , frontpage_sectionID ) ";
		$sql .= " values( '$articleID', '$frontpage' ) ";
		if (!($result = $db->query( $sql ))) {
			die ( 'Error:' . $db->error() );
		}
	}
}

if ( $articletask ) {
	$sql = "select * from article_tasks where articleID = '$articleID' ";
	$db->query( $sql );
	if ( $db->getnumrows() > 0) {
		$sql = " update article_tasks ";
		$sql .= " set taskID = '$articletask' ";
		$sql .= " where articleID=" . intval( $articleID );
		$db->query( $sql );
	}
	else{
		$sql = " insert into article_tasks ( articleID, taskID )";
		$sql .= " values( '$articleID', '$articletask' )";
		$db->query( $sql );
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
$sql = " select * from article_imgs ai";
$sql .= " where ai.articleID=" . intval( $articleID );
$db->query( $sql );
$result = array();
while( $row = $db->fetcharray()) $imagesets[] = $row;
if ($db->getnumrows() > 0){
	for( $i=0; $i<count($imagesets); $i++ ){
		foreach( $imagesets as $field=>$value ){
			if( $field == 'articleID' ){			
				$sql = " update article_imgs ";
				$sql .= " set show_image='0' ";// reset show-image to 0 	
				$sql .= " where imageID=" . $imagesets[$i]->imageID;
				$sql .= " and articleID=" . intval( $articleID );
				$db->query( $sql );
			}	
		}	
	}	
}
// if images was set by the news editor ( nash nice smyle )
if ( $article_images ){
	if (is_array( $article_images )) {
		foreach( $article_images as $indx => $imgID ){
			$sql = " update article_imgs ";
			$sql .= " set show_image='1' ";
			$sql .= " where imageID=" . $imgID;
			$sql .= " and articleID=" . intval( $articleID );
			$db->query( $sql );
		}
	}
}
// after done saving,, jump to his parent page...
header( 'Location: ' . $gotoURL );

?>