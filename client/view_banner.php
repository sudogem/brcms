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



$sql = "select * from corporate_partners_imgs cp 
		where bannerID='$bannerID' ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$banner = array();
if ( $banner[] = $db->fetcharray());
//print_r($banner);
$db->freeresult();

$sql = "select distinct(banner_imageurl) from corporate_partners_imgs cp 
		where banner_clientID='$clientID' ";
		 
echo $sql;
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$ads = array();
while( $ads[] = $db->fetcharray() );
//print_r($ads);
/**
 * Populate all the corporate partners into an array..
 */
$bannerurl = '';
foreach( $ads as $field => $data ) {
	if ( $data->banner_imageurl == $banner[0]->banner_imageurl ) {
		$imgurl = $data->banner_imageurl;
		$bannerurl .= '<option value="' . $imgurl . '" selected >';
		$bannerurl .= makeRelativePath($imgurl, 9);
		$bannerurl .= '</option>';
	}
	else{
		$imgurl = $data->banner_imageurl;
		$bannerurl .= '<option value="' . $imgurl . '" >';
		$bannerurl .= makeRelativePath($imgurl, 9);
		$bannerurl .= '</option>';
	}
}

//echo $bannerurl;
if ( $data->banner_imageurl ) {
	$bannerimg = '<img src="'. makeRelativePath($data->banner_imageurl, 2) . '" name="imagelib" >';
}
else{
	$bannerimg = '<img src="images/ads/blank.png" name="imagelib">';
}

/**
 * Create an array of article status for the option lists
*/
$bannertype = array( "148x300", "800x140", "600x140", "180x700" ); 
foreach( $bannertype as $idx => $value ) {
	if ( $value == $ads[0]->banner_type ) {
		$optbanner .= "<option value='$value' selected>$value</option>";	
	}
	else{
		$optbanner .= "<option value='$value' >$value</option>";		
	}
}
/**
 * Get the impressions left of the banner
 */
$impleft = $banner[0]->imptotal - $banner[0]->impmade;
/**
 * Get the banner status
 */ 
switch( $banner[0]->banner_show ) {
	case 1:
		$status = '<span class="green"><b>published</span>';
		break;
	case 0:
		$status = '<span class="viola"><b>not published</span>';
		break;
	case -1:
		$status = '<span class="red"><b>expired</span>';
		break;		
}

$stylesheet = ' ../templates/admin2.css';
$task = ' Edit ';
$tpl = new template_parser( '../templates/view_banner_clients_editable.tpl.php' );
$tags = array(
	'{BANNERNAME}' 		=> $banner[0]->banner_name,
	'{OWNER}' 			=> 'Owner',
	'{EMAIL}' 			=> 'Email',
	'{BANNERDESC}'		=> $banner[0]->banner_description,
	'{CLICKS}'			=> $banner[0]->banner_clicks,
	'{BANNERIMAGE}' 	=> $bannerimg,
	'{CLIENTNAME}'		=> $banner[0]->client_name,
	'{STATUS}'			=> $status,
	'{BANNERURL}' 		=> $bannerurl,
	'{BANNERTYPE}'		=> $optbanner,
	'{CLICKURL}' 		=> $banner[0]->banner_clickURL,	
	'{BANNERSIZE}'		=> $banner[0]->banner_type,	
	'{IMPTOTAL}'		=> $banner[0]->imptotal,	
	'{IMPMADE}'			=> $banner[0]->impmade,	
	'{IMPLEFT}'			=> ' '.$impleft,	
	'{CLICKS}'			=> $banner[0]->banner_clicks,	
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