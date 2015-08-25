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
$_SESSION['task'] = 'add';
for($i=1; $i<=12 ; $i++) {
	$optmonth .= '<option value ="'.$i.'">'.date("M", mktime(0, 0, 0, $i, 1,0)).'</option>';
}
for($i=1; $i <= 31; $i++) {
	$optday .= '<option value ="'.$i.'">'.date("d", mktime(0, 0, 0, 0, $i, 0)).'</option>';
}
// TODO: bai moi kindly change the year must be DYNAMIC!!
$optyear .= '<option value ="2006">'.date('Y').'</option>';

// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->creating_category, '-' );

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/add_new_poll.tpl.php' );
$tags = array(
		'{CATEGORY_NAME}' 	=> $category_name ,
		'{CATEGORY_DESC}'	=> $category_desc ,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{MESSAGE}'			=> $message,
		'{FROM_MONTH}'		=> $optmonth,
		'{FROM_DAY}'		=> $optday,
		'{FROM_YEAR}'		=> $optyear,
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 

	);
$tpl->parse_template( $tags );
print $tpl->display();
?>