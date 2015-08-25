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
$heading = "Category: New ";
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->creating_category, '-' );
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/add_new_category.tpl.php' );
$tags = array(
		'{HEADING}'			=> $heading,
		'{CATEGORY_NAME}' 	=> $category_name ,
		'{CATEGORY_DESC}'	=> $category_desc ,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>