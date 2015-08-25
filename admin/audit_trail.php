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



$activity = new activity;
$activities = $activity->lists_all_activity();
/**
 * Populate all the activities into an array..
 */
$opt_activity = '';
foreach( $activities as $field => $data ) {
	if ( $data->activity == $_SESSION['pactivity']) {
		$opt_activity .= '<option value="' . $data->activity . '" selected >';
		$opt_activity .= $data->activity;
		$opt_activity .= '</option>';
	}
	else{
		$opt_activity .= '<option value="' . $data->activity . '">';
		$opt_activity .= $data->activity;
		$opt_activity .= '</option>';
	}
}
/**
 * Populate all the content users into an array..
 */
$sql = " select userID, username from content_users ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$users = array();
while( $row = $db->fetcharray() ) {
	$users[] = $row; 
}
$db->freeresult();
$opt_username = '';
foreach( $users as $field => $data ) {
	if ( ($data->userID == $_SESSION['puserid']) ) {
		$opt_username .= '<option value="' . $data->userID . '" selected >';
		$opt_username .= $data->username;
		$opt_username .= '</option>'; 
	}
	else{
		$opt_username .= '<option value="' . $data->userID . '">';
		$opt_username .= $data->username;
		$opt_username .= '</option>';
	}
}

// do i hav to remove existing session vars???
/*unset($_SESSION['pactivity']);
unset($_SESSION['puserid']);
unset($_SESSION['pstartdate'] );
unset($_SESSION['penddate']);
*/
if (isset($_POST['submit'])) {
	$_SESSION['submit'] = 'submit';
	$puserid = $_POST['userid'];
	$pactivity = $_POST['activity'];
	//$pstartdate = $_POST['from_year']."-".$_POST['from_month']."-".$_POST['from_date'];;
	//$penddate = $_POST['end_year']."-".$_POST['end_month']."-".$_POST['end_date'];
	$day = $_POST['from_date'];
	$month = $_POST['from_month'];
	$year = $_POST['from_year'];
	$day2 = $_POST['end_date'];
	$month2 = $_POST['end_month'];
	$year2 = $_POST['end_year'];
	
	$sdmonth = strdate("$month",'');
	$edmonth = strdate("$month2",'');
	$_SESSION['sdmonth'] = $sdmonth;
	$_SESSION['sdday'] = $day;
	$_SESSION['sdyear'] = $year;	

	$_SESSION['edmonth'] = $edmonth;
	$_SESSION['edday'] = $day2;	
	$_SESSION['edyear'] = $year2;	
	
	$pstartdate = mktime(0,0,0, $month, $day, $year);
	$penddate = mktime(0,0,0, $month2, $day2, $year2);
	/*echo 't1='.$t1;
	echo 't2='.$t2;
	echo 'sd='.$pstartdate;
	echo 'ed='.$penddate;*/
	//print_r($_POST); 	
	$_SESSION['puserid'] = $puserid;
	$_SESSION['pactivity'] = $pactivity;
	$_SESSION['pstartdate'] = $pstartdate;
	$_SESSION['penddate'] = $penddate;
	$opt_username = '';// obtain lists of content users..
	foreach( $users as $field => $data ) {
		if ( ($data->userID == $_SESSION['puserid']) ) {
			$opt_username .= '<option value="' . $data->userID . '" selected >';
			$opt_username .= $data->username;
			$opt_username .= '</option>'; 
		}
		else{
			$opt_username .= '<option value="' . $data->userID . '">';
			$opt_username .= $data->username;
			$opt_username .= '</option>';
		}
	}
	$opt_activity = ''; // obtain lists of activities..
	foreach( $activities as $field => $data ) {
		if ( $data->activity == $_SESSION['pactivity']) {
			$opt_activity .= '<option value="' . $data->activity . '" selected >';
			$opt_activity .= $data->activity;
			$opt_activity .= '</option>';
		}
		else{
			$opt_activity .= '<option value="' . $data->activity . '">';
			$opt_activity .= $data->activity;
			$opt_activity .= '</option>';
		}
	}
}
$all_activity = $activity->view_activity( $_SESSION['puserid'], $_SESSION['pactivity'], $_SESSION['pstartdate'], $_SESSION['penddate'] );         	
$_SESSION['all_activity'] = $all_activity;

//unset($_SESSION['puserid']);
//unset($_SESSION['pactivity'] );
$totalrows = count( $all_activity );
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
	if ( $all_activity[$i]->userID ) {
		(($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '" align = "left">';
	
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';
	
		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="cid[]" id="cb' . $i . '" value="' . $all_activity[$i]->userID . '" onClick="isChecked(this.checked);"/>';
		$row_data .= '</td>';			
		
		$row_data .= '<td align="left">';
		$row_data .= '<a href="' . VIEW_PROFILE_URL_MANAGER . $all_activity[$i]->userID . '">';
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






#Month
for($i=1; $i<=12 ; $i++) {
	$from_month .= '<option value ="'.date("m", mktime(0,0,0, $i, 1,0)).'">'.date("M", mktime(0,0,0, $i, 1,0)).'</option>';
}
for($i=1; $i<=12 ; $i++) {
	$end_month .= '<option value ="'.date("m", mktime(0,0,0, $i, 1,0)).'">'.date("M", mktime(0,0,0, $i, 1,0)).'</option>';
}

#Day
for($i=1; $i<=31 ; $i++) {
	$from_day .= '<option value ="'.date("d", mktime(0,0,0, 0, $i,0)).'">'.date("d", mktime(0,0,0, 0, $i,0)).'</option>';
}
for($i=1; $i<=31 ; $i++) {
	$end_day .= '<option value ="'.date("d", mktime(0,0,0, 0, $i,0)).'">'.date("d", mktime(0,0,0, 0, $i,0)).'</option>';
}

#Year // COMMENTS: kindly change the year into a dynamic
$from_year = '<option value ="'.date('Y').'">'.date('Y').'</option>';
$end_year = '<option value ="'.date('Y').'">'.date('Y').'</option>';


$link = " preview_audit_trail.php";

// start compiling the page..
$tpl = new template_parser( '../templates/audit_trail2.tpl.php' );
$tags = array(
		'{USERNAME}' 	=> 'Username',
		'{ACTION}' 		=> 'Activity',
		'{ITEMNAME}' 	=> 'Message',		
		'{MESSAGE}' 	=> $message,
		'{DATE}'		=> 'Date',
		'{TIME}'		=> 'Time',
		
		'{FROM_MONTH}'  => $from_month,
		'{FROM_DATE}'	=> $from_day,
		'{FROM_YEAR}'	=> $end_year,
		
		'{END_MONTH}'	=>	$end_month,
		'{END_DATE}'	=>  $end_day,
		'{END_YEAR}'	=>  $end_year,

		'{LINK}'		=> $link,
				
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