<?php 
	include_once ('../../classes/class_dbsettings.php');
	function get_email($clientID) {
		$query = "SELECT * FROM corporate_partners where clientID = '$clientID'";
		
		$con = mysql_connect('localhost', 'root', '') or die("Error! Could not connect to database server. ".mysql_error());
		mysql_select_db('brcms', $con) or die("Error! Could not connect to database. ".mysql_error());
		$rs = mysql_query($query) or die("Error on query. ".mysql_error());
		$data = mysql_fetch_assoc($rs);
		
		return $data;
	}
	
	#save messages to the message table.
	function save_message( $userID_from, $recieverID, $date_time, $state, $subject, $message ) {
		
		$query = "INSERT INTO messages VALUES('', '$userID_from', '$recieverID', '', '$date_time', '$state', '$subject', '$message')";
		$db = new database;

		
		if(!$db->query($query)) {
			echo $db->error();
			exit();
		}
		#where: 
		#	$userID_from = the source of the message 
		#	$recieverID  = the reciepient of the message 
		#	$date_time   = the date and the time the message was sent 
		#   $state		 = the state of the message(read or unread)
		#   $subject	 = what the message is all about 
		#	$message	 = the content of the message
	}
	
	function save_segment( $segmentTitle, $segmentTopic, $segmentAnchor, $segmentSchedule, $segmentContent, $segmentDate ) {
	
	#$segmentTitle		the title of the segment
	#$segmentTopic		the topic being tockled on the segment
	#$segmentAnchor 		the anchorman of the segment
	#$segmentSchedule 	the schedule of the segment on air
	#$segmentContent 	the content of the segment	
	#$segmentDate 		the date when the segment was written
	
		$query = "INSERT INTO news_segments VALUES('', '$segmentTitle', '$segmentTopic', '$segmentContent', '$segmentAnchor', '$segmentSchedule', '$segmentDate')";
		$db = new database;

		
		if(!$db->query($query)) {
			echo $db->error();
			exit();
		}
	}
	
	function get_table_data($table, $where='') {
		$query = "SELECT * FROM ".$table;
		
			if($where != '') {
				$query .= $where;
			}		

// var $dbservername = 'localhost'; 
// var $dbusername = 'root'; 
// var $dbpassword = 'webdevel'; 
// var $databasename = 'brcms'; 
// var $persistency = false;

		$settings = new dbsettings();
		$dbservername = $settings->dbservername;
		$dbusername = $settings->dbusername;
		$dbpassword = $settings->dbpassword;
		$databasename = $settings->databasename;

		$con = mysql_connect($dbservername, $dbusername, $dbpassword) or die("Error! Could not connect to database server. ".mysql_error());
		mysql_select_db($databasename, $con) or die("Error! Could not connect to database. ".mysql_error());
		$rs = mysql_query($query) or die("Error on query. ".mysql_error());
		#$data = mysql_fetch_assoc($rs);
		
		return $rs;
	}
?>