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
	$username = $_SESSION['username'];  
	// Log the activity
	$action = new activity;
	$action->track_activity( $userID, $action->loggedin, '--' );
}
$x = new online_tracker;
$x->tracker();

$usertypeID = getUser_info( $userID, 'usertypeID' );
$position = getGroup_name( $usertypeID );
$message = ' Welcome ' . $username . '!';

switch( $position ) {
	case 'Administrator':
		$message .= ', you logged in as ' . $position . '.';
		$_SESSION['stageID'] = 6;
		break;
	case 'Writer':
		$x = checkUserAccessRights( $userID, 2 );
		if (!$x) $message .= ' Sorry, the admin restrict you to act as a Writer.';
		else $message .= ', you logged in as ' . $position . '.';
		$_SESSION['stageID'] = 1;
		break;
	case 'News Editor':
		$x = checkUserAccessRights( $userID, 3 );
		if (!$x) $message .= ' Sorry, the admin restrict you to act as an Editor.';
		else $message .= ', you logged in as ' . $position . '.';
		$_SESSION['stageID'] = 3;
		break;	
	case 'News Director':	
		$x = checkUserAccessRights( $userID, 4 );
		if (!$x) $message .= ' Sorry, the admin restrict you to act as a News Director.';
		else $message .= ', you logged in as ' . $position . '.';
		break;
	case 'Publisher':	
		$x = checkUserAccessRights( $userID, 5 );
		if (!$x) $message .= ' Sorry, the admin restrict you to act as a Publisher.';
		else $message .= ', you logged in as ' . $position . '.';
		break;
}
/*
 * Get the default stylesheets
 */
$stylesheet = " ../templates/admin2.css";
$welcome_message = 'welcome! mindhack ';
// start generating page
$tpl = new template_parser( '../templates/index_body.tpl.php' );
$tags = array(
		'{SITENAME}'		=> 'CMS Adminss',
		'{HEADER}'			=> '&nbsp;',
		'{WELCOME_MESSAGE}'	=> $message,
		'{MSG}'				=> $msg,
		'{TOPNAV}' 			=> '',
		'{STYLESHEET}'		=> $stylesheet ,
		'{CONTENT}' 		=> 'main_content2.php',
		'{FOOTER}' 			=> 'footer.php' 
);
$tpl->parse_template( $tags );
print $tpl->display();
?>