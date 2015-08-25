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




$sql = "select * from corporate_partners order by clientname";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$clients = array();
while ( $row = $db->fetcharray() )$clients[] = $row;
foreach( $clients as $field => $data ) {
	$optclients .= '<option value="' . $data->clientID . '">';
	$optclients .= $data->clientname ;
	$optclients .= '</option>';
}



/**
 * Create an array of article status for the option lists
*/
$bannertype = array( "148x300", "180x700" ,"600x140", "800x140" ); 
foreach( $bannertype as $idx => $value ) {
	if ( $value == $ads[0]->banner_type ) {
		$optbanner .= "<option value='$value' selected>$value</option>";	
	}
	else{
		$optbanner .= "<option value='$value' >$value</option>";		
	}
}

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/add_new_banner_clients2.tpl.php' );
$tags = array(
	'{BANNERSIZE}' 		=> $optbanner,
	'{OWNER}' 			=> 'Client Name',
	'{CLIENTNAMES}'		=> $optclients,
	'{BANNER_IMAGE}'	=> 'Banner Image',
	'{URL}'				=> 'Click URL',
	'{COST}'			=> $cost,
	'{IMPRESSIONS_MADE}'=> 'Impressions Made',
	'{IMPRESSIONS_LEFT}'=> 'Impressions Left',
	'{STATUS}' 			=> 'Status',
	'{BANNER_CLICKS}'	=> '# of Clicks',
	'{PAGELINK}'		=> $pagelink->pagelinks , 			
	'{TABLE_DATA}' 		=> $row_data ,
	'{MESSAGE}'			=> $message,
	'{SITENAME}' 		=> 'CMS Adminss',
	'{TOPNAV}' 			=> 'top_menu.php',
	'{FOOTER}' 			=> 'footer.php' 
);
$tpl->parse_template( $tags );
print $tpl->display();
?>