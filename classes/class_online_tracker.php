<?php 
class online_tracker extends database {
	
	//define class variables
	var $limit_time;
	var $visits;
	var $userID;
	var $members;
	var $session_id;
	var $total_online;
	var $date;

	function online_tracker() {
		$this->database();
		session_start();
	}
	
	function tracker() {
			$session_id = session_id();
			$ip = $_SERVER['REMOTE_ADDR'];
			$referrer = (isset($_SERVER['HTTP_REFERRER'])) ? $_SERVER['HTTP_REFERRER'] : '';
			$user_agent = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '';
			$created = time();// ERROR HERE..
			
			$date = date("Y-m-d");
		
		if ( !$_SESSION['online']) { 
			
			$query = "INSERT INTO people_online	VALUES('".session_id()."', '$date', 'n', '$ip', '$referrer', '$user_agent')";
		
			if(!$this->query($query)) {
			$this->error();
			}
		
			// session_register('online');
			$_SESSION['online'] = true;
			//echo "Session ID (online 1): ".session_id();
		}
		#} else {
		if(isset($_SESSION['userID'])) {
			//echo "<br>Session ID (userID) for users: ".session_id();
			$query = "INSERT INTO people_online	VALUES('".session_id()."', '$date', 'y', '$ip', '$referrer', '$user_agent')";
						
			if(!$this->query($query)) {
				$this->error();
			}
		}		
		#} 	
	}
	
	function get_db_data() {
		$this->limit_time = time() - 300;		//5 minute time out.
		$sql="SELECT * FROM people_online WHERE UNIX_TIMESTAMP(log_date) >= '$limit_time' AND member = 'n' GROUP BY ip_address";
		$sql_n = $this->query($sql);
			if(!$sql_n) {
				echo "Error on First Query:".mysql_error();
			}
		$sql ="SELECT * FROM people_online WHERE UNIX_TIMESTAMP(log_date) >= '$limit_time' AND member = 'y' GROUP BY ip_address";	
		$sql_members = $this->query($sql);
			if(!$sql_members) {
				echo "Error on Second Query:".mysql_error();
			}
			
		$this->visits = $this->getnumrows($sql_n);
		$this->members = $this->getnumrows($sql_members);
		$this->total_online = $visitors + $members;
		$this->date = date("Y-m-d");
	}
	
	//functions that returns the values of each variables
	function get_date() { 
		return $this->date; 
	}
	function get_visits() { 
		return $this->visits; 
	}
	function get_members() { 
		return $this->members; 
	}
	function get_total_online() { 
		return $this->total_online; 
	}
	function get_session_id() {
		return $this->session_id;
	}
	function set_userID($userID){
		$this->userID = $userID;
	}
	
	
}
?>