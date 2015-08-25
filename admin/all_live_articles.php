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




$result_data = array();
//$result_data = query_data();

$sql = " select * from article_versions av ";
$sql .= " where av.stageID = 5 "; // '5', 'live', 'the story is available on the live site'
$sql .= " order by av.created DESC ";

if (!($result = $db->query( $sql ))) {
	die('Error:'. $db->error());
}

//print $sql;
$live_articles = array();
while ( $row = $db->fetcharray() ) {
	$live_articles[] = $row;
}
$n = $db->getnumrows();
$db->freeresult();

for( $i = 0; $i < count( $live_articles ); $i++ ) {
	if ( $live_articles[$i]->articleID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $i+1;
		$row_data .= '</td>';

		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="checkitem[]" id="checkitem[]" value="' . $article_versions[$i]->articleID . '">';
		$row_data .= '</td>';			
		
		$row_data .= '<td>';
		$row_data .= '<a href="' . VIEW_ARTICLE_URL . $live_articles[$i]->article_versionID . '">';
		$row_data .= '<input type="hidden" value = "' . $live_articles[$i]->article_versionID . '">';		
		$row_data .= $live_articles[$i]->title;		
		$row_data .= '</a>';
		$row_data .= '</td>';

		$row_data .= '<td align="center">';
		$author_name = getArticle_authors ( $live_articles[$i]->articleID );
		$row_data .= $author_name;
		$row_data .= '</td>';
		
		$row_data .= '<td align="center">';
		$category_name = getCategory_name( $live_articles[$i]->articleID );
		$row_data .= $category_name;
		$row_data .= '</td>';
		
		$row_data .= '<td align="center">';
		$row_data .= getStage_name ( $live_articles[$i]->stageID );
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$row_data .= friendlyDate( $live_articles[$i]->created );
		$row_data .= '</td>';
		
		$row_data .= '</tr>';
	}			
}

// start compiling the page..
$tpl = new template_parser( '../templates/display_article_versions.tpl.php' );
$tags = array(
		'{ARTICLE_TITLE}' 	=> 'Article Title',
		'{CATEGORY}' 		=> 'Category',
		'{AUTHOR}' 			=> 'Author',
		'{DATE_CREATED}'	=> 'Date Created',
		'{STAGEID}' 		=> ' Stage ',
		'{TABLE_DATA}' 		=> $row_data,
		'{MESSAGE}'			=> $message,
		
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		//'{TOPNAV}' => 'dynamic button place here, DEPENDING ON THE option selected',
		'{TOPNAV}' 			=> 'Place the fixed button here like #. of users - online, log-out btn can also place here..',
		'{SIDENAV}' 		=> 'user_menu2.php',
		'{CONTENT}' 		=> $row_data,
		'{FOOTER}' 			=>  'footer.php' 
		
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>