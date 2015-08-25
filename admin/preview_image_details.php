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




$imageid = $_GET['imageID'];

$sql = " select * from stockphotos "; 
$sql .= " where imageID=" . intval( $imageid ) ;
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$image_details = array();
while( $image_details[] = $db->fetcharray() ) ;
$photoby = $image_details[0]->image_photographer_author;
$captions = $image_details[0]->image_captions;
$alt_text = $image_details[0]->alt_text;
$imageurl = makeRelativePath( $image_details[0]->image_filename, 4 );
$parts = pathinfo( $imageurl );
switch( $parts["extension"] ){
	case 'swf':
		$imgsrc = '<p>' . $imageurl . '" border="0" alt ="' . $alt_text  . '</p>';		
		break;
	default:	
		$imgsrc = '<img src="' . $imageurl . '" border="0" alt ="' . $alt_text  . '">';	
		break;
}


$tpl = new template_parser( '../templates/preview_image_details.tpl.php' );
$tags = array(
		'{IMAGETITLE}'			=> makeRelativePath($imageurl,6 ),
		'{IMAGE}'				=> $imgsrc,
		'{CLIENT_NAME}' 		=> $client_name,
		'{BANNER_NAME}' 		=> $banner_name,
		'{BANNER_DESCRIPTIONS}' => $banner_desc,
		'{PHOTO_BY}' 			=> $photoby,
		'{CAPTIONS}'			=> $captions,
		'{ALT_TEXT}' 			=> $alt_text,
		'{SITENAME}' 			=> 'CMS Adminss',
		'{HEADER}' 				=> ' ',
		'{TOPNAV}' 				=> '../admin/top_menu.php',
		'{FOOTER}' 				=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>