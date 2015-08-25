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
$category_name = $_SESSION['category_name'];
$category_desc = $_SESSION['category_desc'];
$heading = "Category : Edit ";
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->editing_category, 'Editing the category detail of '. $category_name );
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/edit_category_detail.tpl.php' );
$tags = array(
		'{CATEGORY_NAME}' 	=> $category_name ,
		'{CATEGORY_DESC}'	=> $category_desc ,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADING}'			=> $heading,
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 
);
$tpl->parse_template( $tags );
print $tpl->display();
?>