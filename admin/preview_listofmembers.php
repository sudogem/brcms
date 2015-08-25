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



$fullname = getUser_info( $userID, 'fullname' );

// obtain list of users
$sql = " select * from content_users ";
if (!($result = $db->query( $sql ))){
	die ( 'Error:' . $db->error());
}
$content_users = array();
while ( $row = $db->fetcharray() ) $content_users[] = $row;
if (!( $db->getnumrows() > 0 )) $result_msg = 'No Records Found';
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
			$row_data2 .= '<img src="images/publish_x.png" width="12" height="12" border="0" alt="" />';
		}
		else{
			$row_data2 .= '<img src="images/tick.png" width="12" height="12" border="0" alt="" />';	
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
$stylesheet = " ../templates/admin2.css ";
$dateprepared = time();
$dateprepared = friendlyDate($dateprepared);	
$rpt_title = "Lists of all Users.";

// Generate the page now
$tpl = new template_parser( '../templates/reports/preview_listofmembers.tpl.php' );
$tags = array(
		'{FULLNAME}'			=> $fullname,
		'{FULLNAMEX}' 			=> 'Fullname',
		'{USERNAME}' 			=> 'UserID',
		'{LOGGED_IN}' 			=> 'Logged In',
		'{IS_ENABLED}' 			=> 'Enabled',
		'{GROUP}'				=> ' Usertype ',
		'{EMAIL}' 				=> 'Email',
		'{PHONENO}'				=> 'Contact No',
		'{POSITION}'			=> $usertype,
		'{DATE_PREPARED}'		=> $dateprepared,
		'{REPORT_TITLE}'		=> $rpt_title,
		'{TABLE_DATA}'			=> $row_data2
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>