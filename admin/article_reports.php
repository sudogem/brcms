<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
/** ensure dis file is being included by a parent file -- {mh}*/
//defined('{mh}') or die("Direct access to this location is not allowed :-)");

session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: login.php');
}

if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}

$month = $_POST['month'];
$year =  $_POST['year'];
$status = $_POST['status'];
$approved = $_POST['approved'];
$rejected = $_POST['rejected'];
$_SESSION['month'] = strdate($month,'');
$_SESSION['year'] = $year;
$_SESSION['approved'] = $approved;
$_SESSION['rejected'] = $rejected;
$db = new database;



if ( isset($_POST['submit'])) {
	$sql = " select * from article_versions av where ";
	if ( $month ) {
		$sql .= " av.created_month = $month or av.stageID = '4' and av.stageID = '6' ";
	}
	if ( $year ) {
		if ( $month ) $sql .= " and av.created_year = $year ";
		else $sql .= " av.created_year = $year or av.stageID = '4' and av.stageID = '6' ";
	}
	
	if ( $approved ) {
		if (($month) || ($year)){	
			$sql .= " having av.status = 'live' or av.status = 'published' ";
		}
		else{
			$sql .= " av.status = 'approved' or av.status = 'published' ";
		}
	}
	if ( $rejected ) {
		if ( $approved ) $sql .= " or av.status = 'rejected' ";
		else $sql .= " and av.status = 'rejected' ";
	}
	if (!($result = $db->query($sql))){
			die('Error:'. $db->error());
	}
	$reports = array();
	while( $reports[] = $db->fetcharray() );
	$_SESSION['report_newsdirector_articles'] = $reports;
	//print_r($reports);
	if (!( $db->getnumrows() > 0 )) $no_records_found = true;
	if ( $no_records_found ) {
		$result_msg = 'No Records Found';
	}
	else{
		for( $i = 0; $i < count( $reports ); $i++ ) {
			if ( $reports[$i]->article_versionID ) {
				 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
				$row_data .= '<tr class="tdhover" id= "tdata" bgcolor = "'. $bgcolor . '">';
				$row_data .= '<td>';
				$row_data .= $i+1;
				$row_data .= '</td>';		
					
				$row_data .= '<td class="blue">';
				$row_data .= $reports[$i]->title;
				$row_data .= '</td>';
				
				$row_data .= '<td class="viola">';
				$category_name = getCategory_name( $reports[$i]->articleID );
				$row_data .= $category_name;
				$row_data .= '</td>';
				
				$row_data .= '<td class="brown" >';
				$row_data .= getArticle_authors_info ( $reports[$i]->articleID, 'fullname' );		
				$row_data .= '</td>';
				
				$row_data .= '<td class="cyan">';
				$row_data .= getUser_info ( $reports[$i]->edited_by, 'fullname' );		
				$row_data .= '</td>';
	
				$row_data .= '<td class="black">';
				$row_data .= friendlyDate2($reports[$i]->created);		
				$row_data .= '</td>';
	
				$row_data .= '<td class="brown">';
				$date = ( $reports[$i]->modified )? friendlyDate2($reports[$i]->modified): '0';		
				$row_data .= $date;
				$row_data .= '</td>';
				
				$row_data .= '<td class="green">';
				$row_data .= $reports[$i]->status;		
				$row_data .= '</td>';
				
				$row_data .= '</tr>';
			}			
		}
	}
}

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
// link for print preview
$link = " preview_newsdirector_reports.php";
// Generate the page now
$tpl = new template_parser( '../templates/reports/article_reports.tpl.php' );
$tags = array(
		'{ARTICLE_TITLE}'		=> ' Article Title' ,
		'{CATEGORY}'			=> ' Category' ,	
		'{WRITTEN_BY}' 			=> ' Written by' ,
		'{EDITED_BY}' 			=> ' Edited by' ,
		'{DATE_WRITTEN}' 		=> ' Date Written',
		'{LAST_MODIFIED}'		=> 'Last Modified',	
		'{APPROVED}'			=> $_SESSION['approved'] ? ' checked ': '',	
		'{REJECTED}'			=> $_SESSION['rejected'] ? ' checked ': '',	
		'{STATUS}'				=> 'Status ',	
		'{LINK}'				=> $link,
		'{PAGELINK}'			=> $pagelink->pagelinks , 			
		'{HEADING}'				=> $heading,		
		'{RESULT_MSG}'			=> $result_msg,				
		'{TABLE_DATA}'			=> $row_data,
		'{LISTOFYEAR}'			=>	$optyear,
		'{STYLESHEET}'			=> $stylesheet ,
		'{SITENAME}' 			=> 'CMS Adminss',
		'{TOPNAV}' 				=> 'top_menu.php',
		'{FOOTER}' 				=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>