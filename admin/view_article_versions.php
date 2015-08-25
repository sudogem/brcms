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
switch( $usertype ){
	case 'News Editor':
		$assigned_category = getCategory_info( getUser_assigned_category( $userID ), 'categoryID' );
		$editor_on_category = true; // this user is an editor
		break;
}
if ( isset( $_SESSION['task'] ) && $_SESSION['task'] != '' ) {
	switch ( $_SESSION['task'] ) {
		case 'edit':
			$message  = 'Changes of "' . $_SESSION['title'] . '" was succesfully saved ';
			break;
		case 'add':
			$message = 'Successfully saved article "' . $_SESSION['title']. '"';
			break;
		case 'sent':	
			$message = 'Successfully submit article "' . $_SESSION['title'] . '" to ' . $_SESSION['to'];
			break;
		case 'return':	
			$message = 'Successfully return article "' . $_SESSION['title'] . '" to ' . $_SESSION['to'];
			break;
		case 'approve':	
			$message = 'Successfully approve article "' . $_SESSION['title'] . '"';
			break;
		case 'reject':	
			$message = 'Successfully reject article "' . $_SESSION['title'] . '"';
			break;
		case 'archive':	
			$message = 'Successfully archive the article(s).';
			break;
		case 'publish':	
			$message = 'Successfully publish article(s) ';
			break;
		default:
			$message = '';
			break;	
	}
	unset ($_SESSION['task']);	
}
else {
  $print_welcome_message = true;			
}
// print_r($_POST);
// if filter was made 
if ( isset( $_POST['filter_text'] ) ) {
	$_SESSION['filter_text'] = $_POST['filter_text'];
}
// if option status was made
if ( isset( $_POST['status'] ) ) {
	$_SESSION['status'] = $_POST['status'];
}
// if option category was made
if ( isset( $_POST['category'] ) ) {
	$_SESSION['optcategory'] = $_POST['category'];
}
if ( isset( $_POST['frontpage'] ) ) {
	$_SESSION['optfrontpage'] = $_POST['frontpage'];
}
if ( isset( $_POST['author'] ) ) {
	$_SESSION['author'] = $_POST['author'];
}
// if filter was made 
if ( isset( $_SESSION['filter_text'] ) ) {
	$filter_text = $_SESSION['filter_text'];
}
// if option status was made
if ( isset( $_SESSION['status'] ) ) {
	$status = $_SESSION['status'];
}
// if option category was made
if ( isset( $_SESSION['optcategory'] ) ) {
	$category = $_SESSION['optcategory'];
}
if ( isset( $_SESSION['author'] ) ) {
	$author = $_SESSION['author'];
}

$sql = " select * from article_versions av ";
//if ( $category != 0 ) $sql .= " , article_category ac ";
//print_r($_POST);
if (isset($_GET['stageID'])){
	$_SESSION['stageID'] = $_GET['stageID'];
}
switch ( $_SESSION['stageID'] ) {
	case 1: // writing
		break;
	case 2: // editing
		$sql .= " where av.stageID=2";
		$sql .= " and av.status ='revise' ";
		$set_template = "../templates/view_article_versions.tpl.php";			
		break;
	case 3: // editing
		if ( $assigned_category ) $sql .= ", article_category ac ";
		$sql .= " where ((av.stageID = 2 and av.status != 'revise') ";
		$sql .= " or (av.stageID = 3 and av.status = 'revise' ))";
		if ( $assigned_category ){
			$sql .= " and (( ac.articleID = av.articleID and ac.categoryID = '$assigned_category' ))";
			//$sql .= " group by av.articleID ";
		}
		$set_template = "../templates/view_article_versions_review.tpl.php";							
		$heading = "Edit Article";
		break;
	case 4: // evaluating
		$sql .= " where (av.stageID=3 and av.status != 'revise') ";
		$sql .= " or ( av.stageID=3 and av.status = 'edited' )";
		$set_template = "../templates/view_article_versions_review.tpl.php";			
		$heading = "Evaluate Article";
		break;
	case 5: // publishing
		$sql .= " where av.stageID=4";
		$set_template = "../templates/view_article_versions_publish.tpl.php";
		break;
	case 6: // live
		$sql .= " where av.stageID=6";
		$_SESSION['stageID'] = 6;
		$set_template = "../templates/view_article_versions_publish_unpublish.tpl.php";
		$heading = "All News Content";
		break;
}
//$sql .= " group by av.article_versionID ";
//if ($category != 0 ) $sql2 .= " and ac.categoryID = '$category' and ac.articleID = av.articleID group by av.articleID ";
//$sql .= $sql2;
$sql .= " and av.isarchive = '0' ";
if ( $_SESSION['stageID'] == 6 ){
	$sql .= " order by av.dateline DESC ";
}else{
	$sql .= " order by (  av.created ) DESC ";
}	

$db = new database;



//print_r($_SESSION);

//print $sql;	
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$article_versions = array();
while( $row = $db->fetcharray() ) {
	$article_versions[] = $row; 
}
$n = $db->getnumrows();
$db->freeresult();

