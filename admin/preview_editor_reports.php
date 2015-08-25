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
$editor_articles_reports = $_SESSION['report_editor_articles'];
for( $i = 0; $i < count( $editor_articles_reports ); $i++ ) {
	if ( $editor_articles_reports[$i]->articleID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
			$row_data .= '<tr class="tdhover" id= "tdata" bgcolor = "'. $bgcolor . '">';
			
			$row_data .= '<td>';
			$row_data .= $i+1;
			$row_data .= '</td>';		
			
			$row_data .= '<td class="blue">';
			$title = getArticleTitle( $editor_articles_reports[$i]->articleID );
			$row_data .= '&nbsp;' . $title ;
			$row_data .= '</td>';
			
			$row_data .= '<td class="blue2">';
			$category_name = getCategory_name( $editor_articles_reports[$i]->articleID );
			$row_data .= $category_name;
			$row_data .= '</td>';

			$row_data .= '<td>';
			$row_data .= getArticle_authors_info ( $editor_articles_reports[$i]->articleID, 'fullname' );		
			$row_data .= '</td>';
			
			$row_data .= '<td ';				
			switch( $editor_articles_reports[$i]->status ){
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
			$row_data .= '&nbsp;' .  ( $editor_articles_reports[$i]->status );		
			$row_data .= '</td>';
			
			$row_data .= '<td class="brown">';
			$row_data .= '&nbsp;' . friendlydate ($editor_articles_reports[$i]->created) ;
			$row_data .= '</td>';
			
			$row_data .= '<td class="black">';
			$date = ( $editor_articles_reports[$i]->modified )? friendlyDate($editor_articles_reports[$i]->modified): '0';		
			$row_data .= $date;
			$row_data .= '</td>';
			
			$row_data .= '</tr">';
	}			
}
$dateprepared = time();
$dateprepared = friendlyDate($dateprepared);	
$rpt_title = "Lists of articles that i have edited as of $month $year.";
// Generate the page now
$tpl = new template_parser( '../templates/reports/preview_editor_reports.tpl.php' );
$tags = array(
		'{ARTICLE_TITLE}'		=> ' Article Title' ,
		'{CATEGORY}'			=> ' Category' ,	
		'{WRITTEN_BY}' 			=> ' Written by' ,
		'{FULLNAME}' 			=> $fullname ,
		'{POSITION}' 			=> $position ,
		'{DATE_CREATED}' 		=> ' Date Written',
		'{LAST_MODIFIED}'		=> 'Last Modified',	
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