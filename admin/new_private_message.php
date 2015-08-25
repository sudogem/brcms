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
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->creating_msg, '-' );
$db = new database;




/**
 * If the user clik the delete message..
 */
if( isset( $_POST['delete'])) {
	header( 'location: delete_message.php' );
	
}
/**
 * Populate all the content users into an array..
 */
$sql = " select * from content_users order by fullname";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$users = array();
while( $row = $db->fetcharray() ) {
	$users[] = $row; 
}
$db->freeresult();

$senderID = $_SESSION['$from_userID'];
foreach( $users as $field => $data ) {
	if ( $data->userID == $senderID ) { // Get the userID of the sender
		$users .= '<option value="' . $data->userID . '" selected >';
		$users .= $data->fullname;
		$users .= '</option>';
	}
	else{
		$users .= '<option value="' . $data->userID . '"  >';
		$users .= $data->fullname;
		$users .= '</option>';
	}
}
if ( isset($_SESSION['message_subject'])) {
	$messagebody = $_SESSION['message_body'];
	$messagesubject = 'RE: '.$_SESSION['message_subject'];
	unset($_SESSION['message_body']);
	unset($_SESSION['message_subject']);
}
$tpl = new template_parser( '../templates/new_private_message.tpl.php' );
$tags = array(
		'{MESSAGEBODY}'		=> $messagebody,
		'{MESSAGESUBJECT}'  => $messagesubject,		
		'{MESSAGE_SUBJECT}' => 'Subject',
		'{TO}' 				=> $users,
		'{DATE}' 			=> 'Date',
		'{READ}' 			=> 'Read',
		'{TABLE_DATA}' 		=> $row_data,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();

?>