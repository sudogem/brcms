<?php
require ( '../admin/coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: ../index.php');
}

if ( isset($_SESSION['clientID'])) { 
	$userID = $_SESSION['clientID'];
}

if ( isset( $_SESSION['task'] ) && $_SESSION['task'] != '' ) {
	switch( $_SESSION['task']) {
		case 'delete':
			$message = ' Successfully delete the message ' .$_SESSION['title'];
			break;
		case 'failed_delete':		
			$message = ' Failed to delete the message ' . $_SESSION['title'];
			break;
		case 'sent':		
			$message = ' Successfully sent the message ' .$_SESSION['title'];
			break;
	}
unset($_SESSION['task']);			
}
$msg = new messages();
$allmessages = $msg->view_client_messages ( $userID );

//print_r( $allmessages );
for( $i = 0; $i < count( $allmessages ); $i++ ) {
	if ( $allmessages[$i]->messageID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $i+1;
		$row_data .= '</td>';			
		
		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="checkitem[]" id="checkitem[]" value="' . $allmessages[$i]->articleID . '">';
		//$row_data .= '<input type="checkbox" onclick="isChecked(this.checked);" name="cid[]" id="cb1" value="' . $allmessages[$i]->articleID . '">';
		$row_data .= '</td>';			
		
		$row_data .= '<td>';
		$row_data .= '<a href="' . VIEW_MESSAGE_URL . $allmessages[$i]->messageID . '">';
		$row_data .= $allmessages[$i]->subject ;		
		$row_data .= '</a>';		
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$from = getUser_info ( $allmessages[$i]->userID_from, 'fullname' );
		$row_data .= $from ;			
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$row_data .= friendlyDate ($allmessages[$i]->date_time) ;
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$row_data .=  $allmessages[$i]->state ;
		$row_data .= '</td>';
		$row_data .= '</tr>';
	}			
}

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/private_message.tpl.php' );
$tags = array(
		'{MESSAGE_SUBJECT}' => 'Subject',
		'{FROM}' 			=> 'From',
		'{DATE}' 			=> 'Date',
		'{READ}' 			=> 'Read',
		'{MESSAGE}'			=> $message,
		'{TABLE_DATA}' 		=> $row_data,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> '../templates/client_top_menu.tpl.php',
		'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>