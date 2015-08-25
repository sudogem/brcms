<?php
/**
 * @name  		: corefunctions.php
 * @purpose     : Lots of functions that makes my life easier...
 * @author 	    : mh
 */
 
/** Return the category name of the articleID
 * @param int articleID
 */
function getCategory_name( $articleID = 0 ) {
	$sql = " select category_name from category c, article_category ac ";
	$sql .= " where ac.articleID = " . intval($articleID) ;
	$sql .= " and ac.categoryID = c.categoryID ";
	
	$db = new database;

	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	if ($category_name = $db->fetcharray());
	return $category_name->category_name;
}
/** Return the article belongs in the category
 * @param int categoryID, 
 */
function getArticle_category( $categoryID = 0 ){
	$sql = " select * from article_category ac ";
	$sql .= " where ac.categoryID =". intval( $categoryID );
	
	$db = new database;
	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	$article_category = array();
	while ( $row = $db->fetcharray()){
	$article_category[] = $row;
	}
	return $article_category;
}

/** Return the category assigned for the editor
 * @param int userID, 
 */
function getUser_assigned_category( $userID ){
	$sql = " select * from content_editor ce ";
	$sql .= " where ce.userID= '$userID' ";
	$db = new database;
	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	if ($assigned_category = $db->fetcharray());
	return $assigned_category->categoryID;
}

/** Return the category info of the articleID
 * @param int articleID, string info
 */
function getArticle_category_info( $articleID = 0 , $info = '' ){
	$sql = " select * from category c , article_category ac ";
	$sql .= " where c.categoryID = ac.categoryID ";
	$sql .= " and ac.articleID=" . intval( $articleID );
	
	$db = new database;
	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	if ($category_name = $db->fetcharray());
	return $category_name->$info;
}

/** Return the category info
 * @param int categoryID, string info
 */
function getCategory_info( $categoryID = 0 , $info = '' ){
	$sql = " select * from category c ";
	$sql .= " where c.categoryID=" . intval( $categoryID );
	
	$db = new database;
	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	if ($category_name = $db->fetcharray())	
		return $category_name->$info;
	else
		return false;	
}

/** Return the category info
 * @param int categoryID, string info
 */
function checkIfCategoryContainsArticle( $categoryID = 0 ){
	$sql = " select * from category c ";
	$sql .= " where c.categoryID=" . intval( $categoryID );
	
	$db = new database;
	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	if ($category_name = $db->fetcharray());
	return $category_name->$info;
}

/** Return the article info
 * @param int articleID, string info
 */
function getArticle_info ( $articleID = 0 , $info = '' ) {
	$sql = " select * from articles a ";
	$sql .= " where a.articleID = " . intval($articleID); 
	
	$db = new database;
	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	if ($article_version = $db->fetcharray());
	return $article_version->$info;
}

/** Return the article versions info
 * @param int articleID, string info
 */
function getArticle_version_info ( $articleID = 0 , $info = '' ) {
	$sql = " select * from article_versions av ";
	$sql .= " where av.articleID = " . intval($articleID); 
	
	$db = new database;

	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	if ($article_version = $db->fetcharray());
	return $article_version->$info;
}

/** Return the title of the article
 * @param int articleID
 */
function getArticleTitle(  $articleID = 0 ) {
	$sql = "select * from articles a ";
	$sql .= " where a.articleID = " . intval($articleID); 
	
	$db = new database;

	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	if ($article = $db->fetcharray());
	return $article->title;
}

/** 
 * Return the set of images of this article
 * return array()
 */
function getArticle_imageSets ( $articleID = 0 ) {
	$sql = " select * from article_imgs ai, ";
	$sql .= " stockphotos s ";
	$sql .= " where s.imageID = ai.imageID" ;
	$sql .= " and ai.articleID=" . intval( $articleID );
	$sql .= " and ai.show_image = '1'";
	
	$db = new database;
	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	$article_imgs = array();
	while ($article_imgs[] = $db->fetcharray());
	$db->freeresult();
	//echo 'hi ';
	//if ($article_imgs[] = $db->fetcharray());
	return $article_imgs;
}

