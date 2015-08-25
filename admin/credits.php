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

// start compiling the page..
$tpl = new template_parser( '../templates/credits2.tpl.php' );
$tags = array(
		'{SITENAME}' 		=> 'CMS Adminss',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>
