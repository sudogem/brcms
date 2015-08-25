<?php
include( 'configuration.php' );
require ( '../admin/coreclass.php' );
session_start();
//print_r($_SESSION);
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: ../admin/login.php');
	exit;
}
if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
	// log the activity
	$action = new activity();
	//$action->track_activity( $userID, $action->writing_article );
}
$db = new database;



//print_r($_POST);
// print_r($_SESSION['article_imgs']);
if ($_SESSION['task'] == 'add' ) {
	$message  = 'Successfully Saved Item : ' . $_SESSION['title'];
	unset($_SESSION['task']);
}
else {
	// unset any pre-existing session vars..selected only..
	unset($_SESSION['articleID']);
	unset($_SESSION['title']);
	unset($_SESSION['article_body']);
	unset($_SESSION['dateline']);
	unset($_SESSION['created']);
	unset($_SESSION['edited_by']);
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

/**
 * Get all the news category
 */
$sql = " select * from category ";
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
	$category_names .= '<option value="' . $data->categoryID . '">';
	//print $data->categoryID;
	$category_names .= $data->category_name;
	$category_names .= '</option>';
}

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
// set the default stage to be choose
$stage .= '<option value="1" selected >';
$stage .= 'News draft';
$stage .= '</option>';
$stage .= '<option value="2" >';
$stage .= 'Writing';
$stage .= '</option>';

if ($_SESSION['dateline'] ) {
	// Get from the session date
	$date = friendlyDate($_SESSION['dateline']);
}
else {
	// Get the current date/time
	$date = date ( "F d, Y h:i:s A" );
}
// Get the authors name of the articles..
$author_name2 = getUser_info( $userID , 'fullname' );
//print_r($_SESSION);
$article_title 	= $_SESSION['article_title'];
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/add_article2.tpl.php' );
$tags = array(
		'{TITLE}'			=> $article_title,
		'{BODY}'			=> $article_body,
		'{DATE_CREATED}'	=> $date,
		'{MESSAGE}'			=> $message,	
		'{AUTHOR}' 			=> $author_name2,
		'{CATEGORY_NAMES}' 	=> $category_names,
		'{TASKS}'			=> $tasklist,                    
		'{UPLOADED_IMAGES}'	=> $uploaded_imgs,
		'{STAGE}' 			=> $stage,
		'{THUMBNAIL}'		=> $thumbnail,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> '../admin/top_menu.php',
		'{BREADCRUMB}'		=> $url, 			
		'{FOOTER}' 			=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>