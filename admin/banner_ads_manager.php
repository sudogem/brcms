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
if ( isset( $_SESSION['task'] ) && $_SESSION['task'] != '' ) {
	switch ( $_SESSION['task'] ) {
		case 'edit':
			$message  = 'Changes of ' . $_SESSION['title'] . ' was succesfully saved ';
			break;
		case 'add':
			$message = 'Successfully saved banner ads: ' . $_SESSION['title'];
			break;
		default:
			$message = '';
			break;	
	}
	unset ($_SESSION['task']);	
}

$db = new database;



$sql = " select * from corporate_partners_imgs where imageID = 0 order by bannerID desc ";
//echo $sql;	   
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$clients_images = array();
while ( $row = $db->fetcharray() )$clients_images[] = $row;
$totalrows = count( $clients_images );
$limit = 10;
$paging = ceil( $totalrows / $limit );
$scroll = 0;
$scrollnumber = 5;

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}else{
	$page = 1;
}
$start = $page * $limit - ($limit);
$pagelink = new paging( $page, $totalrows, $limit, $paging, $scroll, $scrollnumber );

//print_r($clients_images);
$j = $start+1;
for( $i = $start; $i < $start+$limit ; $i++ ) {
	if ( $clients_images[$i]->bannerID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';
					
		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="cid[]" id="cb' . $i . '" value="' . $clients_images[$i]->bannerID . '" onClick="isChecked(this.checked);"/>';
		$row_data .= '</td>';			
		
		$row_data .= '<td>';
		$row_data .= '<a href="' . VIEW_BANNER_URL . $clients_images[$i]->bannerID . '">';
		$row_data .= '&nbsp;'.$clients_images[$i]->banner_name;
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		$row_data .= '<td class="green">';
		$client_name = getBannerclient_info( $clients_images[$i]->banner_clientID, 'clientname' );
		$row_data .= '&nbsp;' . $client_name;
		$row_data .= '</td>';
		

		$row_data .= '<td class="blue2">';
		$row_data .= '<a href="#"  onClick=popupWindow("' . makeRelativePath($clients_images[$i]->banner_imageurl,4) . '","win1",650,350,"yes","yes");>';
		$row_data .= '&nbsp;'. makeRelativePath($clients_images[$i]->banner_imageurl, 9) ;
		$row_data .= '</td>';

		$row_data .= '<td class="blue2">';
		if ( checkhttptext( $clients_images[$i]->banner_clickURL  )){
			$url =splithttptext($clients_images[$i]->banner_clickURL );
			$row_data .= '<a href="' . $clients_images[$i]->banner_clickURL  . '">' . $url[1] . '</a>';								
		}
		else{
			$row_data .= '<a href="http://' . $clients_images[$i]->banner_clickURL. '">' . $clients_images[$i]->banner_clickURL . '</a>';											
		}
		$row_data .= '</td>';

		
		$row_data .= '<td ';
		switch( $clients_images[$i]->banner_show ) {
			case 1:
				$row_data .= 'class="green">';
				$row_data .= 'published';
				break;
			case 0:
				$row_data .= 'class="viola">';
				$row_data .= 'not published';
				break;
			case -1:
				$row_data .= 'class="red">';
				$row_data .= 'expired';
				break;		
		}
		$row_data .= '</td>';


		$row_data .= '<td>';
		$row_data .= '&nbsp;'.($clients_images[$i]->imptotal );
		$row_data .= '</td>';			

		
		$row_data .= '<td>';
		$row_data .= '&nbsp;'.($clients_images[$i]->impmade );
		$row_data .= '</td>';			

		$row_data .= '<td>';
		$impleft = $clients_images[$i]->imptotal - $clients_images[$i]->impmade;
		$row_data .= '&nbsp;'. $impleft;
		$row_data .= '</td>';			

		$row_data .= '<td>';
		$row_data .= '&nbsp;'.($clients_images[$i]->banner_clicks );
		$row_data .= '</td>';			
		
		$row_data .= '</tr>';
	}			
}

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/banner_clients.tpl.php' );
$tags = array(
	'{BANNER_NAME}' 	=> 'Banner Name',
	'{OWNER}' 			=> 'Client Name',
	'{BANNER_IMAGE}'	=> 'Banner Image',
	'{URL}'				=> 'Click URL',
	'{IMPRESSIONS_PURCHASED}' => 'Total Impressions Purchased',
	'{IMPRESSIONS_MADE}'=> 'Impressions Made',
	'{IMPRESSIONS_LEFT}'=> 'Impressions Left',
	'{STATUS}' 			=> 'Banner Status',
	'{NUMITEMS}'		=> ''. $totalrows,
	'{BANNER_CLICKS}'	=> 'Clicks',
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