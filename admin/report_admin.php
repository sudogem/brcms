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




//print_r($_POST);
if ( isset($_POST['submit']) ) {
$_SESSION['reportype'] = $_POST['reportype'];
	switch( $_POST['reportype'] ){
		case 1:
			break;
		case 2:
			$preview = 'preview_listofmembers.php';
			$file = 'report_listofmembers.php';
			break;
		case 3:
			$preview = 'preview_newscontents.php';
			$file = "report_newscontents.php";		
			break;
	}
}
/* Populate list of option values*/
$optreportype .= '<option value="2" >Lists of member Report</option>';
$optreportype .= '<option value="3" >News Contents Report</option>';
/**
 * Populate all the years into an array..
 */
$sql = " select distinct(created_year) from articles ";
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
$listofyear = array();
while( $row = $db->fetcharray() ){
	$listofyear[] = $row;  
}
$optyear = '';
foreach( $listofyear as $field => $data ) {
	$optyear .= '<option value="' . $data->created_year . '">';
	$optyear .= $data->created_year;
	$optyear .= '</option>';
}

/*
 * Get the default stylesheets
 */
$stylesheet = " ../templates/admin2.css ";
// Generate the page now
$tpl = new template_parser( '../templates/reports/report_admin.tpl.php' );
$tags = array(
		'{FULLNAME}' 			=> 'FullName',
		'{USERNAME}' 			=> 'UserID',
		'{LOGGED_IN}' 			=> 'Logged In',
		'{IS_ENABLED}' 			=> 'Enabled',
		'{GROUP}'				=> ' Usertype ',
		'{EMAIL}' 				=> 'Email',
		'{CONTACTNO}'			=> 'Contact No',
		'{ARTICLE_TITLE}'		=> ' Article Title' ,
		'{CATEGORY}'			=> ' Category' ,	
		'{WRITTEN_BY}' 			=> ' Written by' ,
		'{EDITED_BY}' 			=> ' Edited by' ,
		'{DATE_CREATED}' 		=> ' Date Written',
		'{LAST_MODIFIED}'		=> 'Last Modified',	
		'{DATA}'				=> $file ,
		'{REPORTYPE}'			=>	$optreportype,	
		'{STAGEID}'				=> 'Status',
		'{HGRAPH}'				=> '',
		'{PAGELINK}'			=> $pagelink,
		'{MESSAGE}'				=> $message,		
		'{LISTOFYEAR}'			=> $optyear,
		'{STYLESHEET}'			=> $stylesheet ,
		'{SITENAME}' 			=> 'CMS Adminss',
		'{TOPNAV}' 				=> 'top_menu.php',
		'{FOOTER}' 				=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>