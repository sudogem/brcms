<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
$_SESSION['login'] = true;
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
			$message = 'Successfully saved the changes of site-content: ' . $_SESSION['title'];
			break;
		case 'add':
			$message = 'Successfully saved the site-content: ' . $_SESSION['title'];
			break;
		case 'delete':
			$message = 'Successfully delete the task(s) ';
			break;
	}
unset($_SESSION['task']);			
}
$db = new database;




$sql = " select * from other_site_content ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$other_contents = array();
while ( $row = $db->fetcharray() ) $other_contents[] = $row;
$totalrows = count( $other_contents );
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
for( $i = $start; $i < $start+$limit; $i++ ) {
	if ( $other_contents[$i]->id ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';			
		
		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="cid[]" id="cb' . $i . '" value="' . $other_contents[$i]->messageID . '" onClick="isChecked(this.checked);"/>';
		$row_data .= '</td>';			
		
		$row_data .= '<td>';
		$row_data .= '<a href="' . VIEW_ADER_CONTENT_URL . $other_contents[$i]->id . '">';
		$row_data .= $other_contents[$i]->title ;		
		$row_data .= '</a>';		
		$row_data .= '</td>';
		
		$row_data .= '<td ';
		$status =  ( $other_contents[$i]->status );			
		switch( $status ){
			case 'Published':
				$row_data .= 'class="green">';
				break;
			case 'Unpublished':
				$row_data .= 'class="red">';
				break;
		}
		$row_data .= '&nbsp;' . $status;
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$from = getUser_info ( $other_contents[$i]->author, 'fullname' );
		$row_data .= '&nbsp;'.$from ;			
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$row_data .= friendlyDate ($other_contents[$i]->created) ;
		$row_data .= '</td>';

		$row_data .= '<td class="black">';
		$date = ($other_contents[$i]->last_modified)?friendlyDate2($other_contents[$i]->last_modified):'0';
		$row_data .= '&nbsp;' . $date;
		$row_data .= '</td>';

		$row_data .= '</tr>';
	}			
}

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/other_site_content.tpl.php' );
$tags = array(
		'{TITLE}' 			=> 'Subject',
		'{STATUS}'			=> 'Status',
		'{CATEGORY}'		=> 'Category',
		'{SITENAME}' 		=> 'CMS Adminss',
		'{DATE_CREATED}'	=> 'Date Created',
		'{LAST_MODIFIED}'	=> 'Last Modified',		
		'{AUTHOR}'			=> 'Author',
		'{MESSAGE}'			=> $message,
		'{NUMITEMS}'		=> ''. $totalrows,
		'{TABLE_DATA}'		=> $row_data,       
		'{PAGELINK}'		=> $pagelink->pagelinks , 					
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>