<?php
require ( 'coreclass.php' );
/** ensure this file is being included by a parent file -- {mh}*/
//defined('{mh}') or die("Direct access to this location is not allowed :-)");

session_start();
if ( !isset($_SESSION['login'])) {
	header('Location: login.php');
}

if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}

//retrieve the users workflow he had been assign ...
$db = new database;




$sql = "select * from 
		user_stage us,
		stages s
		where us.userID = $userID
		and	s.stageID = us.stageID ";
		
if (!($result = $db->query($sql))){
	die('Error:'. $db->error());
}
$user_stage = array();
while ( $row = $db->fetcharray() ) {
	$user_stage[] = $row;
}
$db->freeresult();

//print_r($_SESSION);
$menu = '';
if ( $usertype == 'Administrator') {
	$menu .= '<li><a href="../admin/view_article_versions.php?stageID=5">All News Content</a></li>';
	$menu .= '<li><a href="user_manager2.php">User Manager </a></li>';
	$menu .= '<li><a href="user_stage_manager2.php">User Stage Manager </a></li>';
	$menu .= '<li><a href="banner_ads_manager2.php">Banner Ads Manager</a></li>';
	$menu .= '<li><a href="user_log_manager.php">User Log Manager</a></li>';
	$menu .= '<li><a href="global_configuration2.php">Global Configuration</a></li>';
	$menu .= '<li><a href="help2.php">Help</a></li>';
	$use_common_menu = 1;	
	$admin_menu = 1; // admin menu
}

// ok pepol,,let us know what are his workflow he/she had been ASSIGN by the admin..
for( $i = 0; $i < count($user_stage); $i++ ){
	switch ($user_stage[$i]->stageID) { // ok lets check his workflow
		case 1:// writing
			$menu .= '<li><a href="../editor/add_article.php">Add Article</a></li>';
		    $menu .= '<li><a href="../admin/my_articles2.php">My Articles </a></li>';
			$use_common_menu = 1;
			break;
		case 2:// editing
			$menu .= '<li><a href="../admin/view_article_versions.php?stageID=2">Edit Article</a></li>';
			$use_common_menu = 1;
			break;
		case 3:// proofreading
			$menu .= '<li><a href="../admin/view_article_versions.php?stageID=3">Evaluate Article</a></li>';
			$menu .= '<li><a href="../admin/category_manager.php">Category Manager </a></li>';
			$use_common_menu = 1;	
			break;
		case 4:// live => publihser	
			$menu .= '<li><a href="../admin/view_article_versions.php?stageID=4">Publish Article</a></li>';
			$menu .= '<li><a href="../admin/template_manager2.php">Template Manager </a></li>';
			$use_common_menu = 1;
			break;
	}
}
if ( $use_common_menu ) {
	//$menu .= '<li><a href="index.php?option=my_articles">My Articles </a></li>';
	//$menu .= '<li><a href="index.php?option=all_articles">All Articles </a></li>';
	$menu .= '<li><a href="../admin/image_manager2.php">Image Manager </a></li>';
	$menu .= '<li><a href="../admin/user_profile.php">My Personal Profile</a></li>';
	$menu .= '<li><a href="../admin/view_messages.php">Messages</a></li>';
	$menu .= '<li><a href="../admin/help2.php">Help</a></li>';	
	$menu .= '<li><a href="../admin/logout2.php">Log-out</a></li>';
}

// now start compiling the page..
$tpl = new template_parser( '../templates/user_menu.tpl.php' );
$tags = array(
		'{MENU}' => $menu
		);
$tpl->parse_template( $tags );
print $tpl->display();

//print $menu;
?>