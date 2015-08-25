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
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->creating_client_profile, '--');
unset($_SESSION['clientID']);
unset($_SESSION['clientname']);
unset($_SESSION['contactname']);	
unset($_SESSION['username2']);
unset($_SESSION['email']);	
unset($_SESSION['phoneno']);	
unset($_SESSION['faxno']);			
unset($_SESSION['extrainfo']);			
unset($_SESSION['address']);				
$block .= '<input name="status" type="radio" value="1"checked>Yes';
$block .= '<input name="status" type="radio" value="0" >No';
$date = time();
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/add_new_clients.tpl.php' );
$tags = array(
		'{STATUS}' 			=> $block,
		'{REGISTER_DATE}' 	=> friendlyDate($date),
		'{MESSAGE}' 		=> $message,
		'{CLIENTNAME}'		=> $clientname,
		'{USERNAME}'		=> $username2,
		'{CONTACTNAME}'		=> $contactname,
		'{EMAIL}'			=> $email,		
		'{ADDRESS}'			=> $address,		
		'{WEBSITE}'			=> $website1,		
		'{TELNO}'			=> $phoneno,				
		'{FAXNO}'			=> $faxno, 		
		'{EXTRAINFO}'		=> $extrainfo,			
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>