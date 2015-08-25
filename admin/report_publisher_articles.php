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
	$month2 = strdate("$month",'');

	$sql = "select * from article_versions av ";
	$sql .= " where av.status='published'";
	$sql .= " and av.created_month= '$month' ";
	$sql .= " and av.created_year= '$year' ";	
	$sql .= " order by av.dateline DESC ";
	if (!($result = $db->query($sql))) {
		die('Error:'.$db->error() );
	}
	$my_articles = array();
	while( $row = $db->fetcharray() ) {
		$my_articles[] = $row; 
	}
	if (!( $db->getnumrows() > 0 )) $result_msg = 'No Records Found';
	//Remove pre-existing session vars if exists..
	unset($_SESSION['report_published_articles']);
	unset($_SESSION['year']);
	unset($_SESSION['month']);
	$_SESSION['report_published_articles'] = $my_articles;
	$_SESSION['year'] = $year;
	$_SESSION['month'] = strdate($month,'');
	for( $i = 0; $i < count( $my_articles ); $i++ ) {
		if ( $my_articles[$i]->articleID ) {
			 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
			$row_data .= '<tr class="tdhover" id= "tdata" bgcolor = "'. $bgcolor . '">';
			
			$row_data .= '<td>';
			$row_data .= $i+1;
			$row_data .= '</td>';		
			
			$row_data .= '<td class="blue" >';
			$title = $my_articles[$i]->title;
			$row_data .= '&nbsp;' . $title ;
			$row_data .= '</td>';
			
			$row_data .= '<td class="blue2">';
			$category_name = getCategory_name( $my_articles[$i]->articleID );
			$row_data .= $category_name;
			$row_data .= '</td>';

			$row_data .= '<td class="viola" >';
			$category_name = getFrontpage_type( $my_articles[$i]->articleID );
			$row_data .= '&nbsp;' . $category_name;
			$row_data .= '</td>';

			$row_data .= '<td class="black">';
			$row_data .= getArticle_authors_info ( $my_articles[$i]->articleID, 'fullname' );		
			$row_data .= '</td>';
			
			
			$row_data .= '<td class="brown">';
			$row_data .= getUser_info ( $my_articles[$i]->edited_by, 'fullname' );		
			$row_data .= '</td>';
			
			$row_data .= '<td class="blue2">';
			$row_data .= '&nbsp;' . friendlyDate2 ($my_articles[$i]->created) ;
			$row_data .= '</td>';

			$row_data .= '<td class="black">';
			$date = ( $my_articles[$i]->dateline )? friendlyDate2($my_articles[$i]->dateline): '0';		
			$row_data .= $date;
			$row_data .= '</td>';

			$row_data .= '<td class="green">';
			$row_data .= $my_articles[$i]->status;		
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
$link = " preview_publisher_reports.php";
$rpt_header = "List of Published articles as of $month2 $year";

/*
 * Get the default stylesheets
 */
$stylesheet = " ../templates/admin2.css ";
// Generate the page now
$tpl = new template_parser( '../templates/reports/report_published_articles.tpl.php' );
$tags = array(
		'{ARTICLE_TITLE}'		=> ' Article Title' ,
		'{CATEGORY}'			=> ' Category' ,	
		'{WRITTEN_BY}' 			=> ' Written by' ,
		'{EDITED_BY}' 			=> ' Edited by' ,
		'{DATE_CREATED}' 		=> ' Date Written',
		'{DATE_PUBLISHED}'	    => 'Date Published',
		'{LAST_MODIFIED}'		=> 'Last Modified',	
		'{STATUS}'				=> 'Status',	
		'{LINK}'				=> $link,
		'{HEADING}'				=> $heading,		
		'{FRONTPAGE}' 			=> 'Frontpage',
		'{MESSAGE}'				=> $message,
		'{RESULT_MSG}'			=> $result_msg,	
		'{RPT_HEADER}'			=> $rpt_header,
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