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




$sql = " select * from article_versions av ";
$sql .= " where av.stageID = 2"; // editing stage
$sql .= " order by av.created ASC ";
	
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$my_articles = array();
while( $row = $db->fetcharray() ) {
	$my_articles[] = $row; 
}
$n = $db->getnumrows();
$db->freeresult();

$message = "You have " . $n . " article(s) to be edit.";
//print_r($my_articles);
$row_data = '<form name="form1" method="post">';
for( $i = 0; $i < count( $my_articles ); $i++ ) {
	if ( $my_articles[$i]->articleID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" bgcolor = "'. $bgcolor . '">';
		$row_data .= '<td>';
		//$row_data .= $my_articles[$i]->articleID;
		$row_data .= $i+1;
		$row_data .= '</td>';			
		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="checkitem[]" id="checkitem[]" value="' . $my_articles[$i]->articleID . '">';
		//$row_data .= '<input type="checkbox" onclick="isChecked(this.checked);" name="cid[]" id="cb1" value="' . $my_articles[$i]->articleID . '">';
		$row_data .= '</td>';			
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
		//print 'cat='.$category_name;
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
		$row_data .= date( "F d, Y , g:i:s a", $my_articles[$i]->created);
		$row_data .= '</td>';
		$row_data .= '</tr>';
	}			
}
$row_data .= '</form>';


// start compiling the page..
$tpl = new template_parser( '../templates/display_writer_articles.tpl.php' );
$tags = array(
		'{ARTICLE_TITLE}' 	=> 'Article Title',
		'{CATEGORY}' 		=> 'Category',
		'{PUBLISHED}' 			=> 'Published',
		'{AUTHOR}' 			=> 'Author',
		'{DATE_CREATED}'		=> 'Date Created',
		'{TABLE_DATA}' => $row_data,
	
		'{MESSAGE}'	=> $message,
		'{SITENAME}' => 'CMS Adminss',
		'{HEADER}' => ' ',
		//'{TOPNAV}' => 'dynamic button place here, DEPENDING ON THE option selected',
		'{TOPNAV}' => 'Place the fixed button here like #. of users - online, log-out btn can also place here..',
		'{SIDENAV}' => 'user_menu2.php',
		'{FOOTER}' =>  'footer.php' 
		);
$tpl->parse_template( $tags );
print $tpl->display();


?>