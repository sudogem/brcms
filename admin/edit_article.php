<?php
include( 'configuration.php' );
require ( '../admin/coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: ../admin/login.php');
}
if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
	// Log the activity
	$action = new activity;
	$action->track_activity( $userID, $action->editing_article, $_SESSION['title'] );
}
// print_r($_SESSION);
// print_r($_SESSION['article_imgs']);
unset($_SESSION['article_imgs']);
$db = new database;



// get the checked item of the article..
if ( isset ( $_POST['checkitem'][0] ) && $_POST['checkitem'][0] != '' ) {
	$articleID = $_POST['checkitem'][0];
	$_SESSION['articleID'] = $articleID;
}
switch ( $_SESSION['stageID'] ) {
	case 1:
		$set_template = "../templates/edit_article2.tpl.php";									
		break;
	case 2: // editing 
		$set_template = "../templates/edit_article_editor2.tpl.php";								
		break;
	case 3: // proofreading
		$set_template = "../templates/edit_article_editor2.tpl.php";								
		break;		
	case 4: // publishing
		if (!($set_template != '')) $set_template = "../templates/edit_article.tpl.php";							
		break;
}

$n = $db->getnumrows();
$db->freeresult();

/**
 * Get all the tasks
 */
$sql = " select * from tasks where assignedto =  '$userID' and status != 'Completed' ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
//echo $sql;
$tasks = array();
while( $row = $db->fetcharray() ) {
	$tasks[] = $row; 
}
$sql = "select * from article_tasks where articleID = "  . $_SESSION['articleID'];
$db->query( $sql );
$currenttask[] = $db->fetcharray();
$db->freeresult();
$tasklist = '';
foreach( $tasks as $field => $data ) {
	if ( $data->taskID == $currenttask[0]->taskID ) {
		$tasklist .= '<option value="' . $data->taskID . '" selected >';
		$tasklist .= $data->subject;
		$tasklist .= '</option>';
	}
	else{
		$tasklist .= '<option value="' . $data->taskID . '">';
		$tasklist .= $data->subject;
		$tasklist .= '</option>';
	}
}

// Get all the news category
$sql = " select * from category ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
// Populate all the news-category into an array..
$category = array();
while( $row = $db->fetcharray() ) {
	$category[] = $row; 
}
$db->freeresult();

// Get the current category of the article..
$current_category_name = getCategory_name( $_SESSION['articleID'] );
$category_names = '';
foreach( $category as $field => $data ) {
	// set the default category of the article..
	if ( $data->category_name == $current_category_name ) {
		$category_names .= '<option value="' . $data->categoryID . '" selected>';
		$category_names .= $data->category_name;
		$category_names .= '</option>';
	}
	else{ // loop other categorys
		$category_names .= '<option value="' . $data->categoryID . '">';
		$category_names .= $data->category_name;
		$category_names .= '</option>';
	}	
}
// Return the allowable stages to be set given the stageID of the article..
// howevr, this part of code is already useless,,ive changed it to more flexible style.
// so no more dropdown of stages will happen.
$allow_stage_to_set = allow_Stage_to_Set ( $_SESSION['stageID'] ) ;
$sql = " select * from stages s ";
$sql .= " where s.stageID=" . intval( $_SESSION['stageID'] ) ;
$sql .= " or s.stageID=" . intval( $allow_stage_to_set );
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}

$allow_stage = array();
$stage = '';
while ( $allow_stage[] = $db->fetcharray() );
for ( $i = 0; $i < count($allow_stage)-1; $i++ ) {
	foreach( $allow_stage as $field => $value ) {
		if ( $field == 'stageID' ) {
			if ( $value->stageID == $edit_articles[$i]->stageID ) { // Get the stageID of the article..
				$stage .= '<option value="' . $allow_stage[$i]->stageID . '" selected >';		
				$stage .= $allow_stage[$i]->stage ;
				$stage .= '</option>';
			}
			else {
				$stage .= '<option value="' . $allow_stage[$i]->stageID . '"  >';		
				$stage .= $allow_stage[$i]->stage ;
				$stage .= '</option>';
			}
		}
	}
}
/**
 * Get the image sets of the article
 */
$sql = " select * from stockphotos s, ";
$sql .= " article_imgs ai ";
$sql .= " where ai.articleID=" . $_SESSION['articleID'];
$sql .= " and ai.imageID = s.imageID ";
$db->query( $sql );
$article_images = array();
while( $article_images[] = $db->fetcharray() );
//print_r($article_images); 
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
			$thumbnail .= '<div align="center">&nbsp;';	
			
			$thumbnail .= '<a href="#" onClick=popupWindow("' . "../admin/popups/edit_imageinfo.php?imgID=" . $article_images[$i]->imageID . '","win1",350,450,"no","yes");>';
			$thumbnail .= '<b>Image Details</b>';
			$thumbnail .= '</a>';
			$thumbnail .= '&nbsp;&nbsp;&nbsp;&nbsp;';
			$thumbnail .= '<a href="#"  onClick=popupWindow("' . "$x" . '",' . "$i" . ',350,350,"yes","yes");>';
			$thumbnail .= '<b>Preview Image</b>';
			$thumbnail .= '</a>';
			
			$thumbnail .= '</div>';
			$thumbnail .= '</div>';
		}
	}
}

