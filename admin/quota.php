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
			$message = 'Successfully saved the quota: ' . $_SESSION['title'];
			break;
		case 'delete':
			$message = 'Successfully delete the quota(s)';
			break;
	}
unset($_SESSION['task']);			
}
$db = new database;



$sql = " select * from quota order by quota asc";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$quota = array();
while ( $quota[] = $db->fetcharray() );
$totalrows = count( $quota );
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
	if ( $quota[$i]->quotaID ) {
		(($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '" align = "left">';
	
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';

		$row_data .= '<td>';
		$row_data .= '<input type="radio" name="cid[]" id="cb' . $i . '" value="' . $quota[$i]->quotaID . '" onClick="isChecked(this.checked);"/>';
		$row_data .= '</td>';			
		
		$row_data .= '<td align="left">';
		$row_data .= '<a href="' . VIEW_QUOTA . $quota[$i]->quotaID . '">';
		$row_data .= '&nbsp;'. $quota[$i]->quota;
		$row_data .= '</td>';

		$row_data .= '<td>';
		if ( $quota[$i]->isdefault ) {
			$row_data .= '<img src="images/tick.png" width="12" height="12" border="0" alt="" />';
		}
		else{
			$row_data .= '&nbsp;';
		}
		$row_data .= '</td>';
		
		$row_data .= '</tr>';
	}
}
// start generating page
$tpl = new template_parser( '../templates/quota.tpl.php' );
$tags = array(
	'{TABLE_DATA}' 	=> $row_data,
	'{NUMITEMS}'	=> ''. $totalrows,
	'{MESSAGE}' 	=> $message,
	'{QUOTA}'		=> 'Quota',
	'{DEFAULT}'		=> 'Default',
	'{PAGELINK}'	=> $pagelink->pagelinks , 			
	'{SITENAME}' 	=> 'CMS Adminss',
	'{TOPNAV}' 		=> 'top_menu.php',
	'{FOOTER}' 		=> 'footer.php' 
);
$tpl->parse_template( $tags );
print $tpl->display();
?>