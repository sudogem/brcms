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

if ( isset($_SESSION['clientname'])) {
	unset($_SESSION['clientID']);
	unset($_SESSION['clientname']);
	unset($_SESSION['contactname']);	
	unset($_SESSION['email']);	
	unset($_SESSION['phoneno']);	
	unset($_SESSION['faxno']);			
	unset($_SESSION['extrainfo']);			
	unset($_SESSION['address']);				
}

$db = new database;



if ( isset( $_SESSION['task'] ) && $_SESSION['task'] != '' ) {
	switch ( $_SESSION['task'] ) {
		case 'edit':
			$message  = 'Changes of ' . $_SESSION['title'] . ' was succesfully saved ';
			break;
		case 'add':
			$message = 'Successfully saved client: ' . $_SESSION['title'];
			break;
		default:
			$message = '';
			break;	
	}
	unset ($_SESSION['task']);	
}

$sql = " select * from corporate_partners order by registerDate desc ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$clients = array();
while ( $clients[] = $db->fetcharray() );
//print_r($clients);
$totalrows = count( $clients );
$limit = 10;
$paging = ceil( $totalrows / $limit );
$scroll = 1;
$scrollnumber = 5;

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}else{
	$page = 1;
}
$start = $page * $limit - ($limit);
$pagelink = new paging( $page, $totalrows, $limit, $paging, $scroll, $scrollnumber );

$j = $start+1;
for( $i = $start; $i < $start+$limit ; $i++ ) {
	if ( $clients[$i]->clientID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';
					
		/*$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="checkitem[]" id="checkitem[]" value="' . $clients[$i]->articleID . '">';
		$row_data .= '</td>';*/			
		
		$row_data .= '<td>';
		$row_data .= '<a href="' . VIEW_CLIENT_PROFILE_URL . $clients[$i]->clientID . '">';
		$row_data .= '&nbsp;' . $clients[$i]->clientname ;
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		$row_data .= '<td >';
		$row_data .= '&nbsp;' . $clients[$i]->contactname ;
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$row_data .= '&nbsp;' . $clients[$i]->emailadd ;
		$row_data .= '</td>';

		$row_data .= '<td align="left">';
		if (!$clients[$i]->status) {
			$row_data .= '<img src="images/publish_x.png" width="12" height="12" border="0" alt="" />';
		}
		else{
			$row_data .= '<img src="images/tick.png" width="12" height="12" border="0" alt="" />';	
		}
		$row_data .= '</td>';		


		$row_data .= '<td>';
		$row_data .= count( getClientActiveBanners( $clients[$i]->clientID ) )-1;
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$lastvisitDate = ($clients[$i]->lastvisitDate ) ? 
			friendlyDate ( $clients[$i]->lastvisitDate ) : '0';
		$row_data .= '&nbsp;'.$lastvisitDate;
		$row_data .= '</td>';
		
		
		$row_data .= '</tr>';
	}			
}

$stylesheet = ' ../templates/admin2.css';
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/clients_manager.tpl.php' );
$tags = array(
	'{CLIENT_NAME}' 	=> 'Client Name',
	'{OWNER}' 			=> 'Contact Name',
	'{EMAIL}' 			=> 'Email',
	'{STATUS}' 			=> 'Enabled',		
	'{REGISTER_DATE}' 	=> 'Last Visit Date',
	'{AUTHOR}' 			=> 'Author',
	'{DATE_CREATED}'	=> 'Date Created',
	'{TABLE_DATA}' 		=> $row_data ,
	'{STAGEID}' 		=> 'Stage',
	'{PAGELINK}'		=> $pagelink->pagelinks , 			
	'{MESSAGE}'			=> $message,
	'{SITENAME}' 		=> 'CMS Adminss',
	'{ACTIVEBANNERS}'	=> '# of Active Banners',
	'{TOPNAV}' 			=> 'top_menu.php',
	'{FOOTER}' 			=> 'footer.php' 
);
$tpl->parse_template( $tags );
print $tpl->display();
?>