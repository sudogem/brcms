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

$bannerID = $_GET['bannerID'];
$_SESSION['bannerID'] = $bannerID;

$db = new database;



$sql = " select * from corporate_partners_imgs cp ";
$sql .= " where cp.bannerID=" . intval($bannerID);
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
while( $cpimages[] = $db->fetcharray());
$_SESSION['banner_name'] = $cpimages[0]->banner_name;
// clients 
$sql = "select * from corporate_partners order by clientname";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$clients = array();
while ( $row = $db->fetcharray() )$clients[] = $row;//print_r($clients);
foreach( $clients as $field => $data ) {
//		echo $data->clientID ;
	if ( $data->clientID == $cpimages[0]->banner_clientID ) {
		$optclients .= '<option value="' . $data->clientID . '" selected >';
		$optclients .= $data->clientname ;
		$optclients .= '</option>';
	}
	else{

		$optclients .= '<option value="' . $data->clientID . '">';
		$optclients .= $data->clientname ;
		$optclients .= '</option>';
	}
}

// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->viewing_bannerads, 'Viewing the banner '. $cpimages[0]->banner_name );

if ( $cpimages[0]->banner_imageurl != "" ) {
	$bannerimg = '<img src="'. makeRelativePath($cpimages[0]->banner_imageurl, 2) . '" name="imagelib" >';
}
else{
	$bannerimg = '<img src="images/ads/blank.png" name="imagelib">';
}

if ($cpimages[0]->banner_show){
	$showbanner .= '<input name="showbanner" type="radio" value="1" checked >Yes';
	$showbanner .= '<input name="showbanner" type="radio" value="0" >No';
}
else{
	$showbanner .= '<input name="showbanner" type="radio" value="1" >Yes';
	$showbanner .= '<input name="showbanner" type="radio" value="0" checked >No';
}

/**
 * Create an array of article status for the option lists
*/
$bannertype = array( "148x300", "180x700" ,"600x140", "800x140" ); 
foreach( $bannertype as $idx => $value ) {
	if ( $value == $cpimages[0]->banner_type ) {
		$optbanner .= "<option value='$value' selected>$value</option>";	
	}
	else{
		$optbanner .= "<option value='$value' >$value</option>";		
	}
}
$impleft = $cpimages[0]->imptotal - $cpimages[0]->impmade;
$stylesheet = ' ../templates/admin2.css';
$task = ' Edit ';
$tpl = new template_parser( '../templates/view_banner.tpl.php' );
$tags = array(
	'{FROM_MONTH}'		=> $optmonth,
	'{FROM_DAY}'		=> $optday,
	'{FROM_YEAR}'		=> $optyear,
	'{BANNERNAME}' 		=> $cpimages[0]->banner_name,
	'{CLIENTNAMES}'		=> $optclients,
	'{OWNER}' 			=> 'Owner',
	'{EMAIL}' 			=> 'Email',
	'{BANNERDESC}'		=> $cpimages[0]->banner_description,
	'{BANNERSIZE}'		=> $optbanner,
	'{IMPTOTAL}'		=> $cpimages[0]->imptotal,
	'{CREDITS}'			=> $cpimages[0]->impbalance,
	'{IMPMADE}'			=> $cpimages[0]->impmade,
	'{IMPLEFT}'			=> ' '.$impleft,
	'{CLICKS}'			=> $cpimages[0]->banner_clicks,
	'{BANNERIMAGE}' 	=> $bannerimg,
	'{CLIENTNAME}'		=> getBannerclient_info($cpimages[0]->banner_clientID, 'clientname' ),
	'{BANNERURL}' 		=> makeRelativePath($cpimages[0]->banner_imageurl, 9) ,
	'{CLICKURL}' 		=> $cpimages[0]->banner_clickURL,	
	'{YESNO}'			=> $showbanner,	
	'{MESSAGE}'			=> $message,
	'{TASK}'			=> $task,	
	'{STYLESHEET}'		=> $stylesheet,
	'{SITENAME}' 		=> 'CMS Adminss',
	'{TOPNAV}' 			=> 'top_menu.php',
	'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();

?>