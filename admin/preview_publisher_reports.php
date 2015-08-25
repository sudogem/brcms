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
$fullname = getUser_info( $userID, 'fullname' );
$position = $usertype;
$month = $_SESSION['month'];
$year = $_SESSION['year'];
$publisher_articles_reports = $_SESSION['report_published_articles'];
for( $i = 0; $i < count( $publisher_articles_reports ); $i++ ) {
	if ( $publisher_articles_reports[$i]->articleID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
			$row_data .= '<tr class="tdhover" id= "tdata" bgcolor = "'. $bgcolor . '">';
			
			$row_data .= '<td>';
			$row_data .= $i+1;
			$row_data .= '</td>';		
			
			$row_data .= '<td>';
			$row_data .= '<a href="' . VIEW_ARTICLE_URL . $publisher_articles_reports[$i]->articleID . '">';
			$title = getArticleTitle( $publisher_articles_reports[$i]->articleID );
			$row_data .= '&nbsp;' . $title ;
			$row_data .= '</a>';
			$row_data .= '</td>';
			
			$row_data .= '<td class="blue2">';
			$category_name = getCategory_name( $publisher_articles_reports[$i]->articleID );
			$row_data .= $category_name;
			$row_data .= '</td>';

			$row_data .= '<td>';
			$category_name = getFrontpage_type( $publisher_articles_reports[$i]->articleID );
			$row_data .= '&nbsp;' . $category_name;
			$row_data .= '</td>';

			$row_data .= '<td>';
			$row_data .= getArticle_authors_info ( $publisher_articles_reports[$i]->articleID, 'fullname' );		
			$row_data .= '</td>';
			
			$row_data .= '<td>';
			$row_data .= getUser_info ( $publisher_articles_reports[$i]->edited_by, 'fullname' );		
			$row_data .= '</td>';
			
			$row_data .= '<td class="brown">';
			$row_data .= '&nbsp;' . friendlydate2 ($publisher_articles_reports[$i]->created) ;
			$row_data .= '</td>';
			
			$row_data .= '<td>';
			$date = ( $publisher_articles_reports[$i]->modified )? friendlyDate2($publisher_articles_reports[$i]->modified): '0';		
			$row_data .= $date;
			$row_data .= '</td>';

			$row_data .= '<td>';
			$row_data .= $publisher_articles_reports[$i]->status;		
			$row_data .= '</td>';
			
			$row_data .= '</tr">';
	}			
}
$dateprepared = time();
$dateprepared = friendlyDate($dateprepared);	
$rpt_title = "Lists of published articles for the month of $month $year.";
// Generate the page now
$tpl = new template_parser( '../templates/reports/preview_publisher_reports.tpl.php' );
$tags = array(
		'{ARTICLE_TITLE}'		=> ' Article Title' ,
		'{CATEGORY}'			=> ' Category' ,	
		'{FRONTPAGE}' 			=> 'Frontpage',
		'{WRITTEN_BY}' 			=> ' Written by' ,
		'{EDITED_BY}'			=> 'Edited by',			
		'{FULLNAME}' 			=> $fullname ,
		'{POSITION}' 			=> $position ,
		'{DATE_CREATED}' 		=> ' Date Written',
		'{LAST_MODIFIED}'		=> 'Last Modified',
		'{STATUS}'				=> 'Status ',	
		'{DATE_PREPARED}' 		=> $dateprepared,		
		'{REPORT_TITLE}'		=> $rpt_title,
		'{LINK}'				=> $link,
		'{PAGELINK}'			=> $pagelink->pagelinks , 			
		'{TABLE_DATA}'			=> $row_data,
		'{STYLESHEET}'			=> $stylesheet ,
		'{SITENAME}' 			=> 'CMS Adminss',
		'{FOOTER}' 				=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>