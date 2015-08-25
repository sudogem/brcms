<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
session_start();
if ( !isset($_SESSION['login'])) { 
	header('Location: login.php');
}
if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}
$db = new database;



$id = $_GET['id'];
$sql = " select * from other_site_content 
		where id = '$id' ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
while( $content[] = $db->fetcharray() );
$db->freeresult();
$category = $content[0]->category;
$datecreated = friendlydate($content[0]->created);
$author = getUser_info ( $content[0]->author, 'fullname' );

// start generating page
$tpl = new template_parser( '../templates/preview_sitecontent.tpl.php' );
$tags = array(
		'{CATEGORY}'		=> $category,
		'{AUTHOR}'			=> $author,
		'{DATE_CREATED}'	=> $datecreated,	
		'{TITLE}'			=> $content[0]->title,
		'{BODY}' 			=> $content[0]->body,
);

$tpl->parse_template( $tags );
print $tpl->display();
?>

