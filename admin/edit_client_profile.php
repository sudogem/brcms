<?php
include( 'configuration.php' );
require( 'coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: login.php');
}

if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}

//print_r($_POST);
if ( isset($_POST['cancel']) ) {
	header('location: clients_manager.php');
	exit();
}

$clientname = $_SESSION['clientname'];
$username = $_SESSION['clientusername'];
$contactname = $_SESSION['contactname'];
$emailadd = $_SESSION['emailadd'];
$address = $_SESSION['address'];
$website1 = $_SESSION['website'];
$phoneno = $_SESSION['phoneno'];
$registerdate = $_SESSION['registerdate'];
$lastvisitdate = $_SESSION['lastvisitdate'];
$faxno = $_SESSION['faxno'];
$extrainfo = $_SESSION['extrainfo'];
$status = $_SESSION['status'];
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->editing_client_profile, 'Editing client profile ' . $_SESSION['clientname'] );

if (!$my_profile[0]->is_enabled){
	$block .= '<input name="status" type="radio" value="1" checked >Yes';
	$block .= '<input name="status" type="radio" value="0" >No';
}
else{
	$block .= '<input name="status" type="radio" value="1" >Yes';
	$block .= '<input name="status" type="radio" value="0" checked >No';
}
if ( $registerdate ) {
	$registerdate = $_SESSION['registerdate'];
}
else{
	$registerdate = 0;
}

if ( $clients[0]->lastvisitDate > 0 ) {
	$lastvisitDate = friendlydate( $clients[0]->lastvisitDate );	
}
else{
	$lastvisitDate = '0';
}

$stylesheet = ' ../templates/admin2.css';
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/edit_clients_profile.tpl.php' );
$tags = array(
		'{CLIENTNAME}' 		=> $clientname ,
		'{USERNAME}' 		=> $username ,	
		'{REGISTER_DATE}'	=> $registerdate,
		'{LAST_VISIT_DATE}'	=> $lastvisitdate,	
		'{CONTACTNAME}' 	=> $contactname ,
		'{EMAIL}' 			=> $emailadd ,
		'{ADDRESS}' 		=> $address ,
		'{WEBSITE}'			=> $website1,				
		'{PHONENO}' 		=> $phoneno,
		'{FAXNO}' 			=> $faxno,
		'{EXTRAINFO}' 		=> $extrainfo ,
		'{STATUS}' 			=> $block,
		'{MESSAGE}' 		=> $message,
		
		'{STYLESHEET}'		=> $stylesheet,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();

?>