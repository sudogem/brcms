<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
session_start();
// Log the activity
$action = new activity;
$action->track_activity( $_SESSION['userID'], $action->logout, '--' );
// log-out the user
$auth = new user_authentication();
$auth->set_User_logout($_SESSION['userID']);
$auth->logout();
header( 'Location: index.php' ); // back to main page
?>