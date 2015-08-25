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
if ( isset($_POST['submit'] )) {
	$year = $_POST['year'];
	$month = $_POST['month'];
	
	$sql = " select * from article_author aa, article_category ac , articles a ";
	$sql .= " where aa.userID = " . intval ($userID); // i havent thought about this..intval
	$sql .= " and aa.articleID = a.articleID ";
	$sql .= " and ac.articleID = a.articleID ";
	$sql .= " and a.created_month= '$month' ";
	$sql .= " and a.created_year= '$year' ";	
	$sql .= " order by a.created DESC ";

	if (!($result = $db->query($sql))) {
		die('Error:'.$db->error() );
	}
	$my_articles = array();
	while( $row = $db->fetcharray() ) {
		$my_articles[] = $row; 
	}
	if (!( $db->getnumrows() > 0 )) $result_msg = 'No Records Found';
	//Remove pre-existing session vars if exists..
	unset($_SESSION['report_writer_articles']);
	unset($_SESSION['year']);
	unset($_SESSION['month']);
	$_SESSION['report_writer_articles'] = $my_articles;
	$_SESSION['year'] = $year;
	$_SESSION['month'] = strdate($month,'');
	for( $i = 0; $i < count( $my_articles )-1; $i++ ) {
		if ( $my_articles[$i]->articleID ) {
			 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
			$row_data .= '<tr class="tdhover" id= "tdata" bgcolor = "'. $bgcolor . '">';
			
			$row_data .= '<td>';
			$row_data .= $i+1;
			$row_data .= '</td>';		
			
			$row_data .= '<td class="blue">';
			$title = getArticleTitle( $my_articles[$i]->articleID );
			$row_data .= '&nbsp;' . $title ;
			$row_data .= '</td>';
			
			$row_data .= '<td class="blue2">';
			$category_name = getCategory_info( $my_articles[$i]->categoryID,'category_name' );
			$row_data .= '&nbsp;' . $category_name;
			$row_data .= '</td>';
			
			$row_data .= '<td ';
			$status = getArticle_version_info ( $my_articles[$i]->articleID, 'status' );			
			switch( $status ){
				case 'revise':
					$row_data .= 'class="blue">';
					break;
				case 'rejected':
					$row_data .= 'class="red">';
					break;
				case 'approved':
					$row_data .= 'class="green">';
					break;
				case 'published':	
					$row_data .= 'class="viola">';
					break;
				default :
					$row_data .= 'class="black">';			
					break;	
			}
			$row_data .= '&nbsp;' . $status;
			$row_data .= '</td>';
			
			$row_data .= '<td class="brown">';
			$row_data .= '&nbsp;' . friendlydate ($my_articles[$i]->created) ;
			$row_data .= '</td>';
			
			$row_data .= '</tr">';
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

// link for print preview
$link = " preview_writer_reports.php";
/*
 * Get the default stylesheets
 */
$stylesheet = " ../templates/admin2.css ";
// Generate the page now
$tpl = new template_parser( '../templates/reports/report_writer_articles.tpl.php' );
$tags = array(
		'{ARTICLE_TITLE}'		=> ' Article Title' ,
		'{CATEGORY}'			=> ' Category' ,	
		'{WRITTEN_BY}' 			=> ' Written by' ,
		'{EDITED_BY}' 			=> ' Edited by' ,
		'{DATE_CREATED}' 		=> ' Date Written',
		'{LAST_MODIFIED}'		=> 'Last Modified',	
		'{STAGEID}'				=> 'Status',	
		'{LINK}'				=> $link,
		'{HEADING}'				=> $heading,		
		'{MESSAGE}'				=> $message,
		'{RESULT_MSG}'			=> $result_msg,				
		'{PAGELINK}'			=> $pagelink->pagelinks , 			
		'{TABLE_DATA}'			=> $row_data,
		'{LISTOFYEAR}'			=> $optyear,
		'{STYLESHEET}'			=> $stylesheet ,
		'{SITENAME}' 			=> 'CMS Adminss',
		'{TOPNAV}' 				=> 'top_menu.php',
		'{FOOTER}' 				=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>