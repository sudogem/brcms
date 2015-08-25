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
			$message = 'Successfully saved the changes of tasks: ' . $_SESSION['title'];
			break;
		case 'add':
			$message = 'Successfully saved the tasks: ' . $_SESSION['title'];
			break;
	}
unset($_SESSION['task']);			
}
//print_r($_POST);
$priority = $_POST['priority'];
$_SESSION['priority'] = $priority ;
$db = new database;



$currentdate = simpledate(time());
//echo $currentdate;
$sql = "select * from tasks where assignedto = '$userID' ";
$sql .= " and status != 'completed' ";
$sql .= " and created = '$currentdate'" ;
if ( $priority ) $sql .= " and priority = '$priority' ";
$sql .= " order by created desc ";
//echo $sql;		
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$tasks = array();
while ( $tasks[] = $db->fetcharray() );
$totalrows = count( $tasks );
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
for( $i = $start; $i < $start+$limit; $i++ ) {
	if ( $tasks[$i]->taskID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id= "tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $j++	;
		$row_data .= '</td>';		

		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="cid[]" id="cb' . $i . '" value="' . $tasks[$i]->taskID . '" onClick="isChecked(this.checked);"/>';
		$row_data .= '</td>';			
			
		$row_data .= '<td>'; 
		$row_data .= '<a href="' . VIEW_TASK_URL . $tasks[$i]->taskID . '">';		
		$row_data .= '&nbsp;'.$tasks[$i]->subject;
		$row_data .= '</a>';		
		$row_data .= '</td>';

		$row_data .= '<td>';
		$row_data .= '&nbsp;'.friendlydate($tasks[$i]->created_t );
		$row_data .= '</td>';			

		$row_data .= '<td>';
		$row_data .= '&nbsp;'.friendlydate($tasks[$i]->enddate );
		$row_data .= '</td>';			


		$row_data .= '<td ';
		switch( $tasks[$i]->priority ) {
			case 'High':
				$row_data .= 'class="green">';
				break;
			case 'Low':
				$row_data .= 'class="viola">';
				break;
			case 'Normal':
				$row_data .= 'class="red">';
				break;		
		}
		$row_data .= $tasks[$i]->priority;
		$row_data .= '</td>';
		
		$row_data .= '<td ';
		switch( $tasks[$i]->status ) {
			case 'Completed':
				$row_data .= 'class="green">';
				break;
			case 'In Progress':
				$row_data .= 'class="viola">';
				break;
			case 'Not Started':
				$row_data .= 'class="blue">';
				break;		
		}
		$row_data .= $tasks[$i]->status;
		$row_data .= '</td>';
					
		$row_data .= '</tr>';
	}			
}

/**
 * Populate priorities to array..
 */
$priority = array( "Low", "Normal", "High" );
foreach( $priority as $field => $data ) {
	if ( $data == $_SESSION['priority'] ) {
		$optpriority .= '<option value="' . $data . '"  selected >';
		$optpriority .= $data;
		$optpriority .= '</option>';
	}
	else{
		$optpriority .= '<option value="' . $data . '"  >';
		$optpriority .= $data;
		$optpriority .= '</option>';
	}
}

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/my_tasks.tpl.php' );
$tags = array(
		'{SUBJECT}' 		=> 'Subject',
		'{DUE_DATE}'		=> 'Due Date',
		'{PRIORITY}'		=> 'Priority',
		'{STATUS}'			=> 'Status',
		'{SITENAME}' 		=> 'CMS Adminss',
		'{DATE_CREATED}'	=> 'Date Created',
		'{ASSIGN_TO}'		=> 'Assigned to',
		'{MESSAGE}'			=> $message,
		'{LIST_OF_PRIORITY}'=> $optpriority,
		'{NUMITEMS}'		=> ''. $totalrows,
		'{TABLE_DATA}'		=> $row_data,       
		'{FROM_MONTH}'		=> $optmonth,
		'{FROM_DAY}'		=> $optday,
		'{FROM_YEAR}'		=> $optyear,
		'{PAGELINK}'		=> $pagelink->pagelinks , 					
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>