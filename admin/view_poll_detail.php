<?php
include( 'configuration.php' );
require( 'coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login']) ) { 
	header('Location: login.php');
}
if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}
$db = new database;



$topic_id = $_GET['topic_id'];
$sql = "SELECT poll_topic.* FROM poll_topic WHERE poll_topic.topic_id = '$topic_id'";
//echo $sql;
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$view_poll_detail = array();
while( $row = $db->fetcharray() ) {
	$view_poll_detail[] = $row; 
}
// print_r($view_poll_detail);
$db->freeresult();
// saved session vars for later use okay ?!
$_SESSION['topic_id'] = $view_poll_detail[0]->topic_id;
$_SESSION['topic'] = $view_poll_detail[0]->topic;
$_SESSION['response_labels'] = $view_poll_detail[0]->response_label;
$_SESSION['topic_date'] = $view_poll_detail[0]->topic_date;
$_SESSION['expiry_date'] = $view_poll_detail[0]->expiry_date;
// ok baby, let start compiling the page now..go! go! go! {mh}
$tpl = new template_parser( '../templates/view_poll_detail.tpl.php' );
$tags = array(
		'{MESSAGE}'				=> $message,
		'{LINK}' 				=> $link,
		'{SITENAME}' 			=> 'CMS Adminss',
		'{POLL_TOPIC}'			=> $view_poll_detail[0]->topic,
		'{RESPOND_LABELS}'		=> $view_poll_detail[0]->response_label,
		'{TOPIC_DATE}'			=> $view_poll_detail[0]->topic_date,
		'{EXPIRY_DATE}'			=> $view_poll_detail[0]->expiry_date,
		'{HEADER}' 				=> ' ',
		'{TOPNAV}' 				=> '../admin/top_menu.php',
		'{FOOTER}' 				=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>