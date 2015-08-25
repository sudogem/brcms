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



$taskID = $_GET['taskID'];
$sql = "select * from tasks where taskID = '$taskID' ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$task_detail = array();
while( $row = $db->fetcharray() ) {
	$task_detail[] = $row; 
}
$db->freeresult();

$_SESSION['taskID'] = $task_detail[0]->taskID;
$_SESSION['subject'] = $task_detail[0]->subject;
$_SESSION['description'] = $task_detail[0]->description;
$_SESSION['created_t'] = $task_detail[0]->created_t;
$_SESSION['startdate'] = $task_detail[0]->startdate;
$_SESSION['enddate'] = $task_detail[0]->enddate;
$_SESSION['priority'] = $task_detail[0]->priority;
$_SESSION['status'] =  $task_detail[0]->status;
$_SESSION['assignedto'] = $task_detail[0]->assignedto;
switch( $_SESSION['stageID'] ) {
	case 1:
	case 2:
		$set_template = "../templates/view_task_detail_writer.tpl.php";
		break;
	case 3:
		$set_template = "../templates/view_task_detail.tpl.php";
		break;	
}
//print_r($_SESSION);
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->viewing_quotes, 'Viewing the task detail of '.$category_name );
// start compiling the page..
$tpl = new template_parser($set_template);
$tags = array(
		'{SUBJECT}'			=> $task_detail[0]->subject ,
		'{DESCRIPTION}'		=> $task_detail[0]->description ,
		'{CREATED}'			=> friendlydate($task_detail[0]->created_t) ,	
		'{STARTDATE}'		=> friendlydate($task_detail[0]->startdate) ,	
		'{DUEDATE}'			=> friendlydate($task_detail[0]->enddate) ,			
		'{STATUS}'			=> $task_detail[0]->status ,			
		'{PRIORITY}'		=> $task_detail[0]->priority,
		'{ASSIGNEDTO}'		=> getUser_info($task_detail[0]->assignedto,'fullname' ) ,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{CONTENT}' 		=> $row_data,
		'{FOOTER}' 			=>  'footer.php' 
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>