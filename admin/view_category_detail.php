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
$categoryID = $_GET['categoryID'];
$db = new database;



// Get all the news category
$sql = " select * from category ";
$sql .= " where categoryID=" . intval($categoryID);
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$category = array();
while( $row = $db->fetcharray() ) {
	$category[] = $row; 
}
$db->freeresult();
$category_name = $category[0]->category_name;
$category_desc = $category[0]->category_desc; 
$_SESSION['categoryID'] = $category[0]->categoryID;
$_SESSION['category_name'] = $category_name;
$_SESSION['category_desc'] = $category_desc;
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->viewing_category, 'Viewing the category detail of '.$category_name );
switch(	$usertype ) {
	case 'Administrator':
		//$_SESSION['task'] = 'edit';
		$set_template = "../templates/view_category_detail2.tpl.php";
		break;
	case 'News Director':
		//$_SESSION['task'] = 'edit';
		$set_template = "../templates/view_category_detail2.tpl.php";
		break;
		
	default:
		$set_template = "../templates/view_category_detail.tpl.php";
		break;
}
// start compiling the page..
//print $set_template;
$tpl = new template_parser( $set_template );
$tags = array(
		'{CATEGORY_NAME}' 	=> $category_name,
		'{CATEGORY_DESC}'	=> $category_desc,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{CONTENT}' 		=> $row_data,
		'{FOOTER}' 			=>  'footer.php' 
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>