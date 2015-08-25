<?php
include( 'configuration.php' );
include('coreclass.php');
//include('create_graphs.php');
if ( isset($_POST['submit'])) {
	$db = new database;



	$label = $_POST['label'];
	$topicid = $_POST['topicid'];
	$response_date = date('Y-m-d');	
	$sql = "INSERT INTO poll_data VALUES('', '$topicid', '$label', '$response_date')";
	$db->query( $sql );
	//header('Location: index.php');
	echo '<script>alert("Thanks for your vote."); window.history.go(-1);</script>';
}
?>