<?php
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




$sql = " select * from content_users cu ";
$sql .= " where cu.userID=" . $userID;
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
// saved the user profile into an array..
$my_profile = array();
while( $row = $db->fetcharray() ) {
	$my_profile [] = $row; 
}
$_SESSION['clickuserID'] = $my_profile[0]->userID;
$db->freeresult();
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->viewing_user_profile, $my_profile[0]->username );

// Get the position of this user
$group_name = getGroup_name ( $my_profile[0]->usertypeID);
// Get his last visit date 
$lastvisitDate = ( $my_profile[0]->lastvisitDate ) ? 
	friendlyDate ( $my_profile[0]->lastvisitDate ) : '0000-00-00 00:00:00';
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/my_profile.tpl.php' );
$tags = array(
		'{FULLNAME}' 		=> $my_profile[0]->fullname,
		'{USERNAME}' 		=> $my_profile[0]->username,
		'{EMAIL}' 			=> $my_profile[0]->email,
		'{HOMEADDRESS}' 	=> $my_profile[0]->homeaddress,
		'{INTERESTS}' 		=> $my_profile[0]->interest,
		'{CELNO}' 			=> $my_profile[0]->celno,
		'{PHONENO}' 		=> $my_profile[0]->phoneno,
		'{MESSAGE}' 		=> $message, 			

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