<?php
/*
 * @className   : user-authentication
 * @purpose     : Handles user authentication..
 * @version 	: 3.2 19-dec-2005 11:19 pm..theres a party downside..
 * @author 	    : mh ...
 * @currenttracks: my favorite Classic-Pachelbel Canon in D..inspired from the movie My Sassy Girl
 */

class user_authentication extends database {
	var $login = false; // default to false
	var $userdata; // holds session user data
	function user_authentication() {
		session_start();
		$this->Database();
	}
	
	// check the username and password
	function checkUserLogin( $username = '', $password = '', $goodRedirect = '', $badRedirect = '' ) {
			$password = md5( $password );
			$sql = " SELECT * from ";
			$sql .= " content_users cu, ";
			$sql .= " content_usertypes ctype ";
			$sql .= " where cu.username = '$username' AND ";
			$sql .= " cu.password = '$password' ";
			$sql .= " AND cu.usertypeID = ctype.usertypeID ";
			
			$this->query( $sql );
			$this->fetcharray();
			if ( $this->getNumRows() > 0 ) { // the userlogin is found..saved his userdata.
				if ( $this->row->is_enabled > 0 ) {
					$this->userdata['username'] = $this->row->username;
					$this->userdata['userID'] = $this->row->userID;
					$this->userdata['usertypeID'] = $this->row->usertypeID;
					$this->userdata['usertype'] = $this->row->usertype_name;
					$this->userdata['login'] = true;
					
					$_SESSION['username'] = $this->userdata['username'];
					$_SESSION['userID'] = $this->userdata['userID'];
					$_SESSION['login'] = $this->userdata['login'];
					$_SESSION['usertypeID'] = $this->userdata['usertypeID'];
					$_SESSION['usertype'] = $this->userdata['usertype'];
					if ( $goodRedirect ) {
						$this->set_User_login();
						header( "Location: " . $goodRedirect );
					}
				}
				else{ // this account was blocked by the admin..
					if ( $badRedirect ) {
						echo '<script>alert("Sorry, this account was blocked by the administrator. Please contact the administrator to enable the account. Thanks.");history.go(-1);</script>';
						exit;
					}
				}
			}
			else{
				$this->destroy_userdata();
				if ( $badRedirect ) {
					header( "Location: " . $badRedirect );
				}
				return false;
			}
	}
	
	// Get the logged userid
	function getLoggedUserID(){
		return $this->userID;
	}
	
	// destroy the user data
	function destroy_userdata() {
		if ( $this->userdata ) {
			unset( $this->userdata );//DESTROY SESSION VARIABLES
			return true;
		}	
	}
	
	// Log-out the user
	function logout(){
		$this->destroy_userdata();
		session_unset();
		session_destroy();	
		return true;
	}  
	
	// Set user that he his login...
	function set_User_login(){
		$this->userID = $this->row->userID;
		$sql = " update content_users ";
		$sql .= " set is_loggedin= '1'";
		$sql .= " where userID = '$this->userID' ";
		
		if (!($result = $this->query( $sql ))) {
			die('Error:'. $this->error());
		}
	}
	
	// Set the user that he is already log-out and log the date of his last visit
	function set_User_logout( $userID ){
		$lastvisitDate = time();	
		$sql = " update content_users ";
		$sql .= " set is_loggedin= '0' , ";
		$sql .= " lastvisitDate=" . $lastvisitDate;		
		$sql .= " where userID=" . intval($userID);
		if (!($result = $this->query( $sql ))) {
			die('Error:'. $this->error());
		}
	}
}
?>