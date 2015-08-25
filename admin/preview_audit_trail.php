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
$fullname = getUser_info( $userID, 'fullname' );
$position = $usertype;
$sdmonth=$_SESSION['sdmonth'];
$sdday=$_SESSION['sdday'];
$sdyear=$_SESSION['sdyear'];
$edmonth=$_SESSION['edmonth'];
$edday=$_SESSION['edday'];
$edyear=$_SESSION['edyear'];	

$rpt_title .= " Audit trail report from $sdmonth $sdday, $sdyear to $edmonth $edday, $edyear. ";
$all_activity = $_SESSION['all_activity'];
for( $i = 0; $i < count($all_activity) ; $i++ ) {
	if ( $all_activity[$i]->userID ) {
		(($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '" align = "left">';
	
		$row_data .= '<td>';
		$row_data .= $i+1;
		$row_data .= '</td>';
	
		$row_data .= '<td align="left">';
		$row_data .= '&nbsp;'. getUser_info($all_activity[$i]->userID, 'username');
		$row_data .= '</td>';
		
		$row_data .= '<td align="left">';
		$row_data .= '&nbsp;'. $all_activity[$i]->activity;		
		$row_data .= '</td>';	
		
	
		$row_data .= '<td align="left">';
		$row_data .= '&nbsp;'. $all_activity[$i]->itemname;		
		
		$row_data .= '</td>';
			
		$row_data .= '<td>';
		$row_data .= '&nbsp;'.niceDate( $all_activity[$i]->activity_date );
		$row_data .= '</td>';
			
		$row_data .= '<td>';
		$row_data .= '&nbsp;'.niceTime( $all_activity[$i]->activity_date );
		$row_data .= '</td>';
		
		$row_data .= '</tr>';	
	}
}
$dateprepared = time();
$dateprepared = friendlyDate( $dateprepared ); // my friendly date - {mh}

// start compiling the page..
$tpl = new template_parser( '../templates/reports/preview_audit_trail.tpl.php' );
$tags = array(
		'{FULLNAME}' 	=> $fullname ,
		'{POSITION}' 	=> $position ,
		'{DATE_PREPARED}' => $dateprepared,		
		'{REPORT_TITLE}'=> $rpt_title,
		'{USERNAME}' 	=> 'Username',
		'{ACTION}' 		=> 'Activity',
		'{ITEMNAME}' 	=> 'Message',		
		'{MESSAGE}' 	=> $message,
		'{DATE}'		=> 'Date',
		'{TIME}'		=> 'Time',
		'{USERNAMES}'	=> $opt_username,				
		'{ACTIVITIES}'	=> $opt_activity,		
		'{PAGELINK}'	=> $pagelink->pagelinks , 			
		'{TABLE_DATA}'	=>	$row_data,
		'{SITENAME}' 	=> 'CMS Adminss',
		'{TOPNAV}' 		=> 'top_menu.php',
		'{FOOTER}' 		=>  'footer.php' 
		
		);
$tpl->parse_template( $tags );
print $tpl->display();

?>