<?php
include( 'configuration.php' );
//require ( 'coreclass.php' );
require ( '../admin/coreclass.php' );

/** ensure dis file is being included by a parent file -- {mh}*/
//defined('{mh}') or die("Direct access to this location is not allowed :-)");

session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: ../admin/login.php');
}

if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}

$db = new database;




// 
$sql = " select * from article_author aa, articles a ";
$sql .= " where aa.userID = " . intval ($userID); // i havent thought about this..intval
//$sql .= " where aa.userID =  ";
$sql .= " and aa.articleID = a.articleID ";

if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$my_articles = array();
while( $row = $db->fetcharray() ) {
	$my_articles[] = $row; 
}
$n = $db->getnumrows();
$db->freeresult();

// Get all the news category
$sql = " select * from category ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$category = array();
while( $row = $db->fetcharray() ) {
	$category[] = $row; 
}
$db->freeresult();

// Populate all the news-category into an array..
$category_names = '';
$category_names .= '<option value="xx" selected>Select Category</option>';
foreach( $category as $field => $data ) {
	$category_names .= '<option value="' . $data->categoryID . '">';
	//print $data->categoryID;
	$category_names .= $data->category_name;
	$category_names .= '</option>';
}

// Get the current date/time
//$date = date ( "n/d/Y h:i:s A" );
$date = date ( "F d, Y h:i:s A" );

// Get the authors name of the articles..
$author_name2 = getUser_info( $userID , 'fullname' );
for( $i = 0; $i < count( $my_articles ); $i++ ) {
	if ( $my_articles[$i]->articleID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" bgcolor = "'. $bgcolor . '">';
		$row_data .= '<td>';
		$row_data .= '<a href="' . VIEW_ARTICLE_URL . $my_articles[$i]->articleID . '">';
		$title = getArticleTitle( $my_articles[$i]->articleID );
		$row_data .= $title ;
		$row_data .= '</a>';
		$row_data .= '</td>';
		$row_data .= '<td>';
		$row_data .= '<a href=" ">';
		$row_data .= $my_articles[$i]->category_name;
		$row_data .= '</a>';
		$category_name = getCategory_name( $my_articles[$i]->articleID );
		$row_data .= $category_name;
		$row_data .= '</td>';
		$row_data .= '<td>';
		$row_data .= '<a href=" ">';
		$row_data .= $my_articles[$i]->alias_name;
		$row_data .= '<a href=" ">';
		$author_name = getAuthor_name( $my_articles[$i]->articleID );
		$row_data .= $author_name;
		$row_data .= '</td>';
		$row_data .= '<td>';
		$row_data .= $my_articles[$i]->created;
		$row_data .= '</td>';
		$row_data .= '</tr>';
	}			
}

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/edit_article.tpl.php' );
$tags = array(
/*
		'{ARTICLE_TITLE}' 	=> 'Article Title',
		'{CATEGORY}' 		=> 'Category',
		'{AUTHOR}' 			=> 'Author',
		'{DATE}' 			=> 'Date',
		'{TABLE_DATA}' => $row_data,
*/

		'{DATE_CREATED}'		=>  $date,
		'{AUTHOR}' 			=> $author_name2,
		'{CATEGORY_NAMES}' => $category_names,
		'{SITENAME}' => 'CMS Adminss',
		'{HEADER}' => ' ',
		//'{TOPNAV}' => 'dynamic button place here, DEPENDING ON THE option selected',
		'{TOPNAV}' => 'Place the fixed button here like #. of users - online, log-out btn can also place here..',
		'{SIDENAV}' => '../admin/user_menu2.php',
		'{FOOTER}' =>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();

?>