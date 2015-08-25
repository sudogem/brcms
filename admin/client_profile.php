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

$db = new database;



$clientID = $_GET['clientID'];
$_SESSION['clientID'] = $clientID;

$sql = " select * from corporate_partners cp ";
$sql .= " where cp.clientID=" . intval( $clientID );
if (!( $result = $db->query( $sql ) ) ) {
	die ( 'Error :' . $db->error() );
}
$clients = array();
while( $clients[] = $db->fetcharray() );
$_SESSION['clickclientID'] = $clients[0]->clientID;
$_SESSION['clientname'] = $clients[0]->clientname;
$_SESSION['clientusername'] = $clients[0]->username;
$_SESSION['contactname'] = $clients[0]->contactname;
$_SESSION['emailadd'] = $clients[0]->emailadd;
$_SESSION['address'] = $clients[0]->address;
$_SESSION['website'] = $clients[0]->website;
$_SESSION['phoneno'] = $clients[0]->phoneno;
$_SESSION['faxno'] = $clients[0]->faxno;
$_SESSION['extrainfo'] = $clients[0]->extrainfo;
$_SESSION['status'] = $clients[0]->status;
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->viewing_client_profile, 'Viewing client profile ' . $_SESSION['clientname'] );

// Get the date of registered of the client  
if ($clients[0]->registerDate > 0 ) {
	$date = $clients[0]->registerDate;
	$_SESSION['registerdate'] = friendlyDate($date);
}
else{
	$_SESSION['registerdate'] = 0;
}


if ( $clients[0]->lastvisitDate > 0 ) {
	$lastvisitDate = friendlydate( $clients[0]->lastvisitDate );	
	$_SESSION['lastvisitdate'] = $lastvisitDate;
}
else{
	$lastvisitDate = '0';
	$_SESSION['lastvisitdate'] = 0;
}


$stylesheet = ' ../templates/admin2.css';

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/client_profile.tpl.php' );
$tags = array(
		'{CLIENTNAME}' 		=> $clients[0]->clientname ,
		'{USERNAME}' 		=> $clients[0]->username ,		
		'{CONTACTNAME}' 	=> $clients[0]->contactname ,
		'{EMAIL}' 			=> $clients[0]->emailadd ,
		'{ADDRESS}' 		=> $clients[0]->address ,
		'{WEBSITE}'			=> $clients[0]->website ,
		'{PHONENO}' 		=> $clients[0]->phoneno,
		'{FAXNO}' 			=> $clients[0]->faxno,
		'{EXTRAINFO}' 		=> $clients[0]->extrainfo ,
		'{STATUS}' 			=> $block,
		'{MESSAGE}' 		=> $message,
		
		'{REGISTER_DATE}' 	=> friendlyDate($date),
		'{LAST_VISIT_DATE}' => $lastvisitDate,
		'{STYLESHEET}'		=> $stylesheet,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>