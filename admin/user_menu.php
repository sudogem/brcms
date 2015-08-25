<?php
require ( 'coreclass.php' );
/** ensure this file is being included by a parent file -- {mh}*/
defined('{mh}') or die("Direct access to this location is not allowed :-)");

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
		content_stages cs
		where us.userID = $userID
		and	cs.stageID = us.stageID ";
		
if (!($result = $db->query($sql))){
	die('Error:'. $db->error());
}
$user_stage = array();
while ( $row = $db->fetcharray() ) {
	$user_stage[] = $row;
}
$db->freeresult();

$cache_file = 'cache.txt';
$out = serialize( $user_stage );// save serialize data for later use...
$fp = fopen($cache_file, "w");
fputs($fp, $out);
fclose($fp);

$menu = '';
if ( $usertype == 'Administrator') {
	$menu .= '<li><a href="index.php?option=all_articles">All Articles </a></li>';
	$menu .= '<li><a href="index.php?option=user_manager">User Manager </a></li>';
	$menu .= '<li><a href="index.php?option=user_stage_manager">User Stage Manager </a></li>';
	$menu .= '<li><a href="index.php?option=banner_manager">Banner Manager</a></li>';
	$menu .= '<li><a href="index.php?option=global_configuration">Global Configuration</a></li>';
	$menu .= '<li><a href="index.php?option=help">Help</a></li>';
	//$menu .= '<li><a href="index.php?option=logout">Log-out</a></li>';
	$use_common_menu = 1;	
	$admin_menu = 1; // admin menu
}

// ok pepol,,let us know what are his workflow he/she had been ASSIGN by the admin..
for( $i = 0; $i < count($user_stage); $i++ ){
	switch ($user_stage[$i]->stageID) { // ok lets check his workflow
		case 1:// writing
			$menu .= '<li><a href="index.php?option=add_article">Add Article</a></li>';
		    $menu .= '<li><a href="index.php?option=my_articles">My Articles </a></li>';
			$use_common_menu = 1;
			break;
		case 2:// editing
			$menu .= '<li><a href="index.php?option=edit_article">Edit Article</a></li>';
			$use_common_menu = 1;
			break;
		case 3:// proofreading
			$menu .= '<li><a href="index.php?option=proofread_article">Proofread Article</a></li>';
			$menu .= '<li><a href="index.php?option=category_manager">Category Manager </a></li>';
			$use_common_menu = 1;	
			break;
		case 4:// live => publihser	
			$menu .= '<li><a href="index.php?option=publish_article">Publish Article</a></li>';
			$menu .= '<li><a href="index.php?option=template_manager">Template Manager </a></li>';
			$use_common_menu = 1;
			break;
		case 5: // this user is not admimn but has given rights to administers
			if (!$admin_menu) {
				$menu .= '<li><a href="index.php?option=all_articles">All Articles </a></li>';
				$menu .= '<li><a href="index.php?option=">User Manager </a></li>';
				$menu .= '<li><a href="index.php?option=">User Stage Manager </a></li>';
				$menu .= '<li><a href="index.php?option=">Banner Manager</a></li>';
				$menu .= '<li><a href="index.php?option=">Global Configuration</a></li>';
				$menu .= '<li><a href="index.php?option=">Help</a></li>';
				$admin_menu = 1; // page is for admin
				$use_common_menu = 1;
			}
			break;
	}
}
if ( $use_common_menu ) {
	//$menu .= '<li><a href="index.php?option=my_articles">My Articles </a></li>';
	//$menu .= '<li><a href="index.php?option=all_articles">All Articles </a></li>';
	$menu .= '<li><a href="index.php?option=image_manager">Image Manager </a></li>';
	$menu .= '<li><a href="index.php?option=my_profile">My Personal Profile</a></li>';
	$menu .= '<li><a href="index.php?option=help">Help</a></li>';	
	$menu .= '<li><a href="index.php?option=logout">Log-out</a></li>';
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