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




if ( isset($_POST['cancel']) ) {
	header('location: user_manager2.php');
	exit();			
}

$sql = " select * from content_users cu ";
if ( isset($_GET['userID']) != '' ) {
	$sql .= " where cu.userID=" . $_GET['userID'];
}
else {
	$sql .= " where cu.userID=" . $_SESSION['clickuserID'];
}
//print_r($_SESSION);
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$my_profile = array();
while( $row = $db->fetcharray() ) {
	$my_profile [] = $row; 
}
/**
 * Get content editor
 */
$sql = "select * from content_editor ";
$sql .= "where userID = " . $_SESSION['clickuserID'];
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$content_editor = array();
while( $row = $db->fetcharray() ) {
	$content_editor[] = $row; 
}
$category_assigned = getCategory_info($content_editor[0]->categoryID, 'category_name' );
/**
 * Get all the news category
 */
$sql = " select * from category ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$category = array();
while( $row = $db->fetcharray() ) {
	$category[] = $row; 
}
$db->freeresult();
/**
 * Populate all the news-category into an array..
 */
$category_names = '';
foreach( $category as $field => $data ) {
	if ( $data->category_name == $category_assigned ) {
		
		//$category_names .= '<input type="checkbox" name="category" value="' . $data->categoryID . '" selected >';
		$category_names .= '<option value="' . $data->categoryID . '" selected >';
		$category_names .= $data->category_name;
		$category_names .= '</option>';
	}
	else{
		/*$category_names .= '<li>';
		$category_names .= '<input type="checkbox" name="category" value="' . $data->categoryID . '" selected >';
		$category_names .= $data->category_name;
		$category_names .= '</li>';*/
		$category_names .= '<option value="' . $data->categoryID . '">';
		$category_names .= $data->category_name;
		$category_names .= '</option>';
	}
}
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->editing_user_profile, $my_profile[0]->username );

$group_name = getGroup_name ( $my_profile[0]->usertypeID);
switch ( $usertype ){
	case 'Administrator':
		$sql = " select * from content_usertypes ";
		if (!($result = $db->query($sql))) {
			die('Error:'.$db->error() );
		}
		$group = array();
		while( $row = $db->fetcharray() ) {
			$group[] = $row; 
		}
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
		
		if (!$my_profile[0]->is_enabled){
			$block .= '<input name="enabled" type="radio" value="1"  >Yes';
			$block .= '<input name="enabled" type="radio" value="0" checked>No';
		}
		else{
			$block .= '<input name="enabled" type="radio" value="1" checked>Yes';
			$block .= '<input name="enabled" type="radio" value="0"  >No';
		}
		$set_template = '../templates/edit_user_profile_manager.tpl.php';
		break;
	default:
		$current_usertype = getGroup_name ( $my_profile[0]->usertypeID );
		$usertypes .= '<option value="' . $my_profile[0]->usertypeID . '" selected >';
		$usertypes .= $current_usertype;
		$usertypes .= '</option>';
		$set_template = '../templates/edit_user_profile.tpl.php';
		break;
}
//echo $set_template;
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( $set_template );
$tags = array(
		'{FULLNAME}' 		=> $my_profile[0]->fullname,
		'{USERNAME}' 		=> $my_profile[0]->username,
		'{EMAIL}' 			=> $my_profile[0]->email,
		'{HOMEADDRESS}' 	=> $my_profile[0]->homeaddress,
		'{INTERESTS}' 		=> $my_profile[0]->interest,
		'{CELNO}'			=> $my_profile[0]->celno,
		'{PHONENO}' 		=> $my_profile[0]->phoneno,
		'{MESSAGE}' 		=> $message,
		//'{GROUP}' 			=> $group_name ,// another mystery bug of the program...
		'{GROUP}' 			=> $usertypes,
		'{CATEGORY}'		=> ' '.$category_names,
		'{IS_ENABLED}' 		=> $block,
		
		//'{IS_ENABLED}' 		=> $my_profile[0]->is_enabled,
		'{REGISTER_DATE}' 	=> friendlyDate($my_profile[0]->registerDate),
		'{LAST_VISIT_DATE}' => friendlydate($my_profile[0]->lastvisitDate),
		
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>