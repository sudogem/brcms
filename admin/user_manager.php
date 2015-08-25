<?php
include( 'configuration.php' );
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
	$row_data .= $content_users[$i]->username;		
	$row_data .= '</td>';
	$row_data .= '<td>';
	$row_data .= '<label>';
	$row_data .= $content_users[$i]->is_loggedin;
	$row_data .= '</label>';
	$row_data .= '</td>';
	$row_data .= '<td>';
	$row_data .= '<label>';
	$row_data .= $content_users[$i]->is_enabled;
	$row_data .= '</label>';
	$row_data .= '</td>';
	$row_data .= '<td>';
	$row_data .= '<label>';
	$row_data .= $content_users[$i]->usertypeID;
	$row_data .= '</label>';
	$row_data .= '</td>';
	$row_data .= '<td>';
	$row_data .= '<label>';
	$row_data .= $content_users[$i]->email;
	$row_data .= '</label>';
	$row_data .= '</td>';
	$row_data .= '<td>';
	$row_data .= '<label>';
	$row_data .= $content_users[$i]->registerDate;
	$row_data .= '</label>';
	$row_data .= '</td>';
	$row_data .= '<td>';
	$row_data .= '<label>';
	$row_data .= $content_users[$i]->lastvisitDate;
	$row_data .= '</label>';
	$row_data .= '</td>';
	$row_data .= '</tr>';
}

// start compiling the page..
$tpl = new template_parser( '../templates/user_manager.tpl.php' );
$tags = array(
		'{FULLNAME}' 		=> 'FullName',
		'{USERNAME}' 		=> 'UserName',
		'{LOGGED_IN}' 	=> 'Logged In',
		'{IS_ENABLED}' 	=> 'Enabled',
		'{GROUP}'=> 'Group',
		'{EMAIL}' 	=> 'Email',
		'{REGISTER_DATE}'=> 'Register Date',
		'{LAST_VISIT}' 	=> 'Last visit',
		'{TABLE_DATA}' 	=> $row_data
		);
$tpl->parse_template( $tags );
print $tpl->display();

//print_r($content_users);

?>