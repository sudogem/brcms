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
	switch ( $_SESSION['task'] ) {
		case 'edit':
			$message = 'Successfully saved access permission of "' . $_SESSION['title']. '"';
			break;
	}
unset($_SESSION['task']);
unset($_SESSION['title']);	
}	
$db = new database;



/**
 * Populate the content users into an array
 */
$sql = "select * from content_users order by fullname asc";
if (!($result = $db->query( $sql ))){
	die ( 'Error:' . $db->error());
}
$content_users = array();
while ( $content_users[] = $db->fetcharray() );
$db->freeresult();
$totalrows = count( $content_users );
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
	if ( $content_users[$i]->userID ){
		(($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" bgcolor = "'. $bgcolor . '">';
	
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';
	
	
		$row_data .= '<td class="blue">';
		$row_data .= '<a href="' . VIEW_ACCESS_PERM_URL . $content_users[$i]->userID . '">';
		$row_data .= '&nbsp;' . $content_users[$i]->fullname;
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		$row_data .= '<td class="viola" >';
		$group_name = getGroup_name ( $content_users[$i]->usertypeID );
		$row_data .= '&nbsp;'.$group_name;
		$row_data .= '</td>';
		
		$row_data .= '<td align="left">';
		if ( checkUserAccessRights( $content_users[$i]->userID, 2 ) ) {
			$row_data .= '<img src="images/tick.png" width="12" height="12" border="0" alt="" />';
		}
		else{
			$row_data .= '<img src="images/publish_x.png" width="12" height="12" border="0" alt="" />';	
		}
		$row_data .= '</td>';		
		
		$row_data .= '<td align="left">';
		if ( checkUserAccessRights( $content_users[$i]->userID, 3 ) ) {
			$row_data .= '<img src="images/tick.png" width="12" height="12" border="0" alt="" />';
		}
		else{
			$row_data .= '<img src="images/publish_x.png" width="12" height="12" border="0" alt="" />';	
		}
		$row_data .= '</td>';		
		
		$row_data .= '<td align="left">';
		if ( checkUserAccessRights( $content_users[$i]->userID, 4 ) ) {
			$row_data .= '<img src="images/tick.png" width="12" height="12" border="0" alt="" />';
		}
		else{
			$row_data .= '<img src="images/publish_x.png" width="12" height="12" border="0" alt="" />';	
		}
		$row_data .= '</td>';		
		
		$row_data .= '<td align="left">';
		if ( checkUserAccessRights( $content_users[$i]->userID, 5 ) ) {
			$row_data .= '<img src="images/tick.png" width="12" height="12" border="0" alt="" />';
		}
		else{
			$row_data .= '<img src="images/publish_x.png" width="12" height="12" border="0" alt="" />';	
		}
		$row_data .= '</td>';		
		
		$row_data .= '</tr>';	
		}
}


// start compiling the page..
$tpl = new template_parser( '../templates/user_stage_manager2.tpl.php' );
$tags = array(
		'{NAME}' 		=> 'Name',
		'{GROUP}' 		=> 'Group',
		'{WRITING}' 	=> 'Writing',
		'{EDITING}' 	=> 'Editing',
		'{PROOFREADING}'=> 'Evaluating',
		'{PUBLISHING}' 	=> 'Publishing',
		'{TABLE_DATA}' 	=> $row_data,
		'{MESSAGE}' 	=> $message,
		
		'{PAGELINK}'	=> $pagelink->pagelinks , 			
		'{SITENAME}' 	=> 'CMS Adminss',
		'{TOPNAV}' 		=> 'top_menu.php',
		'{FOOTER}' 		=> 'footer.php' 
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>