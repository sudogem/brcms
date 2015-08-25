<?php
require( '../admin/coreclass.php' );
session_start();
if ( isset($_SESSION['message']) ){
	$message = $_SESSION['message'];
	unset($_SESSION['message']);
}

$stylesheet = ' ../templates/admin2.css';
if ( isset($_POST['cancel']) ) {
	header('location: my_banners.php');
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
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/edit_clients_profile2.tpl.php' );
$tags = array(
		'{CLIENTNAME}' 		=> $clientname ,
		'{USERNAME}' 		=> $username ,		
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
		'{TOPNAV}' 			=> 'client_top_menu.php',
		'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();

?>