/** Return the author/writer's fullname of the given article
 * @Deprecated..DO NOT USE! This function is f**ng useless..-{mh}
 */
function getArticle_authors ( $articleID = 0 ) {
	$sql = " select * from article_author aa ";
	$sql .= " , content_users cu ";
	$sql .= " where aa.articleID = " . intval( $articleID ) ;
	$sql .= " and aa.userID = cu.userID ";
	
	//print $sql ;
	$db = new database;



	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	if ($author = $db->fetcharray());
	return $author->fullname;
}

/** Return the author/writer's info of the article
 *	@param articleID, info
 */
function getArticle_authors_info ( $articleID = 0, $info = '' ) {
	$sql = " select * from article_author aa ";
	$sql .= " , content_users cu ";
	$sql .= " where aa.articleID = " . intval( $articleID ) ;
	$sql .= " and aa.userID = cu.userID ";
	
	//print $sql ;
	$db = new database;



	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	if ($author = $db->fetcharray());
	return $author->$info;
}
/** Return the keywords of the article
 *	@param articleID
 */
function getArticle_keywords( $articleID = 0 ){
	$sql = " select * from article_keywords ak ";
	$sql .= " where ak.articleID=" . intval( $articleID ) ;
	$db = new database;



	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	if ($keywords = $db->fetcharray());
	return $keywords->keywords;
}
/** Return the user's fullname
 * @param int userID
 * Deprecated.. DO NOT USE! use the getUser_info
 */
function getUser_fullname( $userID = 0 ) {
	$sql = "select * from content_users cu ";
	$sql .= " where cu.userID = " . intval( $userID );
	
	$db = new database;



	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	
	if ($author = $db->fetcharray());
	return $author->fullname;
}

/** Return the user info given the id ... 
 * @param int userID, string info
 */
function getUser_info( $userID = 0 , $info = '' ) {
	$sql .= " select * from content_users cu ";
	$sql .= " where cu.userID = " . intval( $userID );
	
	$db = new database;



	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	$user_info = $db->fetcharray();
	return $user_info->$info;
}

/** 
 * my friendly date :) - mh
 */
function friendlyDate ( $timestamp ) { // ex. Sun, February 12, 2006, 11:58:31 pm
	return	date( 'D, F j, Y, g:i:s a', $timestamp );
}
function friendlyDate2 ( $timestamp ) { // ex. Sun, 2/12/06 11:58:31 pm
	return	date( 'D, n/j/y g:i:s a', $timestamp );
}
function friendlyDate3 ( $timestamp ) { // ex. Sun, 2/12/06 11:58:31 pm
	return	date( 'D, n/j/y ', $timestamp );
}
function friendlyDate4 ( $timestamp ) { // ex. Sun, Feb 12, 2006, 11:58:31 pm
	return	date( 'D, M j, Y, g:i:s a', $timestamp );
}
function friendlyDate5 ( $timestamp ) { // ex. Sun, Feb 12, 2006, 11:58:31 pm
	return	date( 'D, F j, Y, g:i a', $timestamp );
}

function niceDate ( $timestamp ) { // e. Fri, February 24, 2006 
	return	date( 'D, F j, Y ', $timestamp );
}
function simpleDate( $unixtimestamp ){
	return date("M-d-Y",$unixtimestamp );
}
function niceTime ( $timestamp ) {
	return date( 'g:i:s a', $timestamp );
}

function convertdate($date) {
	list ( $month, $day, $year) = split ("-", $date);
	$date_valid = checkdate($month, $day, $year);
	if($date_valid==false) {
		echo "checkdate() returned false.";
	}
	if (($timestamp = strtotime("$month/$day/$year")) === -1) {
		echo "Invalid date format.";
	} else {
	   return $timestamp;
	}
}

