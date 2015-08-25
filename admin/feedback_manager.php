<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
session_start();
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
			$message = 'Successfully saved the changes of profile: ' . $_SESSION['title'];
			break;
		case 'add':
			$message = 'Successfully saved the profile: ' . $_SESSION['title'];
			break;
		case 'delete':
			$message = 'Successfully delete the feedbacks';
			break;
	}
unset($_SESSION['task']);			
}
$_SESSION['commenttype']= 'feedback';
$fb  = new feedbacks();
$feedback = $fb->view_all_feedbacks(1);
$totalrows = count( $feedback );
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
for( $i = $start; $i < ($start+$limit); $i++ ){
	if ( $feedback[$i]->autoNumber ) {
		(($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '" align = "left">';
	
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';

		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="cid[]" id="cb' . $i . '" value="' . $feedback[$i]->autoNumber . '" onClick="isChecked(this.checked);"/>';
		$row_data .= '</td>';			
		
		$row_data .= '<td align="left">';
		$row_data .= '<a href="' . VIEW_FEEDBACK_DETAIL . $feedback[$i]->autoNumber . '">';
		$row_data .= '<input type="hidden" value = "' . $feedback[$i]->autoNumber . '">';
		$row_data .= '&nbsp;'. $feedback[$i]->name;
		$row_data .= '</td>';
		
		$row_data .= '<td class="red" >';
		$row_data .= '&nbsp;<a href="mailto:'.$feedback[$i]->emailAddress . '">'.$feedback[$i]->emailAddress;
		$row_data .= '</td>';
		
		$row_data .= '<td align="left" class="blue2" >';
		$row_data .= '&nbsp;'. ($feedback[$i]->feedback);		
		$row_data .= '</td>';	

		$row_data .= '<td align="left" class="blue2" >';
		$row_data .= '&nbsp;'. friendlydate($feedback[$i]->feedbackDate);		
		$row_data .= '</td>';	
		
		$row_data .= '<td align="left" class="blue2" >';
		$row_data .= '&nbsp;'. ($feedback[$i]->state);		
		$row_data .= '</td>';	
		
		$row_data .= '</tr>';
	}
}

// start generating page
$tpl = new template_parser( '../templates/feedback_manager.tpl.php' );
$tags = array(
		'{FULLNAME}' 	=> 'Author',
		'{FEEDBACK}' 	=> 'Feedback',
		'{EMAIL}'		=> 'Email',
		'{DATE}'		=> 'Date',
		'{TABLE_DATA}' 	=> $row_data,
		'{NUMITEMS}'	=> ''. $totalrows,
		'{MESSAGE}' 	=> $message,
		'{STATUS}'		=> 'Read',
		'{PAGELINK}'	=> $pagelink->pagelinks , 			
		'{SITENAME}' 	=> 'CMS Adminss',
		'{HEADER}' 		=> ' ',
		'{TOPNAV}' 		=> 'top_menu.php',
		'{FOOTER}' 		=> 'footer.php' 
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>