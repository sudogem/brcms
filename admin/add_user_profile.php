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
// 	print_r($_POST);
$db = new database;



// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->creating_user, '--' );
$sql = " select * from content_usertypes ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$group = array();
while( $row = $db->fetcharray() ) {
	$group[] = $row; 
}
$db->freeresult();
$usertypes = '';
foreach( $group as $field=>$value ){
	$usertypes .= '<option value="' . $value->usertypeID . '">';
	$usertypes .= $value->usertype_name;
	$usertypes .= '</option>';
}

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
	$category_names .= '<option value="' . $data->categoryID . '">';
	$category_names .= $data->category_name;
	$category_names .= '</option>';
}

$block .= '<input name="enabled" type="radio" value="0" checked>Yes';
$block .= '<input name="enabled" type="radio" value="1" >No';
$registerDate = time();

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/add_user_profile.tpl.php' );
$tags = array(
		'{FULLNAME}' 		=> $_POST['name'],
		'{USERNAME}' 		=> $_POST['username'],
		'{EMAIL}' 			=> $my_profile[0]->email,
		'{HOMEADDRESS}' 	=> $my_profile[0]->homeaddress,
		'{INTERESTS}' 		=> $my_profile[0]->interest,
		'{CELNO}'			=> $my_profile[0]->celno,
		'{PHONENO}' 		=> $my_profile[0]->phoneno,
		
		'{LIST_USERTYPE}'	=> ' '.$usertypes ,// another mystery bug of the program...
		'{CATEGORY}'		=> ' '.$category_names,
		'{IS_ENABLED}' 		=> $block,
		'{MESSAGE}' 		=> $message,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{REGISTER_DATE}'	=> friendlydate($registerDate),
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>