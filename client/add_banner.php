<?php
require( '../admin/coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: ../index.php');
}

// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: ../index.php');
}
//print_r($_SESSION);
//print_r($_POST);
unset($_SESSION['imageID']);// remove pre-existing sessions
unset($_SESSION['bannerID']);
$clientID = $_SESSION['clientID'];

$db = new database;



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

// set default blank image..
$bannerimg = '<img src="../images/blank.png" name="imagelib" >';			


/**
 * Create an array of article status for the option lists
*/
$bannertype = array( "148x300", "800x140", "600x140", "180x700" ); 
foreach( $bannertype as $idx => $value ) {
	if ( $value == $_SESSION['optstatus'] ) {
		$optbanner .= "<option value='$value' selected>$value</option>";	
	}
	else{
		$optbanner .= "<option value='$value' >$value</option>";		
	}
}
			
// ok baby, let start compiling the page now..go! go! go! {mh}
$stylesheet = ' ../templates/admin2.css';
$tpl = new template_parser( '../templates/add_banner.tpl.php' );
$tags = array(
	'{BANNER_NAME}' 	=> 'Banner Name',
	'{OWNER}' 			=> 'Owner',
	'{EMAIL}' 			=> 'Email',
	'{STATUS}' 			=> 'Status',
	'{CLICKS}'			=> $clicks,
	'{BANNERIMAGE}' 	=> $bannerimg ,
	'{BANNERTYPE}' 		=> $optbanner,
	'{CLIENTNAME}'		=> $_SESSION['clientname'],
	'{BANNERURL}' 		=> $bannerurl ,
	'{MESSAGE}'			=> $message,
	'{STYLESHEET}'		=> $stylesheet,
	'{SITENAME}' 		=> 'CMS Adminss',
	'{TOPNAV}' 			=> 'client_top_menu.php',
	'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>