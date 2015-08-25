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

if ( isset($_SESSION['message']) ){
	$message = $_SESSION['message'];
	unset($_SESSION['message']);
}
$db = new database;




$sql = " select * from content_users cu ";
$sql .= " where cu.userID=" . $_SESSION['clickuserID'];
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}

$my_profile = array();
while( $row = $db->fetcharray() ) {
	$my_profile [] = $row; 
}
$sql = " select * from content_usertypes ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$group = array();
while( $row = $db->fetcharray() ) {
	$group[] = $row; 
}
$db->freeresult();

// Get the current position of the user
$current_usertype = getGroup_name ( $my_profile[0]->usertypeID );
$usertypes = '';
foreach( $group as $field=>$data ){
	if ( $data->usertype_name == $current_usertype ){
		$usertypes .= '<option value="' . $data->usertypeID . '" selected >';
		$usertypes .= $data->usertype_name;
		$usertypes .= '</option>';
	}
	else{
		$usertypes .= '<option value="' . $data->usertypeID . '">';
		$usertypes .= $data->usertype_name;
		$usertypes .= '</option>';
	}	
}

if ($my_profile[0]->is_enabled){
	$block .= '<input name="enabled" type="radio" value="1" checked >Yes';
	$block .= '<input name="enabled" type="radio" value="0" >No';
}
else{
	$block .= '<input name="enabled" type="radio" value="1" >Yes';
	$block .= '<input name="enabled" type="radio" value="0" checked >No';
}

if ( $my_profile[0]->lastvisitDate > 0 ) {
	$last_visit_date = friendlydate( $my_profile[0]->lastvisitDate );	
}
else{
	$last_visit_date = '0';
}

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/edit_user_profile_manager.tpl.php' );
$tags = array(
		'{FULLNAME}' 		=> $my_profile[0]->fullname,
		'{USERNAME}' 		=> $my_profile[0]->username,
		'{EMAIL}' 			=> $my_profile[0]->email,
		'{HOMEADDRESS}' 	=> $my_profile[0]->homeaddress,
		'{INTERESTS}' 		=> $my_profile[0]->interest,
		'{CELNO}'			=> $my_profile[0]->celno,
		'{PHONENO}' 		=> $my_profile[0]->phoneno,
		'{MESSAGE}' 		=> $message,
		'{GROUP}' 			=> $usertypes,
		'{IS_ENABLED}' 		=> $block,
		'{REGISTER_DATE}' 	=> friendlydate( $my_profile[0]->registerDate ),
		'{LAST_VISIT_DATE}' => $last_visit_date,
		
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>