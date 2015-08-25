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
if ( isset($_POST['cancel']) ) {
	header('location: other_site_content.php');
	exit();
}

$title = $_SESSION['adercontenttitle'];
$created = $_SESSION['adercontentcreated'];
$author = $_SESSION['adercontentauthor'];
$body = $_SESSION['adercontentbody'];
$checked = $_SESSION['ischecked'];
switch( $checked ){
	case 'Published':
		$checked = ' checked ';
		break;
}
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/edit_other_content.tpl.php' );
$tags = array(
		'{TITLE}'			=> $title,
		'{ISCHECKED}'		=> $checked,
		'{DATE_CREATED}'	=> $created,
		'{AUTHOR}'			=> $author,
		'{BODY}'			=> $body,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{MESSAGE}'			=> $message,
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>