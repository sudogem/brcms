<?php
require ( '../admin/coreclass.php' );
session_start();
/**
 * Get the default stylesheets
 */
$stylesheet = " ../templates/admin2.css";
$clientname = $_SESSION['username'];

// Generate the page now
$tpl = new template_parser( '../templates/client_top_menu.tpl.php' );
$tags = array(
		'{SITENAME}'	=> 'CMS Adminss',
		'{CLIENTNAME}'	=> $clientname
);

$tpl->parse_template( $tags );
print $tpl->display();
?>