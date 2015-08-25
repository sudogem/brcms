<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
session_start();
if ( !isset($_SESSION['login'])) { 
	header('Location: login.php');
}
if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}
$articleID = $_GET['articleID'];
// TODO; MUST allow the article to preview no matter what stages been set on..
// so, we hav to change the code into a flexible style....
$db = new database;



$sql = " select * from articles a ";
$sql .= " where a.articleID=" . intval($articleID);
if (!($result = $db->query($sql))){
	die('Error:'. $db->error());
}
$article = array();
while( $article[] = $db->fetcharray() );
$title = $_SESSION['title'];
$article_body = $_SESSION['article_body'];
$category = $_SESSION['category'];
$writer_name = $_SESSION['created_by'];
$datecreated = friendlydate( $_SESSION['created'] );
/**
 * Get the image sets of the article
 */
$sql = " select * from stockphotos s, ";
$sql .= " article_imgs ai ";
$sql .= " where ai.articleID=" . $_SESSION['articleID'];
$sql .= " and ai.imageID = s.imageID ";
$sql .= "and ai.show_image = 1";
$db->query( $sql );
$article_images = array();
while( $article_images[] = $db->fetcharray() ); 

$thumbnail = '';
for( $i = 0; $i< count( $article_images )-1; $i++ ){
	foreach( $article_images as $field => $value ) {
		if ( $field == 'imageID' ) {
			$x = makeRelativePath($article_images[$i]->image_filename, 4);
			$thumbnail .= '<div class="xpthumbnail">';
			$thumbnail .= '<img src="' . $x . '" name="Image1" class="" width="200"  height="100" border="0" >';		
			$thumbnail .= '<p><b>Photo by:</b>' . $article_images[$i]->image_photographer_author . '</p>';
			$thumbnail .= '<p><b>Caption:</b>' . $article_images[$i]->image_captions . '</p>';
			$thumbnail .= '<p><b>Alt:</b>' . $article_images[$i]->image_alttext . '</p>';
			if( $article_images[$i]->show_image ) {
				$thumbnail .= '<div align="center"><img src="images/apply_f2.png"  border="0" alt="" align="" />';	
				$thumbnail .= '<p class="orange"><b>Selected</b></p>';
				$thumbnail .= '</div>';
			}
			$thumbnail .= '</div>';
		}
	}
}

// start generating page
$tpl = new template_parser( '../templates/preview_article.tpl.php' );
$tags = array(
		'{CATEGORY}'		=> $category,
		'{WRITER_NAME}'		=> $writer_name,
		'{DATE_CREATED}'	=> $datecreated,	
		'{TITLE}'			=> $article[0]->title,
		'{ARTICLE_BODY}' 	=> $article[0]->article_body,
		'{THUMBNAIL}'		=> $thumbnail,
);

$tpl->parse_template( $tags );
print $tpl->display();
?>

