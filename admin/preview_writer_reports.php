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
$writer_articles_reports = $_SESSION['report_writer_articles'];
for( $i = 0; $i < count( $writer_articles_reports )-1; $i++ ) {
	if ( $writer_articles_reports[$i]->articleID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id= "tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $i+1;
		$row_data .= '</td>';		
		
		$row_data .= '<td>';
		$title = getArticleTitle( $writer_articles_reports[$i]->articleID );
		$row_data .= '&nbsp;' . $title ;
		$row_data .= '</td>';
		
		$row_data .= '<td class="blue2">';
		$category_name = getCategory_info( $writer_articles_reports[$i]->categoryID,'category_name' );
		$row_data .= '&nbsp;' . $category_name;
		$row_data .= '</td>';
		
		$row_data .= '<td ';
		$status = getArticle_version_info ( $writer_articles_reports[$i]->articleID, 'status' );
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
				$row_data .= 'class="cyan">';
				break;
			default :
				$row_data .= 'class="black">';			
				break;	
		}
		if ( $status != "" ) {
			$row_data .= '&nbsp;' . $status;			
		}
		else{
			$row_data .= '&nbsp;--' ; 	
		}
		$row_data .= '</td>';
		
		$row_data .= '<td class="brown">';
		$row_data .= '&nbsp;' . friendlydate ($writer_articles_reports[$i]->created) ;
		$row_data .= '</td>';
		
		$row_data .= '</tr">';
	}			
}
$dateprepared = time();
$dateprepared = friendlyDate($dateprepared);	
$rpt_title = "My written articles as of $month $year.";
// Generate the page now
$tpl = new template_parser( '../templates/reports/preview_writer_reports.tpl.php' );
$tags = array(
		'{ARTICLE_TITLE}'		=> ' Article Title' ,
		'{CATEGORY}'			=> ' Category' ,	
		'{FULLNAME}' 			=> $fullname ,
		'{POSITION}' 			=> $position ,
		'{DATE_CREATED}' 		=> ' Date Written',
		'{DATE_PREPARED}' 		=> $dateprepared,		
		'{REPORT_TITLE}'		=> $rpt_title,
		'{STAGEID}'				=> 'Status',	
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