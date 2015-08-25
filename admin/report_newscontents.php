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



$year = $_POST['year'];
$month = $_POST['month'];
$month2 = strdate("$month",'');
$_SESSION['month'] = $month2;
$_SESSION['year'] = $year;

$sql = " select * from article_versions av ";
$sql .= " where av.stageID=6 and av.status='published'";
$sql .= " and av.published_month = '$month' and av.published_year = '$year' ";
$sql .= " order by av.dateline DESC ";
if (!($result = $db->query( $sql ))){
	die ( 'Error:' . $db->error());
}
$article_versions = array();
while( $row = $db->fetcharray() ) {
	$article_versions[] = $row; 
}
if (!( $db->getnumrows() > 0 )) $result_msg = 'No Records Found';
$_SESSION['newscontent_report'] = $article_versions ;
//print_r($article_versions);
$row_data = '';
for( $i = 0; $i < count($article_versions) ; $i++ ) {
	if ( $article_versions[$i]->articleID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $i+1;
		$row_data .= '</td>';
		
		$row_data .= '<td class="blue">';
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
		
		$row_data .= '<td class="black">';
		$date = ($article_versions[$i]->dateline)?friendlyDate2($article_versions[$i]->dateline):'0';
		$row_data .= '&nbsp;' . $date;
		$row_data .= '</td>';
		
		$row_data .= '</tr>';
	}			
}
$link = " preview_newscontents.php";
$rpt_header = "List of Live articles as of $month2 $year";
// start generating page
$tpl = new template_parser( '../templates/reports/report_newscontents.tpl.php' );
$tags = array(
	'{ARTICLE_TITLE}'	=> 'Article Title',
	'{AUTHOR}'			=> 'Author',
	'{CATEGORY}'		=> 'Category',
	'{FRONTPAGE}'		=> 'Frontpage',
	'{STAGEID}'			=> 'Stage',
	'{DATE_CREATED}'	=> 'Date Written',
	'{DATE_PUBLISHED}'	=> 'Date Published',
	'{LINK}'			=> $link,
	'{RESULT_MSG}'		=> $result_msg,
	'{RPT_HEADER}'		=> $rpt_header,
	'{TABLE_DATA}'		=> $row_data
);
$tpl->parse_template( $tags );
print $tpl->display();
?>
