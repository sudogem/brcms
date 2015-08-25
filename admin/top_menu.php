<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
session_start();
if ( !isset($_SESSION['login'])) {
	header('Location: login.php');
}
if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$username = $_SESSION['username'];
	$usertype = $_SESSION['usertype'];
}
switch( $usertype ){
	case 'News Editor':
		$assigned_category = getCategory_info( getUser_assigned_category( $userID ), 'categoryID' );
		$editor_on_category = true; // this user is an editor
		break;
}

//retrieve the users workflow he had been assign ...
$db = new database;



$sql = " select * from ";
$sql .= " user_stage us, ";
$sql .= " stages s ";
$sql .=	" where us.userID = " . intval( $userID );
$sql .=	" and s.stageID = us.stageID ";
if (!($result = $db->query($sql))){
	die('Error:'. $db->error());
}
$user_stage = array();
while ( $row = $db->fetcharray() ) {
	$user_stage[] = $row;
}
$db->freeresult();

$msg = new messages();
$messages = $msg->view_unread_messages ( $userID );
$total_unread_messages = count( $messages )-1;

$fb = new feedbacks();
$feedbacks = $fb->view_unread_feedbacks( 1 );
$total_unread_feedbacks = count( $feedbacks )-1;

$feedbacks = $fb->view_unread_feedbacks( 2 );
$total_unread_sources = count( $feedbacks )-1;

// get all articles belong in da category and edit by this editor assigned on dat category
if ( $assigned_category ) { 
	$sql = "select * from article_versions av, article_category ac where 
			((av.stageID = 2 and av.status != 'revise') or (av.stageID = 3 and av.status = 'revise' )) 
			and (( av.isarchive = '0' and ( ac.articleID = av.articleID ) and ( ac.categoryID = '$assigned_category' ))) order by av.created DESC 
	";
}
else{
	$sql = "select * from article_versions av where 
			(av.stageID = 2 and av.status != 'revise') or (av.stageID = 3 and av.status = 'revise' ) 
			and av.isarchive = '0' order by av.created DESC 
	";
}
if (!($result = $db->query($sql))){
	die('Error:'. $db->error());
}
$writing = array();
while ( $row = $db->fetcharray() ) {
	$writing[] = $row;
}
$db->freeresult();
$total_writings = count( $writing );

$sql = " select * from article_versions av ";
$sql .= " where av.stageID=3";
//$sql .= " and av.status != 'revise' ";
if (!($result = $db->query($sql))){
	die('Error:'. $db->error());
}
$editing = array();
while ( $row = $db->fetcharray() ) {
	$editing[] = $row;
}
$db->freeresult();
$total_editings = count( $editing );

$sql = "select * from article_versions av where 
		(av.stageID=3 and av.status != 'revise') or ( av.stageID=3 and av.status = 'edited' ) 
		and av.isarchive = '0' order by av.created DESC ";
if (!($result = $db->query($sql))){
	die('Error:'. $db->error());
}
$evaluating = array();
while ( $row = $db->fetcharray() ) {
	$evaluating[] = $row;
}
$db->freeresult();
$total_evaluating = count( $evaluating );


$sql = "select * from article_versions av where av.stageID=4";
if (!($result = $db->query($sql))){
	die('Error:'. $db->error());
}
$publishing = array();
while ( $row = $db->fetcharray() ) {
	$publishing[] = $row;
}
$db->freeresult();
$total_publishing = count( $publishing );

$currentdate = simpledate(time());
$sql = "select * from tasks where assignedto = '$userID' ";
$sql .= " and status != 'completed' ";
$sql .= " and created = '$currentdate'" ;
$sql .= " order by created desc ";
if (!($result = $db->query($sql))){
	die('Error:'. $db->error());
}
$mytasks = array();
while ( $row = $db->fetcharray() ) {
	$mytasks[] = $row;
}
$db->freeresult();
$total_tasks = count( $mytasks );

