<?php
require ( 'admin/coreclass.php' );
session_start();
$x = new online_tracker;
$x->tracker();

$gerger = new gerger_timer();
$gerger->start();
$gerger->setprecision(4);

$descselected = 'selected ';
if ( isset ( $_POST['go'] ) ) { // if go then...
	if ( isset( $_POST['day'] ) || isset( $_POST['month'] )  || isset( $_POST['year'] ) || 
		isset( $_POST['order_by'] ) || 	isset( $_POST['title'] ) || 
			isset( $_POST['author'] ) || isset( $_POST['category'] ) ) {
						$_SESSION['day'] = $_POST['day'];
						$_SESSION['month'] = $_POST['month'];
						$_SESSION['year'] = $_POST['year'];
						$_SESSION['order_by'] = $_POST['order_by'];
						$_SESSION['title'] = $_POST['title'];
						$_SESSION['author'] = $_POST['author'];
						$_SESSION['category'] = $_POST['category'];
						$title = $_POST['title'];
						$author = $_POST['author'];
						$category = $_POST['category'];
						$day = $_POST['day'];
						$month = $_POST['month'];
						$year = $_POST['year'];
						$order_by = $_POST['order_by'];
						switch ( $order_by ) {
							case 'asc' :
								$ascselected = 'selected ';
								break;
							case 'desc' :
								$descselected = 'selected ';					
								break;
						}
	}
}
else{
	if ( isset( $_SESSION['day'] ) || isset( $_SESSION['month'] ) || isset( $_SESSION['year'] ) || 
	isset( $_SESSION['order_by'] ) 	|| isset( $_SESSION['title'] ) || 
		isset( $_SESSION['author'] ) || isset( $_SESSION['category'] ) ) {
			$day = $_SESSION['day'];
			$month = $_SESSION['month'];
			$year = $_SESSION['year'];
			$order_by = $_SESSION['order_by'];
			$title = $_SESSION['title'];
			$author = $_SESSION['author'];
			$category = $_SESSION['category']; 
	}
}
$db = new database;



/**
 * Retrieve all published articles based on the date
 */
$sql = " select * from article_versions av ";
$sql .= " , article_category ac ";
if ( $day != "" ) {
	$sql .= " where av.published_day = '$day' ";
}
if ( $month != "" ) {
	if ( $day != "" ) $sql .= " and av.published_month = '$month' ";
	else $sql .= " where av.published_month = '$month' ";
}
if ( $year != "" ) {
	if (( $day != "" ) || ( $month != "" )) $sql .= " and av.published_year = '$year' ";
	else $sql .= " where av.published_year = '$year' ";
}
if ( $category != "" ) {
	if (( $day != "" ) || ( $month != "" )) {
		$sql .= " and ac.categoryID = '$category' ";
	}
	else {
		$sql .= " where ac.categoryID = '$category' ";
	}
	$sql .= " and ac.articleID = av.articleID ";				
}
if ( $title != "" ) {
	if (( $day != "" ) || ( $month != "" ) || ( $year != "" ) || ( $category != "" )) {
		$sql .= " and av.title like '%$title%' ";
	}
	else{
		$sql .= " where av.title like '%$title%' ";
	}
	$sql .= " and ac.articleID = av.articleID ";			
}
if ( $order_by != "" ) {
	if (( $day != "" ) || ( $month != "" ) || ( $year != "" ) || ( $category != "" ) || ( $title != "" )) {
		$sql .= " and ac.articleID = av.articleID  ";
		$sql .= " order by av.dateline $order_by ";
	}
	else{
		$sql .= " where ac.articleID = av.articleID  ";
		$sql .= " order by av.dateline $order_by ";
	}
}else{
	$sql .= " where ac.articleID = av.articleID ";
	$sql .= " order by av.dateline ";
}
// print $sql;
if (!( $result = $db->query( $sql ) ) ) {
	die ( 'Error:' . $db->error() );
}
$archive = array();
while ( $archive[] = $db->fetcharray() );
$db->freeresult();
$totalrows = count( $archive );
$limit = 20;
$paging = ceil( $totalrows / $limit );
$scroll = 0;
$scrollnumber = 10;

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}else{
	$page = 1;
}
$start = $page * $limit - ($limit);
$pagelink = new paging( $page, $totalrows, $limit, $paging, $scroll, $scrollnumber );
$j = $start+1;
for( $i = $start; $i < ($start+$limit); $i++ ){
	if ( $archive[$i]->articleID ) {
		(($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '" align = "left">';
	
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$row_data .= '&nbsp;'.niceDate ( $archive[$i]->dateline );
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$row_data .= '<a href="' . VIEW_ARTICLE_URL2 . $archive[$i]->articleID . '">';
		$row_data .= '&nbsp;'. $archive[$i]->title;
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$category_name = getCategory_name( $archive[$i]->articleID );
		$row_data .= $category_name;
		$row_data .= '</td>';
		
		$row_data .= '</tr>';
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
/**
 * Get all the news category
 */
$sql = " select * from category ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$category = array();
while( $row = $db->fetcharray() ) {
	$category[] = $row; 
}
$db->freeresult();

/**
 * Populate all the news-category into an array..
 */
$category_names = '';
foreach( $category as $field => $data ) {
	$category_names .= '<option value="' . $data->categoryID . '">';
	//print $data->categoryID;
	$category_names .= $data->category_name;
	$category_names .= '</option>';
}

/*
 * Get the default stylesheets
 */
include( 'admin/template.configuration.php' );
$stylesheet = ' themes/'.$default_template_name.'/'.$default_template_stylesheet; 
$db->close();
$gerger->stop();
$pagegenerated = $gerger->display();
// Generate the page now
$tpl = new template_parser( 'themes/templates/archive.tpl.php' );
$tags = array(
		'{SEARCH_STR}'		=> $keywords ,
		'{KEYWORDS}'		=> $keywords ,
		'{NUMRESULTS}'		=> ' '. count($rs) ,
		'{RESULTS}'			=> $searchresults,
		'{PAGELINK}'		=> $pagelink->pagelinks , 
		'{DATE_PUBLISHED}'	=> ' Date ',	
		'{ARTICLE_TITLE}'	=> ' Article Title ',
		'{SEARCH_TITLE}'	=> $title,	
		'{CATEGORY}'		=> ' Category ',
		'{SELECTED}'		=> ' selected ',
		'{ASC}'				=> $ascselected,
		'{DESC}'			=> $descselected,
		'{PAGE_GENERATED}'	=> '&nbsp;'.$pagegenerated,
		'{LIST_OF_YEARS}'	=> $optyear,	
		'{LIST_OF_CATEGORY}'=> $category_names,
		'{TABLE_DATA}'		=> $row_data, 
		'{FOOTER}' 			=> 'themes/templates/footer.tpl.php' ,
		'{STYLESHEET}'		=> $stylesheet
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>