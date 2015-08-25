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

if($_POST['submit'] != "") {
	$_SESSION['from_date'] = $_POST['from_year']."-".$_POST['from_month']."-".$_POST['from_date'];
	$_SESSION['end_date2'] =   $_POST['end_year'] . "-" . $_POST['end_month']."-".$_POST['end_date']; 
	echo "<script>
	winl = (screen.width - 440) / 2;
	wint = (screen.height - 350) / 2;
	props = 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=650,height=350,top='+wint+',left='+winl+'';
	window.open( 'display_report.php', 'win1', props );
	</script>";
}
/*
 * Get the default stylesheets
 */
$stylesheet = " ../templates/admin2.css ";
// Generate the page now
$tpl = new template_parser( '../templates/reports/report_usage_tpl.php' );
$tags = array(
		'{DATE_PEAKER}'			=>  'create_reports.php',
		'{DATA}'				=> $code,
		'{MESSAGE}'				=> $message,		
		'{LISTOFYEAR}'			=> $optyear,
		'{STYLESHEET}'			=> $stylesheet ,
		'{SITENAME}' 			=> 'CMS Adminss',
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=> 'footer.php' 
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>