$menu = '';
if ( $usertype == 'Administrator') {
	//$menu .= '<p>';
	// $menu .= 'Admin menu';
	//$menu .= '</p>';

	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/view_article_versions.php?stageID=6" ><img src="../admin/images/addedit.png" alt="" border="0"><p>All News Content </p></a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
	$menu .= 	'<a href="../admin/archive_manager.php" ><img src="../admin/images/searchtext.png" alt="" border="0"><p>News Content Archive Manager</p></a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/category_manager.php" ><img src="../admin/images/categories.png" alt="" border="0"><p>Category Manager </p></a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/quote_manager.php" ><img src="../admin/images/module.png" alt="" border="0"><p>Quote Manager</p></a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/other_site_content.php" ><img src="../admin/images/sections.png" alt="" border="0"><p>Other Site Content</p></a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/feedback_manager.php" ><img src="../admin/images/addedit.png" alt="" border="0"><p><p>Feedback/<br>Comments</p>-'. $total_unread_feedbacks. ' item(s)-</a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/other_sources.php" ><img src="../admin/images/addedit.png" alt="" border="0"><p><p>External Sources</p>-'. $total_unread_sources. ' item(s)-</a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/user_manager2.php" ><img src="../admin/images/user.png" alt="" border="0"><p>User Manager </p></a>';
	$menu .= '</div>';
	
	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/user_access_permissions.php" ><img src="../admin/images/191.gif" alt="" border="0"><p>User Access Permissions</p></a>';
	$menu .= '</div>';
	
	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/audit_trail.php" ><img src="../admin/images/query.png" alt="" border="0"><p>Audit trail </p></a>';
	$menu .= '</div>';


	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/report_admin.php" ><img src="../admin/images/addedit.png" alt="" border="0"><p>Admin Reports</p></a>';
	$menu .= '</div>';
	
	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/report_usage.php" ><img src="../admin/images/278.gif" alt="" border="0"><p>Usage Report</p></a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/clients_manager.php" ><img src="../admin/images/user.png" alt="" width="48" height="48" border="0"><p>Client Manager</p></a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/banner_ads_manager.php" ><img src="../admin/images/templatemanager.png" alt="" border="0"><p>Banner Client Manager</p></a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/image_manager.php" ><img src="../admin/images/mediamanager.png" alt="" width="48" height="48" border="0"><p>Image Manager </p></a>';
	$menu .= '</div>';



	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/backup_restore_database.php" ><img src="../admin/images/backup.png" alt="" border="0"><p>Backup/Restore Database</p></a>';
	$menu .= '</div>';
	//$menu .= '<div id="submenu">';
	//$menu .=	'<a href="../admin/global_configurations.php" ><img src="../admin/images/config.png" alt="" border="0"><p>Global Configurations </p></a>';
	//$menu .= '</div>';
	#############################################################
	#for poll_survey
	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/list_poll_survey.php" ><img src="../admin/images/278.gif" alt="" border="0"><p>Poll Survey Manager</p></a>';
	$menu .= '</div>';
	#############################################################
	
	$use_common_menu = 1;	
	$admin_menu = 1; // admin menu
}

