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
$db = new database;



// Get the current date/time
$date = date ( "F d, Y h:i:s A" );
// Get the authors name of the articles..
$author_name = getUser_info( $userID , 'fullname' );
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/add_new_site_content.tpl.php' );
$tags = array(
		'{SITENAME}' 		=> 'CMS Adminss',
		'{TABLE_DATA}'		=> $row_data,
		'{MESSAGE}'			=> $message,
		'{DATE_CREATED}'	=> $date,
		'{AUTHOR}'			=> $author_name,
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>