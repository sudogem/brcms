<?php
require ( '../admin/coreclass.php' );

session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: ../index.php');
}

if (isset($_SESSION['login'])) {
	$clientID = $_SESSION['clientID'];
	$clientname = $_SESSION['username'];
}

if ( isset($_SESSION['task']) && $_SESSION['task'] != '' ) {
	switch( $_SESSION['task']) {
		case 'edit':
			$message  = 'Changes of ' . $_SESSION['title'] . ' was succesfully saved ';
			break;
		case 'add':
			$message = 'Successfully saved client info: ' . $_SESSION['title'];
			break;
	}
	unset ($_SESSION['task']);	
}

$db = new database;




$sql = " select * from corporate_partners cp ";
$sql .= " where cp.clientID=" . intval( $clientID );
if (!( $result = $db->query( $sql ) ) ) {
	die ( 'Error :' . $db->error() );
}
$clients = array();
while( $clients[] = $db->fetcharray() );
$_SESSION['clickclientID'] = $clients[0]->clientID;
$_SESSION['clientID'] = $clients[0]->clientID;
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
// Get the date of registered of the client  
if ($clients[0]->registerDate ) {
	$date = $clients[0]->registerDate;
}
else {
	$date = time();
}
// Get his last visit date 
$lastvisitDate = ( $clients[0]->lastvisitDate ) ? 
	friendlyDate ( $clients[0]->lastvisitDate ) : '0000-00-00 00:00:00';


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
		'{LAST_VISIT_DATE}' => $lastvisitDate,		
		'{REGISTER_DATE}' 	=> friendlyDate($date),
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{STYLESHEET}'		=> $stylesheet,
		
		'{TOPNAV}' 			=> 'client_top_menu.php',
		'{FOOTER}' 			=> '../admin/footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>