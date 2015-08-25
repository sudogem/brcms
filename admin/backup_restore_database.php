<?php
/*
 * Every DREAM has a beginning GOAL..
*/
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



if ( isset( $_SESSION['task'] ) && $_SESSION['task'] != '' ) {
	switch ( $_SESSION['task'] ) {
		case 'backup':
			$message  = 'Successfully backup the database: ' . $_SESSION['title'];
			break;
		case 'restore':
			$message = 'Successfully restore the database: ' . $_SESSION['title'];
			break;
		case 'delete':
			$message  = 'Successfully delete the backup database(s).';
			break;
	}
	unset( $_SESSION['task'] );
	unset( $_SESSION['title'] );
}
$files = array();
if (is_dir($backup_dir)) { // check the backup dir if found..
	if ( $dh = opendir($backup_dir) ){
		$i = 0;
		while( ($file = readdir( $dh )) ){
			if ( $file != '.' && $file != '..' ) {
				$files[$i]->filename = $file;
				$files[$i]->myfilesize = filesize( $backup_dir.$file );		
				$files[$i]->modified = filemtime(	$backup_dir.$file );		
				$i++;
			}
			
		}
	}
	closedir($dh);
}
sort( $files,SORT_NUMERIC ); // sort the files
//print_r($files);
$totalrows = count( $files );
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
	if ( $files[$i]->filename ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id= "tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';		
			
		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="cid[]" id="cb' . $i . '" value="' . $files[$i]->filename . '" onClick="isChecked(this.checked);"/>';
		$row_data .= '</td>';			
		
		$row_data .= '<td>';
		$row_data .= '&nbsp;' . $files[$i]->filename;		
		$row_data .= '<a href="' . $backup_dir.$files[$i]->filename . '"> [ Download ]';
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		$row_data .= '<td class="blue2">';
		$row_data .= '&nbsp;' . friendlydate($files[$i]->modified);
		$row_data .= '</td>';
		
		$row_data .= '<td class="black">';
		$row_data .= '&nbsp;' . $files[$i]->myfilesize . ' bytes	' ;
		$row_data .= '</td>';
		
		$row_data .= '</tr">';
	}			
}
$numitems = $i;
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/backup_restore_manager.tpl.php' );
$tags = array(
	'{FILENAME}' 		=> 'Filename',
	'{CREATED}' 		=> 'Created',
	'{SIZE}' 			=> 'Size',
	'{TABLE_DATA}' 		=> $row_data ,
	'{PAGELINK}'		=> $pagelink->pagelinks , 			
	'{MESSAGE}'			=> $message,
	'{NUMITEMS}'		=> ''.$numitems,
	'{SITENAME}' 		=> 'CMS Adminss',
	'{HEADER}' 			=> '',
	'{TOPNAV}' 			=> 'top_menu.php',
	'{FOOTER}' 			=> 'footer.php' 
);
$tpl->parse_template( $tags );
print $tpl->display();

?>