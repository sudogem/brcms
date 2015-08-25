<?php
require ( '../admin/coreclass.php' );
session_start();

// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: login.php');
}

if (isset($_SESSION['login'])) {
	$userID = $_SESSION['clientID'];
}
$msgID = $_GET['messageID'];
// saved the messageID
$_SESSION['msgID'] = $msgID;
$msg = new messages();
// read his message
$resultdata = $msg->read_message( $userID , $msgID );
// saved the msg subject
$_SESSION['title'] = $resultdata[0]->subject;
// set the message as read
$msg->set_readmessage( $userID , $msgID );

$from = getUser_info ( $resultdata[0]->userID_from , 'fullname' );
$from_userID = getUser_info ( $resultdata[0]->userID_from , 'userID' );
$_SESSION['$from_userID'] = $from_userID;
$author = getUser_info ( $resultdata[0]->receiverID , 'fullname' );

// compile the page now! go! go! go!
$tpl = new template_parser( '../templates/view_private_message_detail.tpl.php' );
$tags = array(
		'{FROM}'		=> $from,
		'{POSTED}' 		=> friendlyDate($resultdata[0]->date_time),
		'{SUBJECT}' 	=> $resultdata[0]->subject,
		'{AUTHOR}' 		=> $author,
		'{MESSAGE}' 	=> $resultdata[0]->message,
		'{SITENAME}' 	=> 'CMS Adminss',
		'{HEADER}' 		=> ' ',
		'{TOPNAV}' 		=> '../templates/client_top_menu.tpl.php',
		'{FOOTER}' 		=>  'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>