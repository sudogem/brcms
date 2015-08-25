<?php 
	include('coreclass.php');
	$response = $_POST['response'];		//the user response
	$topic_id = $_POST['topic_id'];		//the topic
	$response_date = date('Y-m-d');		//the date when the user responded
	
	//these codes are for debugging purpose only
	echo '<br>Date Today: '.$response_date;	
	echo '<br>Topic ID: '.$topic_id;
	echo '<br>User Response: '.$response;
	
	//define query string here
	$query = "INSERT INTO poll_data VALUES('', '$topic_id', '$response', '$response_date')";
	
	//instantiate new object of class database
	$con = new database();
	if(!$con->query($query)) {
		echo $con->error();
	}else {
		//this line is just temporary
		echo '<br><a href="display_poll.php">Back To Main</a>';
	}
?>