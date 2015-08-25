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
//print_r($_POST);
$taskID = $_SESSION['taskID'];
$subject = $_POST['subject'];
$description = $_POST['description'];
$startdate = $_POST['smonth'] . $_POST['sday'] . ',' . $_POST['syear'] . ' ' . $_POST['stime'];
$startdate = strtotime( $startdate );
$enddate = $_POST['emonth'] . $_POST['eday'] . ',' . $_POST['eyear'] . ' ' . $_POST['etime'];
$enddate = strtotime( $enddate );
$created = simpledate(time());
$created_t = time();
if ( $enddate < $startdate ){
	echo '<script>alert("Please input a valid date. ");history.go(-1);</script>';
	exit;
}
$priority = $_POST['priority'];
//$assignedto = $_POST['assignedto'];
$assignedto = $_POST['cid'][0];
$status = $_POST['status'];

$db = new database;



if ( isset( $_POST['save'] ) ) {
	switch( $_POST['task'] ) {
		case 'add' :
			$currentdate = time();
			$numtaskrequired = getActiveQuota();
			$isavailable = checkIfWriterIsAvailableToAssignedTheTask( $assignedto, $currentdate, $numtaskrequired );
			if ( $isavailable ) {
				$sql = "INSERT INTO tasks VALUES('', '$subject', '$description', '$startdate', '$enddate', '$priority', '$assignedto', '$created', '$status', '$created_t' )";	
				$_SESSION['task'] = 'add';		
				$_SESSION['title'] = $subject;
				if (!($result = $db->query($sql))){
						die('Error:'. $db->error());
				}
			}
			else{
				echo '<script>alert("This person is already full to give a task. Please choose another writer to assigned the task. Thanks.");history.go(-1);</script>';
				exit;
			}
			break;
		case 'edit' :	
			$sql = "update tasks ";
			$sql .= " set subject = '$subject' , ";
			$sql .= " description = '$description' , ";	
			$sql .= " startdate = '$startdate' , ";
			$sql .= " enddate = '$enddate' , ";
			$sql .= " priority = '$priority' , ";
			$sql .= " assignedto = '$assignedto'  ";
			$sql .= " where taskID =" . intval( $taskID );
			$_SESSION['task'] = 'edit';
			$_SESSION['title'] = $subject;
			if (!($result = $db->query($sql))){
					die('Error:'. $db->error());
			}
			break;
	}
}
if ( isset( $_POST['cancel'] ) ) {
	header('Location: task_manager.php');
}
header('Location: task_manager.php');
?>