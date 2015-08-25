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



if ( isset( $_POST['cid']) ) { 
	$n = count( $_POST['cid'] );
	for( $i = 0; $i < $n; $i++ ){
		foreach( $_POST['cid'] as $key => $value ) {
			if ( $key == $i ) {
				$x = getArticle_category( $value );
				$catname = getCategory_info( $value, 'category_name' );
				if ( count($x) > 0 ) { // if this category contains an articles then,,,
					echo '<script>alert( "Sorry, you cannot delete the ' . $catname . ' category because it contains some articles. " );history.go(-1);</script>';
				}
				else{ // else lets f*** him!!!
					$sql = " delete from category where categoryID = '$value' ";
					$db->query( $sql );
					$_SESSION['catnames'][$i] = $catname;
					$_SESSION['task'] = 'delete';			
				}
			}
		}
	}
}
header( 'location: category_manager.php' );
?>