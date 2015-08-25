<?php
require ( '../admin/coreclass.php' );
session_start();
$userID = $_SESSION['clientID'];
session_unset();
session_destroy();
$lastvisitDate = time();	
$db = new database;



$sql = " update corporate_partners ";
$sql .= " set lastvisitDate=" . $lastvisitDate;		
$sql .= " where clientID=" . intval($userID);
if (!($result = $db->query( $sql ))) {
	die('Error:'. $db->error());
}
header( 'location: ../index.php' );
?>