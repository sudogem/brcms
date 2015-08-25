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
//print_r($_SESSION);
/**
 * set as writing stage
 */
$_SESSION['stageID'] = 1;
if ( isset( $_SESSION['task'] ) && $_SESSION['task'] != '' ) {
	switch ( $_SESSION['task'] ) {
		case 'edit':
			$message  = 'Changes of "' . $_SESSION['title'] . '" was succesfully saved ';
			break;
		case 'add':
			$message = 'Successfully saved article "' . $_SESSION['title']. '"';
			break;
		case 'submit':	
			$message = 'Successfully submit article "' . $_SESSION['title'] . '" to ' . $_SESSION['to'];
			break;
		case 'return':	
			$message = 'Successfully return article "' . $_SESSION['title'] . '" to ' . $_SESSION['to'];
			break;
		case 'approve':	
			$message = 'Successfully approve article "' . $_SESSION['title']. '"';
			break;
		case 'reject':	
			$message = 'Successfully reject article "' . $_SESSION['title']. '"';
			break;
		case 'publish':	
			$message = 'Successfully publish article "' . $_SESSION['title']. '"';
			break;
		case 'archive':	
			$message = 'Successfully archive the article(s).';
			break;
		default:
			$message = '';
			break;	
	}
}
else {
    $print_welcome_message = true;			
}

// remove pre-existing session
unset( $_SESSION['article_imgs'] );
unset ($_SESSION['task']);	
unset ($_SESSION['ctr']);

$db = new database;



// if filter was made 
if ( isset( $_SESSION['filter_text'] ) ) {
	$filter_text = $_SESSION['filter_text'];
}
// if option status was made
if ( isset( $_SESSION['optstatus'] ) ) {
	$status = $_SESSION['optstatus'];
}
// if option category was made
if ( isset( $_SESSION['optcategory'] ) ) {
	$category = $_SESSION['optcategory'];
}

$sql = " select * from article_author aa, article_category ac , articles a ";
$sql .= " where aa.userID = " . intval ($userID); // i havent thought about this..intval
$sql .= " and aa.articleID = a.articleID ";
$sql .= " and ac.articleID = a.articleID ";
$sql .= " and a.isarchive = '0' ";
if ( $filter_text ) {
	$sql .= " and LOWER( a.title ) LIKE '%$filter_text%' ";
}
if ( $category ) {
	$sql .= " and ac.categoryID = '$category' ";
}
if ( $status ) { // CONTINUE HERE LATER...
	$sql .= " and a.status = '$status' ";
}
$sql .= " order by a.created DESC ";
//print_r($_SESSION);
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
$totalrows = count( $my_articles );
$limit = 10;
$paging = ceil( $totalrows / $limit );
$scroll = 0;
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
		
		$row_data .= '<td class="blue">';
		$row_data .= '<a href="' . VIEW_ARTICLE_URL . $my_articles[$i]->articleID . '">';
		$title = getArticleTitle( $my_articles[$i]->articleID );
		$row_data .= '&nbsp;' . $title ;
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		$row_data .= '<td class="blue2">';
		$row_data .= '<a href="' . VIEW_CATEGORY_DETAIL_URL . $my_articles[$i]->categoryID . '">';
		$category_name = getCategory_info( $my_articles[$i]->categoryID,'category_name' );
		$row_data .= '&nbsp;' . $category_name;
		$row_data .= '</a>';		
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
			case 5://live
				$row_data .= 'class="green">';
				break;
			case 6://live
				$row_data .= 'class="green">';
				break;
		}
		$row_data .= '&nbsp;' . getStage_name ( $my_articles[$i]->stageID );		
		$row_data .= '</td>';

		$row_data .= '<td ';
		//$status = getArticle_version_info ( $my_articles[$i]->articleID, 'status' );	
		$status = $my_articles[$i]->status;		
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
		
		$row_data .= '<td class="black">';
		$date = ($my_articles[$i]->modified)?friendlyDate2($my_articles[$i]->modified):'0';
		$row_data .= '&nbsp;' . $date;
		$row_data .= '</td>';
		
		$row_data .= '</tr">';
	}			
}
/**
 * Create an array of article status for the option lists
*/
$status = array( "approved", "revise", "reject", "edited", "published" , "live" ); 
foreach( $status as $idx => $value ) {
	if ( $value == $_SESSION['optstatus'] ) {
		$optstatus .= "<option value='$value' selected>$value</option>";	
	}
	else{
		$optstatus .= "<option value='$value' >$value</option>";		
	}
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
	if ( $data->categoryID == $_SESSION['optcategory'] ) {
		$category_names .= '<option value="' . $data->categoryID . '" selected >';
		$category_names .= $data->category_name;
		$category_names .= '</option>';
	}
	else{
		$category_names .= '<option value="' . $data->categoryID . '">';
		$category_names .= $data->category_name;
		$category_names .= '</option>';
	}
}
// ok baby, lets start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/display_writer_articles.tpl.php' );
$tags = array(
	'{ARTICLE_TITLE}' 	=> 'Article Title',
	'{CATEGORY}' 		=> 'Category',
	'{PUBLISHED}' 		=> 'Published',
	'{AUTHOR}' 			=> 'Author',
	'{DATE_CREATED}'	=> 'Date Created',
	'{LAST_MODIFIED}'	=> 'Last Modified',
	'{NUMITEMS}'		=> ''. $totalrows,
	'{TABLE_DATA}' 		=> $row_data ,
	'{STAGEID}' 		=> 'Stage',
	'{FILTER_TEXT}'		=> $filter_text,
	'{CATEGORY_NAMES}'	=> $category_names,
	'{LIST_OF_STATUS}'	=> $optstatus,
	'{STATUS}'			=> 'Status',
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