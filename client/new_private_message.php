<?php
require ( '../admin/coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: ../index.php');
}
if ( isset($_SESSION['clientID'])) { 
	$userID = $_SESSION['clientID'];
}

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
$sql = " select * from content_users ";
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

$tpl = new template_parser( '../templates/new_private_message.tpl.php' );
$tags = array(
		'{MESSAGE_SUBJECT}' => 'Subject',
		'{TO}' 				=> $users,
		'{DATE}' 			=> 'Date',
		'{READ}' 			=> 'Read',
		'{TABLE_DATA}' 		=> $row_data,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> '../templates/client_top_menu.tpl.php',
		'{FOOTER}' 			=> '../admin/footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();

?>