// Convert the date to string
function strDate( $month="", $day="" ){
if ($day){
	switch($day){
		case 1: $date = "Monday"; break;
		case 2: $date = "Tuesday"; break;
		case 3: $date = "Wednesday"; break;
		case 4: $date = "Thursday"; break;
		case 5: $date = "Friday"; break;
		case 6: $date = "Saturday"; break;
		case 7: $date = "Sunday"; break;
	}
}
if ($month){
	switch($month){
		case 1: $date = "January"; break;
		case 2: $date = "February"; break;
		case 3: $date = "March"; break;
		case 4: $date = "April"; break;
		case 5: $date = "May"; break;
		case 6: $date = "June"; break;
		case 7: $date = "July"; break;
		case 8: $date = "August"; break;
		case 9: $date = "September"; break;
		case 10: $date = "October"; break;
		case 11: $date = "November"; break;
		case 12: $date = "December"; break;
		}
}
return $date;
}

/** Return the group name of this user
 * @param int userID
 */
function getGroup_name( $groupid = 0 ) {

	$sql .= " select * from content_usertypes cu ";
	$sql .= " where cu.usertypeID = " . intval( $groupid );
	
	//print 'g = '.$sql;
	$db = new database;



	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	$group_name = $db->fetcharray();
	return $group_name->usertype_name;
}

/** Log the user
 *
 */
function user_log ( $userID ) {
	$day = date( "d l" );
	$month = date( "F" );
	$year = date( "Y" );
	$hour = date( "h" );
	$minute = date( "i" );
	$second = date( "s" );
	$am_pm = date( "a" );
	
	$sql = " insert into user_log ( userID, log_day, log_month, log_year, log_hour, log_minute, log_second, log_am_pm ) ";
	$sql .= " values( '$userID' , '$day' , '$month' , '$year' , '$hour' , '$minute' , '$second' , '$am_pm' )";
	$db = new database;



	
	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	else{
		die('User log failed..');
	}
}

/** Return the frontpage type of the article
 * @param int articleID
 */
function getFrontpage_type( $articleID ){
	$sql = " select * from article_frontpage af , ";
	$sql .= " frontpage_sections fs ";
	$sql .= " where af.articleID =" . intval( $articleID );
	$sql .= " and af.frontpage_sectionID = fs.frontpage_sectionID";
	$db = new database;



	
	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	$frontpage = $db->fetcharray();
	return $frontpage->frontpage_section;
}

/** Return the stage name of this stageid
 * @param int stageID
 */
function getStage_name ( $stageID ) {
	$sql = " select * from stages s ";			
	$sql .= " where s.stageID=" . intval( $stageID );
	
	$db = new database;
	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	$stagename = $db->fetcharray();
	return $stagename->stage;
}
/**
 * check if "http://" strings was found..
 */ 
function checkhttptext( $url ){
	if (preg_match("/^http:\/\//", $url )) return true;
	else return false;
}
/**
 * remove "http://" strings
 */ 
function splithttptext( $url ){
	$url = preg_split( "/^http:\/\//", $url );
	return $url;
}
/**
 * Convert the path into a desired relative path
 */ 
function makeRelativePath( $path, $offset ) {
	if ( preg_match("[../]", $path ) ) {
		$newpath = split("[../]", $path, $offset );
		return $newpath[$offset-1];
	}
	else{
		return false;
	}
}
/** Create a short intro based from the article
* @access public
* @param string $body
*/
function makeAShortIntro( $body ){
	/*if ( strlen($body) > 200 ) {
		$body = substr( trim($body), 0, 200 );
	}
	return $body . '......';*/
	$sentences 	= preg_split("/[\.]/", $body); 
	$n			= count($sentences); // count no. of sentences..
	if ($n>2){ // if the articles contains more than 2 sentences
		$tmp = array();
		$tmp = $sentences[0]  ; // extract the 1st sentences only.
		$str = $tmp . '....';
		return $str;
	}
	else{
		return $body;
	}
}
/**
 * return the allowable stages that can be set by the content users..{mh}
 */
