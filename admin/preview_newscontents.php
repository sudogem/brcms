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
$article_versions =	$_SESSION['newscontent_report'];
$rpt_title .= " List of <span class=green><b>live</b></span> articles as of $month $year. ";
$row_data = '';
for( $i = 0; $i < count($article_versions) ; $i++ ) {
	if ( $article_versions[$i]->articleID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $i+1;
		$row_data .= '</td>';
		
		$row_data .= '<td class="black">';
		$row_data .= '&nbsp;' . $article_versions[$i]->title;
		$row_data .= '</td>';
		
		$row_data .= '<td class="viola">';
		$category_name = getCategory_name( $article_versions[$i]->articleID );
		$row_data .= '&nbsp;' . $category_name;
		$row_data .= '</td>';

		
		$row_data .= '<td class="cyan">';
		$author_name = getArticle_authors ( $article_versions[$i]->articleID );
		$row_data .= '&nbsp;' .  $author_name;
		$row_data .= '</td>';

		$row_data .= '<td class="blue2">';
		$category_name = getFrontpage_type( $article_versions[$i]->articleID );
		$row_data .= '&nbsp;' . $category_name;
		$row_data .= '</td>';
		
		$row_data .= '<td class="green">';
		$row_data .= '&nbsp;' .  getstage_name( $article_versions[$i]->stageID );
		$row_data .= '</td>';
		
		$row_data .= '<td class="brown">';
		$row_data .= '&nbsp;' . friendlyDate2($article_versions[$i]->created);
		$row_data .= '</td>';
		
		$row_data .= '<td class="blue">';
		$date = ($article_versions[$i]->dateline)?friendlyDate2($article_versions[$i]->dateline):'0';
		$row_data .= '&nbsp;' . $date;
		$row_data .= '</td>';
		
		$row_data .= '</tr>';
	}			
}
$dateprepared = time();
$dateprepared = friendlyDate( $dateprepared ); // my friendly date - {mh}

// start compiling the page...
$tpl = new template_parser( '../templates/reports/preview_newscontents.tpl.php' );
$tags = array(
		'{ARTICLE_TITLE}' 	=> 'Article Title',
		'{CATEGORY}' 		=> 'Category',
		'{PUBLISHED}' 		=> 'Published',
		'{AUTHOR}' 			=> 'Written by',
		'{DATE_CREATED}'	=> 'Date Written',
		'{DATE_PUBLISHED}'	=> 'Date Published',
		'{STAGEID}' 		=> ' Stage ',
		'{TABLE_DATA}' 		=> $row_data,
		'{PAGELINK}'		=> $pagelink->pagelinks , 			
		'{FRONTPAGE}' 		=> 'Frontpage',
		'{FULLNAME}' 		=> $fullname ,
		'{POSITION}' 		=> $position ,
		'{DATE_PREPARED}' 		=> $dateprepared,		
		'{REPORT_TITLE}'		=> $rpt_title,
		
		'{MESSAGE}'			=> $message,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 
		);
$tpl->parse_template( $tags );
print $tpl->display();

?>