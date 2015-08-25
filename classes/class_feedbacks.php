<?php
/* @className   : feedbacks
 * @purpose     : All about feedbacks
 * @version 	: 3.10 14-MARCH-2005 4:52 AM
 * @author 	    : mindh4c]k[
 * @todaysQuotes: what makes 1+1=2 ? 
 */
class feedbacks extends database {
	/*
	 * feedbacks constructor
	 */
	function feedbacks() {
		$this->database();
	}

	function send_feedbacks( $author, $email, $feedbacks, $category ){
		$date = time();
		$sql = " insert into feedbacks ";
		$sql .= " values( '', '$date', '$author', '$email', '$feedbacks', 'Unread', '$category' )";
		$this->query($sql);
	}
	
	/* View all unread feedback of the user
	 * @param int userID
	 */
	function view_unread_feedbacks ( $cat ){
		$sql = " select * from feedbacks fb ";
		$sql .= " where fb.state='Unread' and category='$cat' ";
		$this->query($sql);
		$unread_feedbacks = array();
		while ( $unread_feedbacks[] = $this->fetcharray() ); 
		$this->freeresult();
		return $unread_feedbacks;
	}
	
	/* View all feedbacks posted by the user
	 * @param int userID
	 */
	function view_all_feedbacks ( $category ){
		$sql = " select * from feedbacks where category='$category' ";
		$this->query($sql);
		$all_feedbacks = array();
		while ( $all_feedbacks[] = $this->fetcharray() ); 
		$this->freeresult();
		return $all_feedbacks;
	}
	
	/* Set the flag of the feedbacks 'Read' when the user click the feedbacks
	 * @param int feedbackid
	 */
	function set_read_feedback( $feedbackID ) {
		$sql = " update feedbacks ";
		$sql .= " set state='Read' ";
		$sql .= " where autoNumber = " . intval( $feedbackID );
		$this->query($sql);
	}

	/* Display the message of the user given the msgID
	 * @param int userID, int msgID
	 */
	function read_feedback( $feedbackID ) {
		$sql = " select * from  feedbacks fb ";
		$sql .= " where fb.autoNumber=" . intval( $feedbackID );
		$this->query($sql);
		$read_message = array();
		while ( $read_message[] = $this->fetcharray() ); 
		$this->freeresult();
		return $read_message;
	}

	/* Delete the message of the user given the msgID
	 * @param int userID, int msgID
	 */
	function delete_feedback( $feedbackID ) {
		$sql = " delete from feedbacks ";
		$sql .= " where autoNumber =" . intval( $feedbackID );
		if ($this->query($sql)){
			return true;
		}
		else{
			return false;			
		}
	}
}
?>