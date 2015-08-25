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
	switch( $_SESSION['task']) {
		case 'edit':
			$message  = 'Changes of "' . $_SESSION['title'] . '" was succesfully saved ';
			break;
		case 'add':
			$message = 'Successfully saved quote "' . $_SESSION['title']. '"';
			break;
	}
unset($_SESSION['title']);	
unset($_SESSION['task']);			
}
$quote = new quote_of_the_day();
$allquotes = $quote->view_all_quotes( );

$totalrows = count( $allquotes );
$limit = 5;
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
	if ( $allquotes[$i]->quoteID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';			
		
		/*$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="cid[]" id="cb' . $i . '" value="' . $allquotes[$i]->quoteID . '" onClick="isChecked(this.checked);"/>';
		$row_data .= '</td>';*/			
		
		$row_data .= '<td>';
		$row_data .= '<a href="' . VIEW_QUOTE_DETAIL_URL . $allquotes[$i]->quoteID . '">';
		$row_data .=  $allquotes[$i]->quote_message;
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$row_data .= $allquotes[$i]->quote_author;
		$row_data .= '</td>';
		
		
		$row_data .= '</tr>';
	}			
}
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/quote_of_the_day.tpl.php' );
$tags = array(
		'{MESSAGE_SUBJECT}' => 'Subject',
		'{FROM}' 			=> 'From',
		'{DATE}' 			=> 'Date',
		'{READ}' 			=> 'Read',
		'{MESSAGE}'			=> $message,
		'{TABLE_DATA}' 		=> $row_data,
		'{PAGELINK}'		=> $pagelink->pagelinks , 			
		'{NUMITEMS}'		=> ' '.$totalrows,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{QUOTE_MSG}'		=> 'Quote',
		'{QUOTE_AUTHOR}'	=> 'Author',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>