// ok pepol,,let us know what are his workflow he/she had been ASSIGN by the admin..
for( $i = 0; $i < count($user_stage); $i++ ){
	switch ($user_stage[$i]->stageID) { // ok lets check his workflow
		case 1:// writing
		case 2:
			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/my_tasks.php" ><img src="../admin/images/module.png" alt="" border="0"><p>My Tasks<br></p>- '.$total_tasks.' item(s)-</a>';
			$menu .= '</div>';
			
			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/add_article.php" ><img src="../admin/images/addedit.png" alt="" border="0"><p>Add Article</p></a>';
			$menu .= '</div>';

			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/add_segments.php" ><img src="../admin/images/addedit.png" alt="" border="0"><p>Add Segment</p></a>';
			$menu .= '</div>';
			
			$menu .= '<div id="submenu">';
			$menu .= 	'<a href="../admin/my_articles2.php" ><img src="../admin/images/addedit.png" alt="" border="0"><p>My Articles</p></a>';
			$menu .= '</div>';
			
			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/report_writer_articles.php" ><img src="../admin/images/addedit.png" alt="" border="0"><p>Writer Report</p></a>';
			$menu .= '</div>';
			
			$menu .= '<div id="submenu">';
			$menu .= 	'<a href="../admin/archive_manager.php" ><img src="../admin/images/searchtext.png" alt="" border="0"><p>Article Archive Manager</p></a>';
			$menu .= '</div>';
			//$menu .= '</div>';
			$use_common_menu = 1;
			break;
		case 3:// editing
			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/view_article_versions.php?stageID=3" ><img src="../admin/images/addedit.png" alt="" border="0"><p>Edit Article<br> </p>- '. $total_writings . ' item(s)-</a>';
			$menu .= '</div>';
			
			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/task_manager.php" ><img src="../admin/images/module.png" alt="" border="0"><p>Task Manager</p></a>';
			$menu .= '</div>';
			
			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/report_editor_articles.php" ><img src="../admin/images/addedit.png" alt="" border="0"><p>Editor Report</p></a>';
			$menu .= '</div>';
			//$menu .= '</div>';
			$use_common_menu = 1;
			break;
		case 4:// proofreading
			//$menu .= '<div class="clear" >&nbsp;</div>';		
			//$menu .= 'News Director menu';
			
			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/view_article_versions.php?stageID=4"><img src="../admin/images/addedit.png" alt="" border="0"><p>Evaluate Article<br></p>- '.$total_evaluating.' item(s)-</a>';
			$menu .= '</div>';

			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/feedback_manager.php" ><img src="../admin/images/addedit.png" alt="" border="0"><p><p>Feedback/<br>Comments </p>-'. $total_unread_feedbacks. ' item(s)-</a>';
			$menu .= '</div>';

			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/other_sources.php" ><img src="../admin/images/addedit.png" alt="" border="0"><p><p>External Sources</p>-'. $total_unread_sources. ' item(s)-</a>';
			$menu .= '</div>';

			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/quota.php" ><img src="../admin/images/sections.png" alt="" border="0"><p>Quota Manager</p></a>';
			$menu .= '</div>';

			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/category_manager.php" ><img src="../admin/images/categories.png" alt="" border="0"><p>Category Manager</p></a>';
			$menu .= '</div>';

			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/article_reports.php" ><img src="../admin/images/addedit.png" alt="" border="0"><p>News Director Report</p></a>';
			$menu .= '</div>';
			
			$use_common_menu = 1;	
			break;
		case 5:// live => publihser	
			//$menu .= '<div class="clear" >&nbsp;</div>';		
			//$menu .= 'Publisher menu';
			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/view_article_versions.php?stageID=5" ><img src="../admin/images/impressions.png" alt="" border="0"><p>Publish Article<br></p>- '.$total_publishing. ' item(s)-</a>';
			$menu .= '</div>';

			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/banner_ads_manager.php" ><img src="../admin/images/templatemanager.png" alt="" width="48" height="48" border="0"><p>Banner Client Manager</p></a>';
			$menu .= '</div>';

			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/template_manager2.php" ><img src="../admin/images/menu.png" alt="" border="0"><p>Template Manager</p></a>';
			$menu .= '</div>';

			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/image_manager.php" ><img src="../admin/images/mediamanager.png" alt="" width="48" height="48" border="0"><p>Image Manager </p></a>';
			$menu .= '</div>';

			$menu .= '<div id="submenu">';
			$menu .=	'<a href="../admin/report_publisher_articles.php" ><img src="../admin/images/addedit.png" alt="" border="0"><p>Publisher Report</p></a>';
			$menu .= '</div>';

			$use_common_menu = 1;
			break;
	}
}

if ( $use_common_menu ) {
			//$menu .= '<div class="clear" >&nbsp;</div>';		
	
	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/user_profile.php" ><img src="../admin/images/uploadslangmanager.png" alt="" width="48" height="48" border="0"><p>My Personal Profile </p></a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
    ($total_unread_messages > 0) ? 	$menu .= '<a href="../admin/view_messages.php" ><img src="../admin/images/messaging.png" alt="" width="48" height="48" border="0"><p>Messaging<br> </p>- ' . $total_unread_messages . ' unread message(s) - </a>'
	: $menu .=	'<a href="../admin/view_messages.php" ><img src="../admin/images/messaging.png" alt="" width="48" height="48" border="0"><p>Messaging </p></a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/message_archive_manager.php" ><img src="../admin/images/addedit.png" alt="" width="48" height="48" border="0"><p>Messaging Archive Manager</p></a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../manual/index.php" ><img src="../admin/images/support.png" alt="" width="48" height="48" border="0"><p>Help </p></a>';
	$menu .= '</div>';
	
	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/credits.php" ><img src="../admin/images/credits.png" alt="" width="48" height="48" border="0"><p>Credits </p></a>';
	$menu .= '</div>';

	$menu .= '<div id="submenu">';
	$menu .=	'<a href="../admin/logout2.php" ><img src="../admin/images/frontpage.png" alt=""  border="0"><p>Logout ('. $username . ') </p></a>';
	$menu .= '</div>';
}

// now start compiling the page..
$tpl = new template_parser( '../templates/main_menu_top_nav.tpl.php' );
$tags = array(
		'{MENU}' => $menu
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>