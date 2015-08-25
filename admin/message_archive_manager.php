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
//print_r($_SESSION);
if ( isset( $_SESSION['task'] ) && $_SESSION['task'] != '' ) {
	switch( $_SESSION['task']) {
		case 'delete':
			$message = ' Successfully delete the message ' .$_SESSION['title'];
			break;
		case 'archive':
			$message = ' Successfully delete the messages';
			break;
		case 'unarchive':
			$message = ' Successfully unarchive the message(s)';
			break;
		case 'delete_some_msgs':	
			$message = ' Successfully delete the message(s).'; 
			break;
		case 'failed_delete':		
			$message = ' Failed to delete the message.';
			break;
		case 'sent':		
			$message = ' Successfully sent the message ' .$_SESSION['title'];
			break;
	}
unset($_SESSION['task']);			
}
$msg = new messages();
$allmessages = $msg->view_all_archive_message ( $userID );

$totalrows = count( $allmessages );
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
//$allmessages = $msg->view_all_messages_limit ( $userID, $start, $limit );
//print_r( $allmessages );
$j = $start+1;
for( $i = $start; $i < $start+$limit; $i++ ) {
	if ( $allmessages[$i]->messageID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';			
		
		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="cid[]" id="cb' . $i . '" value="' . $allmessages[$i]->messageID . '" onClick="isChecked(this.checked);"/>';
		$row_data .= '</td>';			
		
		$row_data .= '<td>';
		$row_data .= '<a href="' . VIEW_MESSAGE_URL2 . $allmessages[$i]->messageID . '">';
		$row_data .= $allmessages[$i]->subject ;		
		$row_data .= '</a>';		
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$from = getUser_info ( $allmessages[$i]->userID_from, 'fullname' );
		$row_data .= '&nbsp;'.$from ;			
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$row_data .= friendlyDate ($allmessages[$i]->date_time) ;
		$row_data .= '</td>';

		$row_data .= '<td>';
		$row_data .= friendlyDate ($allmessages[$i]->date_archive) ;
		$row_data .= '</td>';

		$row_data .= '</tr>';
	}			
}

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/message_archive_manager.tpl.php' );
$tags = array(
		'{MESSAGE_SUBJECT}' => 'Subject',
		'{FROM}' 			=> 'From',
		'{DATE}' 			=> 'Date',
		'{DATE_DELETED}'	=> 'Date Last Deleted',		
		'{READ}' 			=> 'Read',
		'{MESSAGE}'			=> $message,
		'{TABLE_DATA}' 		=> $row_data,
		'{PAGELINK}'		=> $pagelink->pagelinks , 			
		'{NUMITEMS}'		=> ' '.$totalrows,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>