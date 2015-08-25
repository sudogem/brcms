<?php
require ( 'admin/coreclass.php' );
$articleID = $_GET['articleID'];
$db = new database;



$sql = "select * from article_versions ";
$sql .= " where articleID=" . intval( $articleID );
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
while( $article[] = $db->fetcharray());
$db->freeresult();

$title = $article[0]->title;
$author = getArticle_authors_info( $article[0]->articleID , 'fullname' );
$dateline = friendlyDate3( $article[0]->dateline );
$body = strip_tags( $article[0]->article_body,'' );
$doc = new document_generator( 'templates/preview.rtf' );
$tags = array(
	'<TITLE>'	=> $title,
	'<AUTHOR>'	=> $author,
	'<DATELINE>'=> $dateline,
	'<BODY>'	=> $body
);
$doc->doc_tags( $tags );
echo $doc->display();
?>