// Populate frontpage sections
$sql = " select * from frontpage_sections ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$frontpage = array();
while ( $row = $db->fetcharray() )$frontpage[] = $row;

$sql = "select * from user_stage us,
		stages s
		where us.userID = $userID
		and	s.stageID = us.stageID ";
// print $sql;		
if (!($result = $db->query($sql))){
	die('Error:'. $db->error());
}
$user_stage = array();
while ( $row = $db->fetcharray() ) {
	$user_stage[] = $row;
}
$db->freeresult();
// continue here..my bitok is hungry :( kalooy sad...
// the user has the right to put the article on frontpage regardless of the position..
foreach( $user_stage as $key => $stage ){
	if (( $stage->stageID == 3 ) || ( $stage->stageID == 2 )){
		$xxx = true;
		break;
	}	
}
//if ( strcasecmp( $usertype, 'news editor' ) == 0 ) {
if ( $xxx ) {
	// Lets dtermine where the article is part on the frontpage
	$current_frontpage_type = getFrontpage_type( $_SESSION['articleID'] );
	//echo $current_frontpage_type;
	// populate the frontpage tpye
		foreach( $frontpage as $field => $value ) {
			// select dah current frontpage type if it exists..
				if ( $value->frontpage_section == $current_frontpage_type ) { 
					$optfrontpage .= '<option value="' . $value->frontpage_sectionID . '" selected >';		
					$optfrontpage .= $value->frontpage_section ;
					$optfrontpage .= '</option>';
				}
				else {
					if ($value->frontpage_section == 'Regular News' ) {
						$optfrontpage .= '<option value="' . $value->frontpage_sectionID . '" selected >';		
						$optfrontpage .= $value->frontpage_section;
						$optfrontpage .= '</option>';
					}else{
						$optfrontpage .= '<option value="' . $value->frontpage_sectionID . '"  >';		
						$optfrontpage .= $value->frontpage_section;
						$optfrontpage .= '</option>';
					}
				}
			}
	
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
					$thumbnail .= '<pre class="orange"><b>Select image:</b><input name="imageID[]' .  '" type="checkbox" class="bigbox" value="' . $article_images[$i]->imageID . '" checked ></pre>';
				}
				else{
					$thumbnail .= '<pre class="orange"><b>Select image:</b><input name="imageID[]' .  '" type="checkbox" class="bigbox" value="' . $article_images[$i]->imageID . '" ></pre>';
				}
				$thumbnail .= '<a href="#" onClick=popupWindow("' . "../admin/popups/edit_imageinfo.php?imgID=" . $article_images[$i]->imageID . '","win1",350,450,"no","yes");>';
				$thumbnail .= '<b>Image Details</b>';
				$thumbnail .= '</a>';
				$thumbnail .= '&nbsp;&nbsp;&nbsp;&nbsp;';
				$thumbnail .= '<a href="#"  onClick=popupWindow("' . "$x" . '",' . "$i" . ',350,350,"yes","yes");>';
				$thumbnail .= '<b>Preview Image</b>';
				$thumbnail .= '</a>';
				
				$thumbnail .= '</div>';
			}
		}
	}
}
//  echo $set_template;
// Get the authors name
$author_name = getUser_info( $userID , 'fullname' );
$keywords = getArticle_keywords( $_SESSION['articleID'] );
// Get the article body of this article..
// print_r($_SESSION);
$article_body = $_SESSION['article_body'];
$article_title = $_SESSION['title'];
// echo $article_body;
$created = $_SESSION['created'];
// ok baby, lets start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( $set_template );
$tags = array(
		'{STAGE}' 			=> $stage,
		'{ARTICLE_TITLE}' 	=> $article_title,
		'{DATE_CREATED}'	=> friendlydate($created),
		'{CATEGORY_NAMES}' 	=> $category_names,
		'{TASKS}'			=> $tasklist,                    		
		'{KEYWORDS}' 		=> $keywords,		
		'{AUTHOR}' 			=> $author_name,
		'{THUMBNAIL}'		=> $thumbnail,
		'{MESSAGE}'			=> $message,
		'{BODY}' 			=> $article_body , 
		'{FRONTPAGE}'		=> $optfrontpage,	
		'{SITENAME}' 		=> 'CMS Adminss',
		'{HEADER}' 			=> ' ',
		'{TOPNAV}' 			=> '../admin/top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();

?>