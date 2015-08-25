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




// obtain list of users
$sql = " select * from content_users ";
if (!($result = $db->query( $sql ))){
	die ( 'Error:' . $db->error());
}
$content_users = array();
while ( $row = $db->fetcharray() ) $content_users[] = $row;

//print_r($content_users);
$row_data2 = '';
for( $i = 0; $i < count($content_users); $i++ ){
	if ( $content_users[$i]->userID ) {
		(($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data2 .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '" align = "left">';
	
		$row_data2 .= '<td>';
		$row_data2 .= $i+1;
		$row_data2 .= '</td>';
		
		$row_data2 .= '<td align="left">';
		$row_data2 .= '&nbsp;'. $content_users[$i]->fullname;
		$row_data2 .= '</td>';
		
		$row_data2 .= '<td align="left">';
		$row_data2 .= '&nbsp;'. $content_users[$i]->username;		
		$row_data2 .= '</td>';	
		
		$row_data2 .= '<td align="left">';
		if (!$content_users[$i]->is_enabled) {
			$row_data2 .= '<img src="images/publish_x.png" width="12" height="12" border="0" alt="disabled" />';
		}
		else{
			$row_data2 .= '<img src="images/tick.png" width="12" height="12" border="0" alt="enabled" />';	
		}
		$row_data2 .= '</td>';		
			
		$row_data2 .= '<td align="left">';
		$group_name = getGroup_name ( $content_users[$i]->usertypeID );
		$row_data2 .= '&nbsp;'.$group_name;
		$row_data2 .= '</td>';
		
		$row_data2 .= '<td>';
		$row_data2 .= '&nbsp;'.$content_users[$i]->email;
		$row_data2 .= '</td>';

		$row_data2 .= '<td>';
		if ($content_users[$i]->phoneno){
			$contactno = $content_users[$i]->phoneno;
		}
		else{
			if ($content_users[$i]->celno){
				$contactno = $content_users[$i]->celno;
			}
			else $contactno = '--';
		}
		$row_data2 .= '&nbsp;'. $contactno;
		$row_data .= '</td>';
		
		$row_data2 .= '</tr>';
	}
}

$link = " preview_listofmembers.php";
$rpt_header = "List of all Users.";

// start generating page
$tpl = new template_parser( '../templates/reports/report_listofmembers.tpl.php' );
$tags = array(
	'{FULLNAME}'		=> 'Fullname',
	'{USERNAME}'		=> 'UserID',
	'{IS_ENABLED}'		=> 'Enabled',
	'{GROUP}'			=> 'Usertype',
	'{EMAIL}'			=> 'Email',
	'{PHONENO}'			=> 'Phone No',
	'{LINK}'			=> $link,
	'{RESULT_MSG}'		=> $result_msg,
	'{RPT_HEADER}'		=> $rpt_header,
	'{DATE_PUBLISHED}'	=> 'Date Published',
	'{TABLE_DATA}'		=> $row_data2
);
$tpl->parse_template( $tags );
print $tpl->display();
?>