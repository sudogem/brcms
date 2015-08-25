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
$approved = $_SESSION['approved'];
$rejected = $_SESSION['rejected'];
$rpt_title = " List of all ";
if ( $approved != "" ) $rpt_title .= " <span class=green><b>approved</b></span>";
if ( $rejected != "" ) {
	if ( $approved != "" )
		$rpt_title .= " and <span class=red><b>rejected</b></span>";
	else
		$rpt_title .= " <span class=red><b>rejected</b></span>";	
}	
$rpt_title .= " articles as of $month $year. ";
$newsdirector_articles_reports = $_SESSION['report_newsdirector_articles'];
for( $i = 0; $i < count( $newsdirector_articles_reports )-1; $i++ ) {
	if ( $newsdirector_articles_reports[$i]->articleID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id= "tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $i+1;
		$row_data .= '</td>';		
		
		$row_data .= '<td class="blue">';
		$title = ( $newsdirector_articles_reports[$i]->title );
		$row_data .= '&nbsp;' . $title ;
		$row_data .= '</td>';
		
		$row_data .= '<td class="viola">';
		$category_name = getCategory_name( $newsdirector_articles_reports[$i]->articleID );
		$row_data .= $category_name;
		$row_data .= '</td>';
		
		$row_data .= '<td class="brown" >';
		$row_data .= getArticle_authors_info ( $newsdirector_articles_reports[$i]->articleID, 'fullname' );		
		$row_data .= '</td>';

		$row_data .= '<td class="cyan">';
		$row_data .= getUser_info ( $newsdirector_articles_reports[$i]->edited_by, 'fullname' );		
		$row_data .= '</td>';

		$row_data .= '<td class="black">';
		$row_data .= friendlyDate2($newsdirector_articles_reports[$i]->created);		
		$row_data .= '</td>';

		$row_data .= '<td class="brown">';
		$date = ( $newsdirector_articles_reports[$i]->modified )? friendlyDate2($newsdirector_articles_reports[$i]->modified): '0';		
		$row_data .= $date;
		$row_data .= '</td>';
		
		$row_data .= '<td ';
		switch( $newsdirector_articles_reports[$i]->status ){
			case 'revise':
				$row_data .= 'class="blue">';
				break;
			case 'rejected':
				$row_data .= 'class="red">';
				break;
			case 'approved':
				$row_data .= 'class="green">';
				break;
			default :
				$row_data .= 'class="black">';			
				break;	
		}
		$row_data .= $newsdirector_articles_reports[$i]->status;		
		$row_data .= '</td>';
		
		$row_data .= '</tr">';
	}			
}

$dateprepared = time();
$dateprepared = friendlyDate( $dateprepared ); // my friendly date - {mh}
// Generate the page now
$tpl = new template_parser( '../templates/reports/preview_newsdirector_reports.tpl.php' );
$tags = array(
		'{ARTICLE_TITLE}'		=> ' Article Title' ,
		'{CATEGORY}'			=> ' Category' ,	
		'{WRITTEN_BY}' 			=> ' Written by' ,
		'{EDITED_BY}' 			=> ' Edited by' ,
		'{DATE_WRITTEN}' 		=> ' Date Written',
		'{LAST_MODIFIED}'		=> 'Last Modified',	
		'{FULLNAME}' 			=> $fullname ,
		'{POSITION}' 			=> $position ,
		'{DATE_CREATED}' 		=> ' Date Written',
		'{DATE_PREPARED}' 		=> $dateprepared,		
		'{REPORT_TITLE}'		=> $rpt_title,
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