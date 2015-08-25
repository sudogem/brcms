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
$date = date ( "F d, Y h:i:s A" );
$db = new database;



/**
 * Get the image sets of the article
 */
if ( $_SESSION['task'] == 'add' ) {
	$sql = " select * from stockphotos s , ";
	$sql .= " article_imgs ai ";
	$sql .= " where ai.articleID=" . $_SESSION['articleID'];
	$sql .= " and ai.imageID = s.imageID ";
	$db->query( $sql );
	$article_images = array();
	while( $article_images[] = $db->fetcharray() ); 
	$thumbnail = '';
	for( $i = 0; $i< count( $article_images )-1; $i++ ){
		foreach( $article_images as $field => $value ) {
			if ( $field == 'imageID' ) {
				$thumbnail .= '<img src="' . '" name="Image1" width="50" height="50" border="0">';		
			}
		}
	}
} 

/**
 * Get all the tasks
 */
$sql = " select * from tasks where assignedto =  '$userID' 
		and status != 'Completed' ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
//echo $sql;
$tasks = array();
while( $row = $db->fetcharray() ) {
	$tasks[] = $row; 
}
$db->freeresult();
$tasklist = '';
foreach( $tasks as $field => $data ) {
	$tasklist .= '<option value="' . $data->taskID . '">';
	$tasklist .= $data->subject;
	$tasklist .= '</option>';
}

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/add_new_segments2.tpl.php' );
$tags = array(
		'{CATEGORY_NAME}' 	=> $category_name ,
		'{CATEGORY_DESC}'	=> $category_desc ,
		'{MESSAGE}'			=> $message ,
		'{DATE_CREATED}'	=> $date,
		'{TASKS}'			=> $tasklist,                    		
		'{THUMBNAIL}'		=> $thumbnail,		
		'{SITENAME}' 		=> 'CMS Adminss',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>