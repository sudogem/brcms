<?php 
	include('create_graphs.php');
	$topic_id = $_REQUEST['topic_id'];
	create_poll_graph($topic_id);
?>