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




$sql = " select * from user_log ";
if (!( $result = $db->query( $sql ) ) ) {
	die ( 'Error :' . $db->error() );
}

$user_log = array();
while ( $user_log[] = $db->fetcharray() );
$db->freeresult();


for( $i = 0; $i < count( $user_log )-1; $i++ ){
 	(($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
	$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '" align = "center">';
	
	$row_data .= '<td align="left">';
	$row_data .= '<a href="' . VIEW_PROFILE_URL . $user_log[$i]->userID . '">';
	//$row_data .= '<input type="hidden" value = "' . $user_log[$i]->userID . '">';
	$user_fullname = getUser_info ( $user_log[$i]->userID , 'fullname' );
	$row_data .= $user_fullname;
	$row_data .= $user_log[$i]->fullname;
	$row_data .= '</a>';
	$row_data .= '</td>';
	
	$row_data .= '<td>';
	$username = getUser_info ( $user_log[$i]->userID , 'username' );
	$row_data .= $username;
	$row_data .= '</td>';
	
	$row_data .= '<td align = "center" >';
	$row_data .= '<label>';
	$row_data .= $user_log[$i]->log_day;
	$row_data .= '</label>';
	$row_data .= '</td>';
	
	$row_data .= '<td>';
	$row_data .= '<label>';
	$row_data .= $user_log[$i]->log_month;
	$row_data .= '</label>';
	$row_data .= '</td>';
	
	$row_data .= '<td>';
	$row_data .= '<label>';
	$row_data .= $user_log[$i]->log_year;
	$row_data .= '</label>';
	$row_data .= '</td>';
	
	$row_data .= '<td>';
	$row_data .= '<label>';
	$log_time = $user_log[$i]->log_hour .' :'. $user_log[$i]->log_minute .' :'. $user_log[$i]->log_second .' '. $user_log[$i]->log_am_pm;
	$row_data .= $log_time;
	$row_data .= '</label>';
	$row_data .= '</td>';
	
	$row_data .= '</tr>';
}

// cge na inday beh... i-parse na ning akoa..hinaya ug parse hah ? ..  - {mh} 
$tpl = new template_parser( '../templates/user_log_manager.tpl.php' );

$tags = array(
		'{TABLE_DATA}'	=> $row_data,
		'{FULLNAME}'	=> 'FullName',
		'{USERNAME}' 	=> 'Username',
		
		'{DAY}' 		=> 'Day',
		'{MONTH}' 		=> 'Month',
		'{YEAR}'		=> 'Year', 
		'{TIME}'		=> 'Time',
		
		'{BREADCRUMB}'	=> $url,
		'{SITENAME}' 	=> 'CMS Adminss',
		'{HEADER}' 		=> ' ',
		
		'{TOPNAV}' 		=> 'top_menu.php',
		'{SIDENAV}' 	=> 'user_menu2.php',
		'{CONTENT}' 	=> 'main_content.php',
		'{FOOTER}' 		=>  'footer.php' 
);
//print_r($tags);		
$tpl->parse_template( $tags );
print $tpl->display();



?>