function allow_Stage_to_set ( $curstageID ) {
	switch ( $curstageID ) {
		// if the current stage of the article is drafting, 
		// then the article can be set only to writing stage , but not editing stage..
		// if done drafting, the writer can set the stage to writing stage (2), 
		// which means the article has done on the writing stage.
		case 1: // drafting
		case 2:
			$nextstageID = 2; // writing stage  
			break;
		case 3: 
		// the editors will see only the articles that was passed on the writing stage.
		// likewise, the editors can set only to editing stage( pass to newsdirector )
			$nextstageID = $curstageID - 1 ; // editing stage..  		
			break;
		case 4: 
		// the newsdirector will see only the articles that was passed on the editing stage..
		// if the article is on the editing stage, 
		// it can be set only to review stage..go! go! go!  	
			$nextstageID = $curstageID - 1 ;  		
			break;
		case 5: 
		// the publisher will see only the articles which already been reviewd by the newsdirector
		//and so the article is ready to publish on live site..oh yaahhh, uhmmm...hmm!!..
			$nextstageID = $curstageID - 1 ;
			break;
	}
	
	/*
	OBSELETE!!
	$sql = " select * from stages s ";
	$sql .= " where s.stageID <= " .intval ( $curstageID );
	$sql .= " and s.stageID >=" .intval ( $nextstageID ) ;
	
	print $sql;
	$db = new database;



	
	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	
	$allow_stages = array();
	while ( $allow_stages[] = $db->fetcharray() );
	
	print_r( 	$allow_stages );
	*/
	return $nextstageID;
}
/**
 * Get the basic info of the image
 */
function getImages_info( $filename = '', $info = '' ){
	$sql = " select * from stockphotos ";
	$sql .= " where image_filename='$filename'"  ;
	$db = new database;
	if (!($result = $db->query( $sql ))) {
		die('Error:'. $db->error());
	}
	$imageinfo = $db->fetcharray();
	return $imageinfo->$info;
}
/**
 * Get live articles on this category
 */
function getLiveArticleOnCategory( $categoryid = 0, $day, $month, $year,  $offset ){
	$sql = " select * from article_versions av, ";
	$sql .= " article_category ac ";
	$sql .= " , article_frontpage af ";
	$sql .= " where av.articleID = ac.articleID ";
	$sql .= " and af.frontpage_sectionID != 2 ";
	$sql .= " and af.frontpage_sectionID != 1 ";
	$sql .= " and af.articleID = av.articleID ";
	$sql .= " and ac.categoryID = " . intval($categoryid);
	$sql .= " and av.stageID = '6' ";
	$sql .= " and av.isarchive = 0 ";
	$sql .= " and ac.articleID = av.articleID";
	$sql .= " and av.published_day = '$day' ";
	$sql .= " and av.published_month = '$month' ";
	$sql .= " and av.published_year = '$year' ";
	//$sql .= " and av.dateline = '$dateline' ";
	$sql .= ( $offset )? "order by av.dateline desc limit $offset" : "order by av.dateline desc";	
	//echo $sql;
	$db = new database;



	if (!($result = $db->query($sql))){
			die('Error:'. $db->error());
	}
	$article_category = array();
	while($article_category[] = $db->fetcharray());
	return $article_category;
} 

function countArticle_versions_stage( $stageid ){
	// Get and count the articles on diff stage
	$sql = " select * from article_versions ";
	$sql .= " where stageID = $stageid ";
	//$sql .= " and status = '--' ";
	$sql .= " or status = 'revise' ";
	$db = new database;



	if (!( $result = $db->query($sql))) {
		die('Error:' . $db->error());
	}
	$article = array();
	while( $row  = $db->fetcharray() ) { $article[] = $row; }
	$nitems = count( $article );
	return $nitems;
}
/**
 * Check the user access rights
 */
function checkUserAccessRights( $userID , $stage ) {
	$sql = "select * from user_stage ";
	$sql .= " where userID=" . intval( $userID );
	$sql .= " and stageID=" . intval( $stage );
	$db = new database;
	// echo $sql;
	if (!( $result = $db->query($sql))) {
		die('Error:' . $db->error());
	}
	$rights = array();
	while( $row  = $db->fetcharray() ) { $rights[] = $row; }	
	if ( $db->getnumrows() > 0 ) return true;
	else return false;
}
/**
 * Check the revision lists of the article on this stage
 */
