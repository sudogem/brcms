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



$clickuserID = $_GET['userID'];
$_SESSION['clickuserID'] = $clickuserID;
$sql = " select * from content_users cu ";
$sql .= " where cu.userID=" . $clickuserID;

if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
//print $sql;
$my_profile = array();
while( $row = $db->fetcharray() ) {
	$my_profile [] = $row; 
}
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->viewing_user_profile, 'Viewing a profile of '.$my_profile[0]->fullname );
//print_r($my_profile);
$db->freeresult();

$group_name = getGroup_name ( $my_profile[0]->usertypeID);
$_SESSION['group_name'] = $group_name;
$_SESSION['groupid'] = $my_profile[0]->usertypeID;
if ( $my_profile[0]->lastvisitDate > 0 ) {
	$lastvisitDate = friendlydate( $my_profile[0]->lastvisitDate );	
}
else{
	$lastvisitDate = '0';
}

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/user_profile_manager.tpl.php' );
$tags = array(
		'{FULLNAME}' 		=> $my_profile[0]->fullname,
		'{USERNAME}' 		=> $my_profile[0]->username,
		'{EMAIL}' 			=> $my_profile[0]->email,
		'{HOMEADDRESS}' 	=> $my_profile[0]->homeaddress,
		'{INTERESTS}' 		=> $my_profile[0]->interest,
		'{CELNO}' 			=> $my_profile[0]->celno,
		'{PHONENO}' 		=> $my_profile[0]->phoneno,
		'{LIST_USERTYPEID}' => ' '.$group_name ,// another mystery bug of the program...
		'{IS_ENABLED}' 		=> $my_profile[0]->is_enabled,
		'{REGISTER_DATE}' 	=> friendlydate($my_profile[0]->registerDate),
		'{LAST_VISIT_DATE}' => $lastvisitDate,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{SIDENAV}' 		=> 'user_menu2.php',
		'{FOOTER}' 			=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>