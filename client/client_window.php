<?php
// current activity: Reading the short story
require ( '../admin/coreclass.php' );
session_start();

/**
 * Get the default stylesheets
 */
$stylesheet = " ../templates/admin2.css";
$clientname = $_SESSION['username'];
$message = ' Welcome ' . $clientname . '!, you logged in as a Client. ';
/**
 * Start compiling the page
 */
$tpl = new template_parser( '../templates/client_window.tpl.php' );
$tags = array(
		'{SITENAME}'		=> 'CMS Adminss',
		'{HEADER}'			=> '&nbsp;',
		'{CLIENTNAME}'		=> $clientname , 
		'{WELCOME_MESSAGE}'	=> $message,
		'{TOPNAV}' 			=> '',
		'{STYLESHEET}'		=> $stylesheet,
		'{FOOTER}' 			=> '../admin/footer.php' 
);

$tpl->parse_template( $tags );
print $tpl->display();
?>