$totalrows = count( $article_versions );
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
//print_r($article_versions);
$j = $start+1;
for( $i = $start; $i < $start+$limit ; $i++ ) {
	if ( $article_versions[$i]->articleID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';

		switch( $usertype ){
			case 'Administrator':
			case 'Publisher':	
				$row_data .= '<td>';
				$row_data .= '<input type="checkbox" name="cid[]" id="cb' . $i . '" value="' . $article_versions[$i]->articleID . '" onClick="isChecked(this.checked);"/>';
				$row_data .= '</td>';			
				break;
		}				
		
		$row_data .= '<td class="blue2">';
		$row_data .= '<a href="' . VIEW_ARTICLE_URL . $article_versions[$i]->articleID . '">';
		$row_data .= '&nbsp;' . $article_versions[$i]->title;
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		$row_data .= '<td class="viola">';
		$category_name = getCategory_name( $article_versions[$i]->articleID );
		$row_data .= '&nbsp;' . $category_name;
		$row_data .= '</td>';
		
		$row_data .= '<td class="cyan">';
		$author_name = getArticle_authors_info ( $article_versions[$i]->articleID, 'fullname' );
		$row_data .= '&nbsp;' .  $author_name;
		$row_data .= '</td>';
		
		$row_data .= '<td class="blue2">';
		$category_name = getFrontpage_type( $article_versions[$i]->articleID );
		$row_data .= '&nbsp;' . $category_name;
		$row_data .= '</td>';
		
		$row_data .= '<td class="green">';
		$row_data .= '&nbsp;' . getStage_name ( $article_versions[$i]->stageID );
		$row_data .= '</td>';
		
		switch ( $_SESSION['stageID'] ) {
			case 2:
			case 3:
			case 4:
				$row_data .= '<td ';
				$status =  ( $article_versions[$i]->status );			
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
				break;
		}
		
		$row_data .= '<td class="brown">';
		$row_data .= '&nbsp;' . friendlyDate2($article_versions[$i]->created);
		$row_data .= '</td>';
		
		switch ( $_SESSION['stageID'] ) {
			case 6:// published date of the article..can be viewd by the admin only???
				$row_data .= '<td class="green">';
				$date = ($article_versions[$i]->dateline)?friendlyDate2($article_versions[$i]->dateline):'0';
				$row_data .= '&nbsp;' . $date;
				$row_data .= '</td>';
				break;
			default:
				$row_data .= '<td class="black">';
				$date = ($article_versions[$i]->modified)?friendlyDate2($article_versions[$i]->modified):'0';
				$row_data .= '&nbsp;' . $date;
				$row_data .= '</td>';
				break;	
		}
		$row_data .= '</tr>';
	}			
}

/**
 * Populate all the content users into an array..
 */
$sql = " select * from content_users order by fullname";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$users = array();
while( $row = $db->fetcharray() ) {
	$users[] = $row; 
}
$content_users = '';
foreach( $users as $field => $data ) {
	if ( $data->userID == $_SESSION['author'] ) {
		$content_users .= '<option value="' . $data->userID . '" selected >';
		$content_users .= $data->fullname;
		$content_users .= '</option>';
	}
	else{
		$content_users .= '<option value="' . $data->userID . '">';
		$content_users .= $data->fullname;
		$content_users .= '</option>';
	}
}

/**
 * Get all the news category
 */
$sql = " select * from category order by category_name";
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

// link for print preview
$link = "preview_article.php?articleID=$articleID";
$referrer = $_SERVER['HTTP_REFERER'];
 print $set_template;
// start compiling the page...
$tpl = new template_parser( $set_template );
$tags = array(
		'{HEADING}'			=> $heading,
		'{ARTICLE_TITLE}' 	=> 'Article Title',
		'{CATEGORY}' 		=> 'Category',
		'{CATEGORY_NAMES}'	=> $category_names,
		'{LIST_OF_STATUS}'=> $optstatus,
		'{LIST_OF_AUTHOR}'	=> $content_users,		
		'{FILTER_TEXT}'		=> $filter_text,
		'{REFERRER}'		=> $referrer,
		'{PUBLISHED}' 		=> 'Published',
		'{AUTHOR}' 			=> 'Author',
		'{DATE_CREATED}'	=> 'Date Created',
		'{LAST_MODIFIED}'	=> 'Last Modified',
		'{DATE_PUBLISHED}'	=> 'Date Published',
		'{STAGEID}' 		=> ' Stage ',
		'{STATUS}'			=> 'Status',
		'{PHPSELF}'			=> ' view_article_versions.php?stageID=5',	
		'{TABLE_DATA}' 		=> $row_data,
		'{PAGELINK}'		=> $pagelink->pagelinks , 			
		'{FRONTPAGE}' 		=> 'Frontpage',
		'{NUMITEMS}'		=> ' '.$totalrows,		
		'{MESSAGE}'			=> $message,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>