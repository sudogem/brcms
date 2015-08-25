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
}

// TODO: put validation here...
$default_template_name = $_POST['template_name'];
$default_template_stylesheet = $_POST['template_stylesheet'];
$default_template_author = $_POST['template_author'];
$default_template_thumbnail = $_POST['template_thumbnail'];
$default_template_large_preview = $_POST['template_large_preview'];
$default_template_configuration = "template.configuration.php";

// load the default template configuration for writing..chmod must be 2
$fp = fopen($default_template_configuration, w );
if (!$fp) {
	echo "Cannot open file : $template_configuration";
	exit;
}
$out = sprintf("<?php\r\n");
fwrite($fp,$out,strlen($out));
$out = sprintf("\$default_template_name =\"%s\";\r\n",$default_template_name);
fwrite($fp,$out,strlen($out));
$out = sprintf("\$default_template_stylesheet =\"%s\";\r\n",$default_template_stylesheet);
fwrite($fp,$out,strlen($out));
$out = sprintf("\$default_template_author =\"%s\";\r\n", $default_template_author);
fwrite($fp,$out,strlen($out));
$out = sprintf("\$default_template_large_preview =\"%s\";\r\n", $default_template_large_preview);
fwrite($fp,$out,strlen($out));
$out = sprintf("\$default_template_thumbnail =\"%s\";\r\n", $default_template_thumbnail);
fwrite($fp,$out,strlen($out));
$out = sprintf("?>");
fwrite($fp,$out,strlen($out));
if ( $result ) {
}

if (fclose($fp)) {
		// Log the activity
		$action = new activity;
		$action->track_activity( $userID, $action->changing_template, 'Selected: '.$default_template_name  );

        header("Location: ".$_SERVER['HTTP_REFERER']);
        return;
}
?>