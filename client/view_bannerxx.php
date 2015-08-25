<?php
require ( '../admin/coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: ../index.php');
}

$bannerID = $_GET['bannerID'];
$_SESSION['bannerID'] = $bannerID;
$clientID = $_SESSION['clientID'];

//print_r($_SESSION);
$db = new database;



$sql = " select * from corporate_partners_imgs cp ";
$sql .= " where cp.bannerID=" . intval($bannerID);
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
while( $cpimages[] = $db->fetcharray());
$sql = " select * from corporate_partners_imgs cp , stockphotos s 
         where cp.banner_clientID= $clientID
         and s.imageID=cp.imageID ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$ads = array();
while( $ads[] = $db->fetcharray() );

/**
 * Populate all the corporate partners into an array..
 */
$bannerurl = '';
for( $i=0; $i< count($ads); $i++) {
	foreach( $ads as $field => $data ) {
		if ( $field == 'bannerID') {
			$imgurl = $ads[$i]->banner_imageurl;
			$bannerurl .= '<option value="' . $imgurl . '">';
			//$bannerurl .= '<option value="' . $ads[$i]->imageID . '">';
			$bannerurl .= makeRelativePath( $imgurl, 9);
			$bannerurl .= '</option>';
		}
	}
}

/**
 * Create an array of article status for the option lists
*/
$bannertype = array( "148x300", "500x100", "320x100", "170x100", "180x400" , "180x200", "600x100" ); 
foreach( $bannertype as $idx => $value ) {
	if ( $value == $_SESSION['optstatus'] ) {
		$optbanner .= "<option value='$value' selected>$value</option>";	
	}
	else{
		$optbanner .= "<option value='$value' >$value</option>";		
	}
}
// set default blank image..
$bannerimg = '<img src="../images/blank.png" name="imagelib" >';			

/*if ( $cpimages[0]->banner_imageurl ) {
	$bannerimg = '<img src="'. makeRelativePath($cpimages[0]->banner_imageurl, 2) . '" name="imagelib" >';
}
else{
	$bannerimg = '<img src="images/ads/blank.png" name="imagelib">';
}*/

$stylesheet = ' ../templates/admin2.css';
$task = ' Edit ';
$tpl = new template_parser( '../templates/view_banner.tpl.php' );
$tags = array(
	'{BANNERNAME}' 		=> $cpimages[0]->banner_name,
	'{OWNER}' 			=> 'Owner',
	'{EMAIL}' 			=> 'Email',
	'{BANNERDESC}'		=> $cpimages[0]->banner_description,
	'{CLICKS}'			=> $cpimages[0]->banner_clicks,
	'{BANNERIMAGE}' 	=> $bannerimg,
	'{CLIENTNAME}'		=> $cpimages[0]->client_name,
	'{BANNERURL}' 		=> $bannerurl,
	'{BANNERTYPE}' 		=> $optbanner,
	'{CLICKURL}' 		=> $cpimages[0]->banner_clickURL,	
	
	'{MESSAGE}'			=> $message,
	'{TASK}'			=> $task,	
	'{STYLESHEET}'		=> $stylesheet,
	'{SITENAME}' 		=> 'CMS Adminss',
	'{TOPNAV}' 			=> 'client_top_menu.php',
	'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();

?>