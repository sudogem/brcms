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
$id = $_GET['id'];
$_SESSION['id'] = $id;
$db = new database;



$sql = "select * from other_site_content where id='$id' ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$content = array();
while( $content[] = $db->fetcharray() );
$db->freeresult();

$title = $content[0]->title;
$_SESSION['adercontenttitle'] = $title;
$category = $content[0]->category;
$_SESSION['adercontentcategory'] = $category;
$body = $content[0]->body;
$_SESSION['adercontentbody'] = $body;
$created = friendlydate($content[0]->created);
$_SESSION['adercontentcreated'] = $created;
$author = getUser_info ( $content[0]->author, 'fullname' );
$_SESSION['adercontentauthor'] = $author;
$checked = $content[0]->status;
$_SESSION['ischecked'] = $checked;
$link = "preview_sitecontent.php?id=$id";
$tpl = new template_parser( '../templates/view_ader_content.tpl.php' );
$tags = array(
		'{TITLE}'		=> $title,
		'{CATEGORY}'	=> $category,
		'{DATE_CREATED}'=> $created,
		'{BODY}'		=> $body,
		'{AUTHOR}' 		=> $author,
		'{LINK}'		=> $link,	
		'{MESSAGE}' 	=> $resultdata[0]->message,
		'{SITENAME}' 	=> 'CMS Adminss',
		'{HEADER}' 		=> ' ',
		'{TOPNAV}' 		=> 'top_menu.php',
		'{SIDENAV}' 	=> 'user_menu2.php',
		'{FOOTER}' 		=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>