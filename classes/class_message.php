<?php
/* @className   : message
 * @purpose     : Send message to the user internally
 * @version 	: 3.10 26-DEC-2005 6:20 AM
 * @author 	    : mindh4c]k[
 * @todaysQuotes: the voice of the snake crawling over my skin..
 					i can feel it the warm and the night was so cold..
					
 */
class messages extends database {
	/*
	 * Message constructor
	 */
	function messages() {
		$this->database();
	}
	
	/* Send a message to the user
	 * @param int userID_from, int_array receiverID, 
	 *        int date, state='Unread', string subject, string message
	 */
	function sendmessage( $userID_from , $receiverID, $date_time, $state='Unread', $subject, $message ) {
	$numreceiver = count( $receiverID );
		// sent message by many persons
		if (is_array( $receiverID ) ){
			for( $i=0; $i<$numreceiver; $i++ ) {
				foreach( $receiverID as $index => $userID ){
					if ( $index ) {
						$userID = $receiverID[$i];
						$sql = " insert into messages( userID_from, receiverID, date_time, state, subject, message) ";
						$sql .= " values( '$userID_from', '$userID', '$date_time', '$state', '$subject', '$message')";
						if (!($this->query ( $sql ))) {
							die( 'Error: Sendmessage failed..' . $this->error() );
						}
					}
				}
			}
		}
		// sent message by single person
		else{
			$sql = " insert into messages( userID_from, receiverID, date_time, state, subject, message) ";
			$sql .= " values( '$userID_from', '$receiverID', '$date_time', '$state', '$subject', '$message')";
			
			if (!($this->query ( $sql ))) {
				die( 'Error: Sendmessage failed..' . $this->error() );
			}
			else {
				//echo 'Successfully send message';
				return true;
			}
		}
	}
	
	/* View all unread message of the user
	 * @param int userID
	 */
	function view_unread_messages ( $userID ){
		$sql = " select * from messages msg ";
		$sql .= " where msg.receiverID=" . intval( $userID );
		$sql .= " and isarchive=0";
		$sql .= " and msg.state='Unread'";
		$this->query($sql);
		$unread_messages = array();
		while ( $unread_messages[] = $this->fetcharray() ); 
		$this->freeresult();
		return $unread_messages;
	}
	
	/* View all messages of the user
	 * @param int userID
	 */
	function view_all_messages ( $userID ) {
		$sql = " select * from messages msg ";
		$sql .= " where msg.receiverID=" . intval( $userID );
		$sql .= " and isarchive=0";		
		$sql .= " order by msg.date_time DESC ";

		$this->query($sql);
		$all_messages = array();
		while ( $all_messages[] = $this->fetcharray() ); 
		$this->freeresult();
		return $all_messages;
	}
	
	function view_client_messages( $clientID ){
		$sql = " select * from client_messages ";
		$sql .= " where clientID=" .intval( $clientID );
		$this->query( $sql );
		$clientmsg = array();
		while( $clientmsg[] = $this->fetcharray() );
		$this->freeresult();
		return $clientmsg;
	}
	
	/* View all messages of the user
	 * @param int userID
	 */
	function view_all_messages_limit ( $userID, $start, $limit ) {
		$sql = " select * from messages msg ";
		$sql .= " where msg.receiverID=" . intval( $userID );
		$sql .= " order by msg.date_time DESC LIMIT $start, $limit ";
		$this->query($sql);
		$all_messages = array();
		while ( $all_messages[] = $this->fetcharray() ); 
		$this->freeresult();
		return $all_messages;
	}
	
	/* Set the flag of the message 'Read' when the user click the message
	 * @param int userID, int msgID
	 */
	function set_readmessage( $userID, $msgID ) {
		$sql = " update messages ";
		$sql .= " set messages.state='Read' ";
		$sql .= " where messages.receiverID=" . intval( $userID );
		$sql .= " and messages.messageID=" . intval( $msgID );
		$this->query($sql);
	}
	
	/* Display the message of the user given the msgID
	 * @param int userID, int msgID
	 */
	function read_message( $userID, $msgID ) {
		$sql = " select * from messages msg ";
		$sql .= " where msg.messageID=" . intval( $msgID );
		$sql .= " and msg.receiverID=" . intval( $userID );

		$this->query($sql);
		$read_message = array();
		while ( $read_message[] = $this->fetcharray() ); 
		$this->freeresult();
		return $read_message;
	}
	
	/* Delete the message of the user given the msgID
	 * @param int userID, int msgID
	 */
	function delete_message( $userID, $msgID ) {
		$sql = " select * from messages msg ";
		$sql .= " where msg.messageID=" . intval( $msgID );
		$sql .= " and msg.receiverID=" . intval( $userID );
		
		$this->query($sql);
		$message = array();
		while ( $message[]	 = $this->fetcharray() ); 
		if ( $this->getNumrows() > 0) {
			$sql = " delete from messages ";
			$sql .= " where messageID=" . intval( $msgID );
			$sql .= " and receiverID=" . intval( $userID );			
			if ($this->query($sql)){
				return true;
			}
			else return false;			
		}
	}
	
	function archive_message( $userID, $msgID ) {
		
		$datearchive = time();
		$sql = " select * from messages msg ";
		$sql .= " where msg.messageID=" . intval( $msgID );
		$sql .= " and msg.receiverID=" . intval( $userID );
		$this->query($sql);
		$message = array();
		while ( $message[] = $this->fetcharray() ); 
		if ( $this->getNumrows() > 0) {
			$sql = " update messages ";
			$sql .= " set isarchive=1 , ";
			$sql .= " date_archive = '$datearchive' ";
			$sql .= " where messageID=" . intval( $msgID );
			$sql .= " and receiverID=" . intval( $userID );			
			//echo $sql;
			if ($this->query($sql)){
				return true;
			}
			else return false;			
		}
	}
	
	function unarchive_message( $userID, $msgID ) {
		$datearchive = time();
		$sql = " select * from messages msg ";
		$sql .= " where msg.messageID=" . intval( $msgID );
		$sql .= " and msg.receiverID=" . intval( $userID );
		$this->query($sql);
		$message = array();
		while ( $message[] = $this->fetcharray() ); 
		if ( $this->getNumrows() > 0) {
			$sql = " update messages ";
			$sql .= " set isarchive=0 , ";
			$sql .= " date_unarchive = '$datearchive' ";
			$sql .= " where messageID=" . intval( $msgID );
			$sql .= " and receiverID=" . intval( $userID );			
			if ($this->query($sql)){
				return true;
			}
			else return false;			
		}
	}	
	
	function view_all_archive_message( $userID ) {
		$sql = " select * from messages msg ";
		$sql .= " where isarchive=1 ";
		$sql .= " and receiverID = '$userID' ";
		$this->query($sql);
		$message = array();
		while ( $message[] = $this->fetcharray() ); 
		return $message;
	}
	
	/* Return the message subject given the msgID
	 * @param int userID, int msgID
	 */
	function getMessage_subject( $userID, $msgID ){
		$sql = " select * from messages msg ";
		$sql .= " where msg.receiverID=" . intval( $userID );
		$sql .= " and msg.messageID=" . intval( $msgID );
		$this->query( $sql );
		if ( $subject = $this->fetcharray() );
		return $subject->subject;
	}
}

?>