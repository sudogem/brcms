<?php
include( 'configuration.php' );
require ( 'coreclass.php' );

/** ensure dis file is being included by a parent file -- {mh}*/
//defined('{mh}') or die("Direct access to this location is not allowed :-)");

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




// GET articleID
$articleID = $_GET['articleID'];
$_SESSION['articleID'] = $articleID;

// PROBLEM MIGHT BE SOMETHING HERE.....
/*
$sql = " select * from articles a, ";
$sql .= " article_author aa ";
$sql .= " where aa.userID = " . intval($userID);
$sql .= " and aa.articleID = " . intval($articleID) ;
*/
$sql = " select * from article_versions av ";
$sql .= " where av.stageID=2"; // editing stage
$sql .= " and av.articleID=" . $articleID;
$sql .= " order by av.created ASC ";


print $sql ;
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$view_article_detail = array();
while( $row = $db->fetcharray() ) {
	$view_article_detail[] = $row; 
}
//print_r ($view_article_detail);
$db->freeresult();

$category_name = getCategory_name ( $articleID );
$article_authors = getUser_info ( $userID , 'fullname' );

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/view_article_detail.tpl.php' );
$tags = array(
/*
		'{ARTICLE_TITLE}' 	=> 'Article Title',
		'{CATEGORY}' 		=> 'Category',
		'{ARTICLE_AUTHORS}' => 'Author',
		'{DATE}' 			=> 'Date',
*/
		'{ARTICLE_TITLE}' 	=> $view_article_detail[0]->title,
		'{CATEGORY}' 		=> $category_name,
		'{AUTHOR}' 			=> $article_authors,
		'{DATE_CREATED}' 	=> friendlyDate( $view_article_detail[0]->created ),
		'{ARTICLE_BODY}'	=> $view_article_detail[0]->article_body,

		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		//'{TOPNAV}' => 'dynamic button place here, DEPENDING ON THE option selected',
		'{TOPNAV}' 			=> 'Place the fixed button here like #. of users - online, log-out btn can also place here..',
		'{SIDENAV}' 		=> 'user_menu2.php',
		'{FOOTER}' 			=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();

?>