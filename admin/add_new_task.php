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
for($i=1; $i<=12 ; $i++) {
	$optmonth .= '<option value ="'.date("M", mktime(0, 0, 0, $i, 1,0)).'">'.date("M", mktime(0, 0, 0, $i, 1,0)).'</option>';
}
for($i=1; $i <= 31; $i++) {
	$optday .= '<option value ="'.$i.'">'.date("d", mktime(0, 0, 0, 0, $i, 0)).'</option>';
}
// TODO: bai moi kindly change the year must be DYNAMIC!!
$optyear .= '<option value ="2006">'.date('Y').'</option>';

$db = new database;



/**
 * Populate all the content users into an array..
 */
$sql = " select * from content_users where usertypeID=2 order by fullname asc";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$users = array();
while( $row = $db->fetcharray() ) {
	$users[] = $row; 
}
$db->freeresult();
foreach( $users as $field => $data ) {
	$users .= '<option value="' . $data->userID . '"  >';
	$users .= $data->fullname;
	$users .= '</option>';
}
/**
 * Populate priorities to array..
 */
$priority = array( "Low", "Normal", "High" );
foreach( $priority as $field => $data ) {
	$optpriority .= '<option value="' . $data . '"  >';
	$optpriority .= $data;
	$optpriority .= '</option>';
}

/**
 * Populate status to array..
 */
$priority = array( "Not Started" );
foreach( $priority as $field => $data ) {
	$optstatus .= '<span class="red" >';
	$optstatus .= $data;
	$optstatus .= '</span>';
}

$sql = " select * from content_users where usertypeID=2 order by fullname asc";
// $sql = " select * from content_users order by fullname asc";

if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$contentwriters = array();
while ( $contentwriters[] = $db->fetcharray() );
$totalrows = count( $contentwriters );
$j=1;
$quota = getActiveQuota();// get the current active quota
for( $i = 0; $i < $totalrows; $i++ ) {
	if ( $contentwriters[$i]->userID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id= "tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $j++	;
		$row_data .= '</td>';		

		$row_data .= '<td>';
		$row_data .= '<input type="radio" name="cid[]" id="cb' . $i . '" value="' . $contentwriters[$i]->userID . '" onClick="isChecked(this.checked)"/>';
		$row_data .= '</td>';			
			
		$row_data .= '<td class="blue2">'; 
		$row_data .= '&nbsp;'. $contentwriters[$i]->fullname;
		$row_data .= '</td>';

		$row_data .= '<td ';
		$numload = count(getUserWorkload( $contentwriters[$i]->userID , time() ));		
		if ( $numload >= $quota ) {	
			$row_data .= ' class="red" > ';
			$row_data .= '&nbsp;FULL';
		}
		else{
			$row_data .= ' class="viola" > ';
			$row_data .= '&nbsp;AVAILABLE';
		}
		$row_data .= '</td>';		

		$row_data .= '<td align="center">';
		$currentnumload = count(getUserWorkload( $contentwriters[$i]->userID , time() ));
		$row_data .= '&nbsp;' . $currentnumload;
		$row_data .= '</td>';		

		$row_data .= '<td class="brown">';
		$numload = count(getWriterTaskStatus( $contentwriters[$i]->userID , 'Completed' , time() ));
		$row_data .= '&nbsp;' . $numload;
		$row_data .= '</td>';		

		$row_data .= '<td class="viola">';
		$remainingload =  $quota - $currentnumload;
		$row_data .= '&nbsp;' . $remainingload;
		$row_data .= '</td>';		

		$row_data .= '<td class="red">';
		$row_data .= '&nbsp;' . $quota ;
		$row_data .= '</td>';		
		
	}	
}
$time = date("g:i a", time());
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/add_new_task2.tpl.php' );
$tags = array(
		'{PRIORITY}' 		=> $optpriority ,
		'{CATEGORY_DESC}'	=> $category_desc ,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{TABLE_DATA}'		=> $row_data,
		'{MESSAGE}'			=> $message,
		'{FROM_MONTH}'		=> $optmonth,
		'{FROM_DAY}'		=> $optday,
		'{FROM_YEAR}'		=> $optyear,
		'{STIME}'			=> $time ,
		'{STATUS}'			=> $optstatus,
		'{LIST_OF_USERS}'	=> $users,
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>