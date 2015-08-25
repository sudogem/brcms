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



if ( isset( $_SESSION['task'] ) && $_SESSION['task'] != '' ) {
	switch ( $_SESSION['task'] ) {
		case 'archive':
			$message  = 'Successfully archive the article(s).';
			break;
		case 'unarchive':
			$message = 'Successfully unarchive the article(s).';
			break;
	}
unset( $_SESSION['task'] );
}			

if ( isset( $_SESSION['login'] ) ) {
	switch( $_SESSION['stageID'] ) {
		case 1:
		case 2: 
			$sql = " select * from article_author aa, article_category ac , articles a ";
			$sql .= " where aa.userID = " . intval ($userID); 
			$sql .= " and aa.articleID = a.articleID ";
			$sql .= " and ac.articleID = a.articleID ";
			$sql .= " and a.isarchive = '1' ";
			$sql .= " order by a.created DESC ";
			$heading = "Article Archive Manager";
			break;		
		case 3:  // go! go! go!!
		case 4:  // oh, yeah..thats good..
		case 5:  // pls dont stop..i love it..
		case 6:  // whos yur daddy...
			$sql = " select * from article_versions av ";
			$sql .= " where av.stageID = " . $_SESSION['stageID'];
			$sql .= " and av.isarchive = '1' ";	
			$sql .= " order by dateline DESC ";	
			$heading = "News Content Archive Manager";
			break;
	}
}
//print $sql;
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$my_articles = array();
while( $row = $db->fetcharray() ) {
	$my_articles[] = $row; 
}
$n = $db->getnumrows();
$db->freeresult();
//print_r($my_articles);
$totalrows = count( $my_articles );
$limit = 10;
$paging = ceil( $totalrows / $limit );
$scroll = 1;
$scrollnumber = 5;

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}else{
	$page = 1;
}
$start = $page * $limit - ($limit);
$pagelink = new paging( $page, $totalrows, $limit, $paging, $scroll, $scrollnumber );

$j = $start+1;
for( $i = $start; $i < $start+$limit; $i++ ) {
	if ( $my_articles[$i]->articleID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id= "tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';		
			
		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="cid[]" id="cb' . $i . '" value="' . $my_articles[$i]->articleID . '" onClick="isChecked(this.checked);"/>';
		$row_data .= '</td>';			
		
		$row_data .= '<td>';
		$row_data .= '<a href="' . VIEW_ARTICLE_URL . $my_articles[$i]->articleID . '">';
		$title = getArticleTitle( $my_articles[$i]->articleID );
		$row_data .= '&nbsp;' . $title ;
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		$row_data .= '<td class="blue2">';
		$category_name = getCategory_name( $my_articles[$i]->articleID );
		$row_data .= '&nbsp;' . $category_name;
		$row_data .= '</td>';
		
		$row_data .= '<td ';				
		switch( $my_articles[$i]->stageID ){
			case 1:// draft
				$row_data .= 'class="black">';
				break;
			case 2://writing
				$row_data .= 'class="cyan">';
				break;
			case 3://editing
				$row_data .= 'class="blue">';
				break;
			case 4://reviewng
				$row_data .= 'class="red">';
				break;
			case 5://publishing
				$row_data .= 'class="green">';
				break;
			case 6://live
				$row_data .= 'class="green">';
				break;
		}
		$row_data .= '&nbsp;' . getStage_name ( $my_articles[$i]->stageID );		
		$row_data .= '</td>';
		
		$row_data .= '<td class="black">';
		$row_data .= '&nbsp;' . friendlydate2 ($my_articles[$i]->created) ;
		$row_data .= '</td>';
		
		$row_data .= '<td class="brown">';
		$row_data .= '&nbsp;' . friendlydate2 ($my_articles[$i]->dateline) ;
		$row_data .= '</td>';
		
		$row_data .= '</tr">';
	}			
}
$numitems = $i;
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/archive_manager.tpl.php' );
$tags = array(
	'{HEADING}'			=> $heading,
	'{ARTICLE_TITLE}' 	=> 'Article Title',
	'{CATEGORY}' 		=> 'Category',
	'{PUBLISHED}' 		=> 'Published',
	'{AUTHOR}' 			=> 'Author',
	'{DATE_CREATED}'	=> 'Date Created',
	'{DATE_PUBLISHED}'	=> 'Date Published',
	'{NUMITEMS}'		=> ''.$numitems,
	'{TABLE_DATA}' 		=> $row_data ,
	'{STAGEID}' 		=> 'Stage',
	'{PAGELINK}'		=> $pagelink->pagelinks , 			
	'{MESSAGE}'			=> $message,
	'{SITENAME}' 		=> 'CMS Adminss',
	'{HEADER}' 			=> '',
	'{TOPNAV}' 			=> 'top_menu.php',
	'{FOOTER}' 			=> 'footer.php' 
);
$tpl->parse_template( $tags );
print $tpl->display();

?>