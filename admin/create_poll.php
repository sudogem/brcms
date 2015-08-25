<?php 
include( 'configuration.php' );
	include('coreclass.php');
	session_start();
	
	//get post data here
	$topic = $_POST['topic'];				#the topic inserted by the user
	$response_label = $_POST['label'];		#the responses label
	$from_date = date("Y-m-d", mktime(0,0,0, $_POST['from_month'], $_POST['from_date'], $_POST['from_year']));			#the date when the topic was created	
	$expiry_date = date("Y-m-d", mktime(0,0,0, $_POST['expiry_month'], $_POST['expiry_date'], $_POST['expiry_year']));	#the date when the topic will expire

	//define a query string to perform insert to the database
	$query = "INSERT INTO poll_topic VALUES('', '$topic', '$response_label', '$from_date', '$expiry_date')";	

	//instantiate new object of class database here
	$con = new database();
	
	//method of class database used to perform query on the database
	if(!$con->query($query)) {
		echo 'Error: '.$con.error();
	} else {
		#echo "A new Topic was successfully created with the following details:";
		#echo '<br>Topic: '.$topic;
		#echo '<br>Label: '.$response_label;
		#echo '<br>From: '.date("Y-m-d",mktime(0,0,0, $_POST['from_month'], $_POST['from_date'], $_POST['from_year']));
		#echo '<br>To: '.date("Y-m-d",mktime(0,0,0, $_POST['expiry_month'], $_POST['expiry_date'], $_POST['expiry_year']));
		
		$_SESSION['task'] = 'add';
		header('Location: list_poll_survey.php');
		
		//this line is for debugging only
		#echo '<br><a href="display_poll.php">Click Here to View Poll</a>';
		#echo ' | <a href="display_poll.php">Click Here to Add Another Poll</a>';
		#echo
	}
?>