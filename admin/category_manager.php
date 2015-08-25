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
if ( isset( $_SESSION['task'] ) && $_SESSION['task'] != '' ) {
	switch ( $_SESSION['task'] ) {
		case 'edit':
			$message  = 'Changes of ' . $_SESSION['title'] . ' was succesfully saved ';
			break;
		case 'add':
			$message = 'Successfully saved category: ' . $_SESSION['title'];
			break;
		case 'delete':	
			$message = 'Successfully delete the category(s) namely : ' . implode(",", $_SESSION['catnames'] );
			break;
	}
unset($_SESSION['catnames']);
unset($_SESSION['task']);			
}
//print_r($_SESSION);
$db = new database;



// Get all the news category
$sql = " select * from category order by category_name asc";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$category = array();
while( $row = $db->fetcharray() ) {
	$category[] = $row; 
}
$db->freeresult();
$totalrows = count( $category );
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
	if ( $category[$i]->categoryID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';
			
		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="cid[]" id="cb' . $i . '" value="' . $category[$i]->categoryID . '" onClick="isChecked(this.checked);"/>';
		$row_data .= '</td>';			
		
		$row_data .= '<td>';
		$row_data .= '<a href="' . VIEW_CATEGORY_DETAIL_URL . $category[$i]->categoryID . '">';
		$row_data .= $category[$i]->category_name;
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$row_data .= $category[$i]->category_desc;
		$row_data .= '</td>';
		
		$row_data .= '<td align="left">';
		$x = getArticle_category($category[$i]->categoryID);
		$row_data .= count($x);
		$row_data .= '</td>';
		
		$row_data .= '<td>&nbsp;';
		$row_data .= '</td>';
		
		$row_data .= '</tr>';
	}			
}

// start compiling the page..
$tpl = new template_parser( '../templates/category_manager.tpl.php' );
$tags = array(
		'{CATEGORY_NAME}' 	=> 'Category Name',
		'{CATEGORY_DESC}'	=> 'Category Description',		
		'{NO_OF_ARTICLES}' 	=> 'Total # of Articles',
		'{NUMITEMS}'		=> ''.$totalrows,
		'{TABLE_DATA}' 		=> $row_data,
		'{MESSAGE}'			=> $message,
		'{PAGELINK}'		=> $pagelink->pagelinks , 			
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{CONTENT}' 		=> $row_data,
		'{FOOTER}' 			=>  'footer.php' 
		
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>