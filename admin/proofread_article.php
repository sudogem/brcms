<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
/** ensure dis file is being included by a parent file -- {mh}*/
defined('{mh}') or die("Direct access to this location is not allowed :-)");

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




$result_data = array();
//$result_data = query_data();

$sql = " select * from article_versions av ";
$sql .= " where av.stageID = 3 "; //'3', 'editing', 'the story is written and is ready for review'
if (!($result = $db->query( $sql ))) {
	die('Error:'. $db->error());
}
print $sql;
$proofread_article = array();
while ( $row = $db->fetcharray() ) {
	$proofread_article[] = $row;
}
$n = $db->getnumrows();
$db->freeresult();

//print_r($proofread_article);

// start compiling the page..
$tpl = new template_parser( '../templates/display_article.tpl.php' );
$tags = array(
		'{ARTICLE_TITLE}' 	=> 'Article Title',
		'{CATEGORY}' 		=> 'Category',
		'{AUTHOR}' 			=> 'Author',
		'{DATE}' 			=> 'Date',
		'{TABLE_DATA}' => $row_data
		);
$tpl->parse_template( $tags );
print $tpl->display();

print '<h1>You have ' . $n  . ' article(s) to be reviewed.</h1>';
print_r($proofread_article);

?>