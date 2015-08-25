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
if ( isset($_SESSION['message']) ){
	$message = $_SESSION['message'];
	unset($_SESSION['message']);
}
$topic_id = $_SESSION['topic_id'];
$topic = $_SESSION['topic'];
$respond_labels = $_SESSION['response_labels'];
$topic_date = $_SESSION['topic_date'];
$expiry_date = $_SESSION['expiry_date'];
for($i=1; $i<=12 ; $i++) {
	$optmonth .= '<option value ="'.$i.'" selected >'.date("M", mktime(0, 0, 0, $i, 1,0)).'</option>';	
}
for($i=1; $i <= 31; $i++) {
	$optday .= '<option value ="'.$i.'">'.date("d", mktime(0, 0, 0, 0, $i, 0)).'</option>';
}
// TODO: Change the year must be DYNAMIC.  
$optyear .= '<option value ="2006">'.date('Y').'</option>';

if ( isset( $_POST['cancel'] ) ) {
	header('Location: list_poll_survey.php');
}
// print_r($_SESSION);
// Log the activity
$action = new activity;
$action->track_activity( $userID, $action->creating_category, '-' );

// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/edit_poll.tpl.php' );
$tags = array(
		'{CATEGORY_NAME}' 	=> $category_name ,
		'{CATEGORY_DESC}'	=> $category_desc ,
		'{SITENAME}' 		=> 'CMS Adminss',
		'{MESSAGE}'			=> $message,
		'{TOPIC}'			=> $topic,	
		'{RESPOND_LABELS}' 	=> $respond_labels,
		'{FROM_MONTH}'		=> $optmonth,
		'{FROM_DAY}'		=> $optday,
		'{FROM_YEAR}'		=> $optyear,
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 

	);
$tpl->parse_template( $tags );
print $tpl->display();
?>