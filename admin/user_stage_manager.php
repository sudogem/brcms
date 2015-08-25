<?php
require ( 'coreclass.php' );
/** ensure dis file is being included by a parent file -- {mh}*/
/*
defined('{mh}') or die("Direct access to this location is not allowed :-)");

session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: login.php');
}

if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}
*/
$db = new database;




$sql = "select * from content_users ";

if (!($result = $db->query( $sql ))){
	die ( 'Error:' . $db->error());
}
$content_users = array();
while ( $content_users[] = $db->fetcharray() );
$db->freeresult();

for( $i = 0; $i < count( $content_users )-1; $i++ ){
 	(($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
	$row_data .= '<tr class="tdhover" bgcolor = "'. $bgcolor . '" align = "center">';
	$row_data .= '<td align="left">';
	$row_data .= $content_users[$i]->fullname;
	$row_data .= '</td>';
	$row_data .= '<td>';
	$row_data .= $content_users[$i]->userID;		
	$row_data .= '</td>';
	$row_data .= '<td>';
	//$row_data .= '<input type="textbox"  value="' . $content_users[$i]->userID . '" name="userID">';
	$row_data .= '<input type="textbox"  value="1" name="userID">';
	$row_data .= '<input type="checkbox"  value="' . $content_users[$i]->userID . '" name="cusers[]" id="cusers[]" >';
	$row_data .= '<input type="hidden"  value="1" name="writing">';
	$row_data .= '</td>';
	$row_data .= '<td>';
	$row_data .= '<input type="checkbox"  value="2" name="editing">';
	$row_data .= '<input type="hidden"  value="2" name="editing">';
	$row_data .= '</td>';
	$row_data .= '<td>';
	$row_data .= '<input type="checkbox"  value="3" name="proofreading">';
	$row_data .= '<input type="hidden"  value="3" name="proofreading">';
	$row_data .= '</td>';
	$row_data .= '<td>';
	$row_data .= '<input type="checkbox"  value="4" name="publishing">';
	$row_data .= '<input type="hidden"  value="4" name="publishing">';
	$row_data .= '</td>';
	$row_data .= '</tr>';
}


// start compiling the page..
$tpl = new template_parser( '../templates/user_stage_manager.tpl.php' );
$tags = array(
		'{NAME}' 		=> 'Name',
		'{GROUP}' 		=> 'Group',
		'{WRITING}' 	=> 'Writing',
		'{EDITING}' 	=> 'Editing',
		'{PROOFREADING}'=> 'Proofreading',
		'{PUBLISHING}' 	=> 'Publishing',
		'{TABLE_DATA}' 	=> $row_data
		);
$tpl->parse_template( $tags );
print $tpl->display();

//print_r($content_users);

?>