<?php
include( 'configuration.php' );
	include('coreclass.php');
	include('../autoresponder/responder.php');

	$segmentTitle		= $_POST['segmentTitle'];		#the title of the segment
	$segmentTopic		= $_POST['segmentTopic'];				#the topic being tockled on the segment
	$segmentAnchor 		= $_POST['segmentAnchor'];		#the anchorman of the segment
	$segmentSchedule 	= $_POST['segmentSchedule'];	#the schedule of the segment on air
	$segmentContent 	= $_POST['elm1'];				#the content of the segment	
	$segmentDate 		= $_POST['segmentDate'];		#the date when the segment was written
	$articletask 		= $_POST['articletask'];	
	
	$db = new database;



	// update the task status              
	$sql = "update tasks set status = 'Completed' where taskID = '$articletask' ";
	$db->query( $sql );
	save_segment( $segmentTitle, $segmentTopic, $segmentAnchor, $segmentSchedule, $segmentContent, $segmentDate );
	header('Location: add_segments.php');
?>