function checkRevisionLists( $articleID, $stage ){
	$sql = "select * from articles av ";
	$sql .= "where av.articleID=" . intval( $articleID );
	$sql .= " and av.status='revise' ";
	$sql .= " and av.stageID=" . intval( $stage );
	//$sql .= " and av.stageID= -1" ;
	
	$db = new database;



	if (!( $result = $db->query($sql))) {
		die('Error:' . $db->error());
	}
	$revlist = array();
	while( $row  = $db->fetcharray() ) { $revlist[] = $row; }	
	if ( $db->getnumrows() > 0 ) return true;
	else return false;
}
/**
 * Get the client active banners
 */
function getClientActiveBanners( $clientID = 0 ){
	$sql = "select * from corporate_partners_imgs cpimgs ";
	$sql .= "where cpimgs.banner_clientID = " . intval( $clientID );
	$sql .= " and cpimgs.banner_show = '1' ";
	$db = new database;



	if (!( $result = $db->query($sql))) {
		die('Error:' . $db->error());
	}
	$active_banners = array();
	while( $active_banners[] = $db->fetcharray());
	$db->freeresult();
	return $active_banners;
}
/**
 * Get the client active banners info
 */
function getBannerclient_info( $clientID = 0, $info = "" ){
	$sql = " select * from corporate_partners_imgs cpimgs, corporate_partners cp ";
	$sql .= "where cp.clientID = " . intval( $clientID );
	$sql .= " and cpimgs.banner_clientID = cp.clientID ";
	//echo $sql;
	$db = new database;



	if (!( $result = $db->query($sql))) {
		die('Error:' . $db->error());
	}
	$bannerinfo = array();
	if ($bannerinfo = $db->fetcharray());
	$db->freeresult();
	return $bannerinfo->$info;
}
/**
 * Send email
 */
function sendmail( $to, $subject, $msg ) {
	mail( $to, $subject, $msg );
}
/**
 * Get the current workload of the user
 */
function getUserWorkload( $userID, $currenttime ) {
	$currenttime = simpleDate($currenttime);
	$sql = " select * from tasks ";
	$sql .= " where assignedto = '$userID' ";
	$sql .= " and created = '$currenttime' ";
	$db = new database;
	if (!( $result = $db->query($sql))) {
		die('Error:' . $db->error());
	}
	$workloads = array();
	while( $row = $db->fetcharray() )$workloads[] = $row; 
	return $workloads;
}

/**
 * Return the status of the writer task.
 */
function getWriterTaskStatus( $userID, $status, $currenttime ) {
	$currenttime = simpleDate($currenttime);
	$sql = "select * from tasks where assignedto = '$userID' ";
	$sql .= " and status = '$status' ";
	$sql .= " and created = '$currenttime' ";
	$db = new database;



	if (!( $result = $db->query($sql))) {
		die('Error:' . $db->error());
	}
	$workloads = array();
	while( $row = $db->fetcharray() )$workloads[] = $row; 
	return $workloads;  
}
/**
 * Check if the writer is available to give a task.
 */
function checkIfWriterIsAvailableToAssignedTheTask( $userID, $currenttime, $numtaskrequired ) {
	$currenttime = simpleDate($currenttime);
	$sql = " select * from tasks ";
	$sql .= " where assignedto = '$userID' ";
	$sql .= " and created = '$currenttime' ";
	//echo $sql;
	$db = new database;
	if (!( $result = $db->query($sql))) {
		die('Error:' . $db->error());
	}
	if ( $db->getnumrows() < $numtaskrequired) {
		return true;// this writer is available to assign the task
	}
	else{
		return false;// this writer is not available to give a task
	}
}
/**
 * Get current active quota
 */
function getActiveQuota( ) {
	$sql = "select * from quota where isdefault=1 ";
	$db = new database;
	if (!( $result = $db->query($sql))) {
		die('Error:' . $db->error());
	}
	$quota = array();
	if ( $quota[] = $db->fetcharray() );	
	return $quota[0]->quota;
}
?>
