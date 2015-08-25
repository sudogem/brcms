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
if ( isset( $_SESSION['task'] ) && $_SESSION['task'] != '' ) {
	switch ( $_SESSION['task'] ) {
		case 'edit':
			$message = 'Successfully saved the changes of profile: ' . $_SESSION['title'];
			break;
		case 'add':
			$message = 'Successfully saved the user profile: ' . $_SESSION['title'];
			break;
	}		
unset($_SESSION['task']);			
}
$db = new database;



$userID = $_GET['userID'];
$sql = " select * from content_users cu ";
$sql .= " where cu.userID=" . intval($userID);
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
// saved the user profile into an array..
$my_profile = array();
while( $row = $db->fetcharray() ) {
	$my_profile[] = $row; 
}
$db->freeresult();
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->viewing_user_profile, $my_profile[0]->username );

$sql = "select * from user_stage us ";
$sql .= " where us.userID=" .intval($userID);
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$user_stage = array();
while( $row = $db->fetcharray() ) {
	$user_stage[] = $row; 
}
$db->freeresult();
for( $i = 0; $i < count($user_stage); $i++ ){
	switch ($user_stage[$i]->stageID) { // ok lets check his workflow
		case 1:
		case 2:
			$wselected = 'checked';
			break;
		case 3:
			$edselected = 'checked';
			break;
		case 4:
			$evselected = 'checked';
			break;
		case 5:
			$peselected = 'checked';
			break;
	}
}	

// Get the position of this user
$group_name = getGroup_name ( $my_profile[0]->usertypeID );

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/user_access.tpl.php' );
$tags = array(
		'{USERID}'			=> $userID,
		'{WISCHECKED}'		=> $wselected,
		'{EDISCHECKED}'		=> $edselected,
		'{EVISCHECKED}'		=> $evselected,
		'{PISCHECKED}'		=> $peselected,
		'{FULLNAME}'		=> $my_profile[0]->fullname,
		'{LIST_USERTYPEID}'	=> $group_name, 
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{SIDENAV}' 		=> 'user_menu2.php',
		'{FOOTER}' 			=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>