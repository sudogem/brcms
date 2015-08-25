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
	}
unset($_SESSION['task']);			
}

$db = new database;



$sql = "select * from content_users order by fullname asc ";

if (!($result = $db->query( $sql ))){
	die ( 'Error:' . $db->error());
}
$content_users = array();
while ( $row = $db->fetcharray() ) $content_users[] = $row;
$db->freeresult();
$totalrows = count( $content_users );
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
for( $i = $start; $i < ($start+$limit); $i++ ){
	if ( $content_users[$i]->userID ) {
		(($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '" align = "left">';
	
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';
		
		$row_data .= '<td align="left">';
		$row_data .= '<a href="' . VIEW_PROFILE_URL_MANAGER . $content_users[$i]->userID . '">';
		$row_data .= '<input type="hidden" value = "' . $content_users[$i]->userID . '">';
		$row_data .= '&nbsp;'. $content_users[$i]->fullname;
		$row_data .= '</td>';
		
		$row_data .= '<td align="left" class="blue2" >';
		$row_data .= '&nbsp;'. $content_users[$i]->username;		
		$row_data .= '</td>';	
		
		$row_data .= '<td align="left">';
		if ($content_users[$i]->is_loggedin) {
			$row_data .= '<img src="images/tick.png" width="12" height="12" border="0" alt="" />';
		}
		else $row_data .= '&nbsp;';
		$row_data .= '</td>';		
		
		$row_data .= '<td align="left">';
		if (!$content_users[$i]->is_enabled) {
			$row_data .= '<img src="images/publish_x.png" width="12" height="12" border="0" alt="" />';
		}
		else{
			$row_data .= '<img src="images/tick.png" width="12" height="12" border="0" alt="" />';	
		}
		$row_data .= '</td>';		
		
		$row_data .= '<td align="left" class="viola" >';
		$group_name = getGroup_name ( $content_users[$i]->usertypeID );
		$assigned_category = getCategory_info( getUser_assigned_category( $content_users[$i]->userID ), 'category_name' );
		if ( $assigned_category )
			$row_data .= '&nbsp;'. $group_name . '<i>--'. $assigned_category . '</i>';
		else
			$row_data .= '&nbsp;'. $group_name;
		$row_data .= '</td>';
			
		$row_data .= '<td class="red" >';
		$row_data .= '&nbsp;<a href="mailto:'.$content_users[$i]->email . '">'.$content_users[$i]->email;
		$row_data .= '</td>';
			
		$row_data .= '<td>';
		$lastvisitDate = ($content_users[$i]->lastvisitDate ) ? 
			friendlyDate ( $content_users[$i]->lastvisitDate ) : '0';
		$row_data .= '&nbsp;'.$lastvisitDate;
		$row_data .= '</td>';
		
		$row_data .= '</tr>';
	}
}

// start generating page
$tpl = new template_parser( '../templates/user_manager2.tpl.php' );
$tags = array(
		'{FULLNAME}' 	=> 'FullName',
		'{USERNAME}' 	=> 'UserID',
		'{LOGGED_IN}' 	=> 'Logged In',
		'{IS_ENABLED}' 	=> 'Enabled',
		'{GROUP}'		=> ' Position ',
		'{EMAIL}' 		=> 'Email',
		'{REGISTER_DATE}'=> 'Register Date',
		'{LAST_VISIT}' 	=> 'Last visit',
		'{TABLE_DATA}' 	=> $row_data,
		'{MESSAGE}' 	=> $message,
		'{PAGELINK}'	=> $pagelink->pagelinks , 			
		'{SITENAME}' 	=> 'CMS Adminss',
		'{HEADER}' 		=> ' ',
		'{TOPNAV}' 		=> 'top_menu.php',
		'{FOOTER}' 		=>  'footer.php' 
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>