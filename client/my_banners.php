<?php
require('../admin/coreclass.php');
include('../autoresponder/function_auto_res.php');
include('../autoresponder/responder.php');
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	//header('Location: ../index.php');
}
if ( isset($_SESSION['task']) && $_SESSION['task'] != '' ) {
	switch( $_SESSION['task']) {
		case 'edit':
			$message  = 'Changes of ' . $_SESSION['title'] . ' was succesfully saved ';
			break;
		case 'add':
			$message = 'Successfully saved banner ads : ' . $_SESSION['title'];
			break;
		case 'delete':	
			$message = 'Successfully delete the banner(s).';
			break;
	}
	unset ($_SESSION['task']);	
}

$db = new database;



$clientID = $_SESSION['clientID'];
unset($_SESSION['bannerID']); 
//print_r($_SESSION);
$sql = " select * from corporate_partners_imgs c ";
$sql .= " where c.banner_clientID='$clientID' and c.imageID = 0 order by banner_name asc";
//echo $sql;
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}

$cpimages = array();
while( $cpimages[] = $db->fetcharray());
//print_r( $cpimages);
$totalrows = count( $cpimages  );
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

$j = $start+1;
for( $i = $start; $i < $start+$limit; $i++ ) {
	if ( $cpimages[$i]->bannerID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id= "tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $j++	;
		$row_data .= '</td>';		

		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="cid[]" id="cb' . $i . '" value="' . $cpimages[$i]->bannerID . '" onClick="isChecked(this.checked);"/>';
		$row_data .= '</td>';			
			
		$row_data .= '<td>';
		$row_data .= '<a href="' . VIEW_BANNER_URL . $cpimages[$i]->bannerID . '">';		
		$row_data .= '&nbsp;'.$cpimages[$i]->banner_name;
		$row_data .= '</a>';		
		$row_data .= '</td>';

		$row_data .= '<td>';
		$row_data .= '&nbsp;'.($cpimages[$i]->banner_type );
		$row_data .= '</td>';			

		$row_data .= '<td ';
		switch( $cpimages[$i]->banner_show ) {
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
		$row_data .= '&nbsp;'.($cpimages[$i]->imptotal );
		$row_data .= '</td>';			
					

		$row_data .= '<td>';
		$row_data .= '&nbsp;'.($cpimages[$i]->impmade );
		$row_data .= '</td>';			

		$row_data .= '<td>';
		$impleft = $cpimages[$i]->imptotal - $cpimages[$i]->impmade;
		$row_data .= '&nbsp;'. $impleft;
		$row_data .= '</td>';			

		$row_data .= '<td>';
		$row_data .= '&nbsp;'.($cpimages[$i]->banner_clicks );
		$row_data .= '</td>';			

		$row_data .= '</tr>';
	}			
}

$stylesheet = ' ../templates/admin2.css';

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/my_banners.tpl.php' );
$tags = array(
	'{BANNER_NAME}' 	=> 'Banner Name',
	'{BANNER_SIZE}'		=> 'Banner Size',
	'{FILENAME}' 		=> 'FileName',	
	'{OWNER}' 			=> 'Owner',
	'{EMAIL}' 			=> 'Email',
	'{BANNER_STATUS}' 	=> 'Banner Status',
	'{IMPRESSIONS_PURCHASED}' => 'Total Impressions Purchased',
	'{IMPRESSIONS_MADE}' => 'Impressions Made',
	'{IMPRESSIONS_LEFT}' => 'Impressions Left',
	'{PAGELINK}'		=> $pagelink->pagelinks , 				
	'{CLICKS}'			=> 'Clicks',	
	'{PER_CLICKS}'		=> '% Clicks',	
	'{NUMITEMS}'		=> ''. $totalrows,
	'{TABLE_DATA}' 		=> $row_data ,
	'{MESSAGE}'			=> $message,
	'{STYLESHEET}'		=> $stylesheet,
	'{SITENAME}' 		=> 'CMS Adminss',
	'{TOPNAV}' 			=> 'client_top_menu.php',
	'{FOOTER}' 			=> '../admin/footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();




###################################################################
$data = get_email($clientID);
echo "<br>".$data['emailadd'];

$destination = $data['emailadd'];		#the client's email address
$origin = 'admin@localhost.com';		#admin's email address

$max = $cpimages[$i]->imptotal;
$current = $cpimages[$i]->impmade;
$status = $cpimages[$i]->banner_show;


$message = "To Our Valued Customer, <br><br>";
$message .= "We would like to inform you about the following regarding your advertisments:";				#the message
$message .="<br>Purchased Impressions: <strong>".$max."</strong>";
$message .="<br>Remaining Impressions: <strong>".$current."</strong>";
$message .="<br>Ad Status            : <strong>".$status."</strong>";


$responder = new auto_res($destination, $message, $origin);
	if($responder->notification_mail($max, $current, $status)) {
		$message .= "<br><br><br><br>";
		$message .= "The above message was successfully sent to: ";
		$message .= "Corporate Partner: <strong>".$data['clientname']."</strong>";
		$message .= "<br>Email Address: <strong>".$data['emailadd']."</strong>";
		$message .= "<br>On (Date): <strong>".date("Y-m-d")."</strong>";
		
		save_message( $userID_from, 1, date("Ymd"), 'Unread', 'Notification', $message );		#message to admin	
		save_message( 1, $clientID, date("Ymd"), 'Unread', 'Notification', $message );			#message to client
		
	} else {	
		$message .= "<br><br><strong>Fail To Send This message. Probably Invalid Email Address.</strong>";
		save_message( $userID_from, 1, date("Ymd"), 'Unread', 'Notification', $message );	    #message to admin if fail
	}
?>