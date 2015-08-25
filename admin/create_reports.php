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
for($i=1; $i<=12 ; $i++) {
	$optmonth .= '<option value ="'.$i.'">'.date("M", mktime(0, 0, 0, $i, 1,0)).'</option>';
}
for($i=1; $i <= 31; $i++) {
	$optday .= '<option value ="'.$i.'">'.date("d", mktime(0, 0, 0, 0, $i, 0)).'</option>';
}
// TODO: kindly change the year must be DYNAMIC!!
$optyear .= '<option value ="2006">'.date('Y').'</option>';
//print_r($_POST);
/*
 * Get the default stylesheets
 */
$stylesheet = " ../templates/admin2.css ";
// Generate the page now
$tpl = new template_parser( '../templates/reports/create_reports_html.tpl.php' );
$tags = array(
		'{FROM_MONTH}'		=> $optmonth,
		'{FROM_DAY}'		=> $optday,
		'{FROM_YEAR}'		=> $optyear,
		'{STYLESHEET}'			=> $stylesheet ,
		'{SITENAME}' 			=> 'CMS Adminss',
		'{TOPNAV}' 				=> 'top_menu.php',
		'{FOOTER}' 				=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();

?>