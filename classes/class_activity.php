<?php
class activity extends database {
		var $writing_article = "Writing an article";					//used when the use is writing an article
		var $editing_article  = "Editing an article";					//used when the user is editing an article
		var $saving_article  = "Saving an article";					//used when the ueer is saving an article
		var $deleting_article  = "Deleting an article";
		var $archiving_article  = "Archiving an article";
		var $unarchiving_article  = "Unarchiving an article";
		var $publishing_article  = "Publishing an article";				//used when the user is publishing an article
		var $uploading_image = "Uploading an image";					//used when the user uploads an image
		var $viewing_image = "Viewing an image";
		var $editing_imagedetails = "Editing image details";
		var $deleting_image = "Deleting an image";
		var $viewing_article = "Viewing an article";
		var $printing_article = "Printing an article";
		var $creating_user = "Creating a user";
		var $saving_user_profile = "Saving a user profile";
		var $viewing_user_profile = "Viewing user profile";
		var $editing_user_profile = "Editing a user profile";
		var $creating_client_profile = "Creating a client profile";
		var $viewing_client_profile = "Viewing client profile";
		var $editing_client_profile = "Editing client profile";
		var $saving_client_profile = "Saving client profile";						
		var $changing_password = "Changing a userpassword";
		var $changing_username = "Changing a username";
		var $changing_group = "Changing user group";		
		var $loggedin = "Logged in";
		var $logout = "Log-out";
		var $editing_userpermissions = "Editing a user access permissions";
		var $blocking_user = "Blocking a user";
		var $unblocking_user = "Unblocking a user";		
		var $viewing_userguides = "Viewing a user guides";
		var $viewing_msg = "Viewing a message ";
		var $deleting_msg = "Deleting a message ";
		var $sending_msg = "Sending a message ";
		var $creating_msg = "Creating a message ";
		var $creating_category = "Creating a category ";
		var $saving_category = "Saving a category ";		
		var $editing_category = "Editing a category ";
		var $creating_quote = "Creating a quote ";
		var $saving_quote = "Saving a quote ";		
		var $editing_quote = "Editing a quote ";
		
		var $viewing_category = "Viewing a category details ";		
		var $creating_bannerads = "Creating a banner ads ";
		var $viewing_bannerads = "Viewing banner ads details";
		var $editing_bannerads  = "Editing a banner ads";
		var $saving_bannerads  = "Saving a banner ads";		
		var $changing_template = "Changing a site-themes";
		var $searching = "Performing a search query";
		var $generating_report = "Generating a report";		//used when the user generated a report
		var $creating_poll_topic = "Creating a poll topic";	//used when the user created a poll topic
		var $editing_poll_topic = "Editing a poll topic";
		
	/* activity constructor
	 * @param none
	 */
	function activity() {
		$this->database();	
	}
	
	/* Set the user activity
	 * @param userid, activity
	 */
	function track_activity( $userid, $activity, $itemname ){
		//$date = date("Y-m-d");	
		$date = time();
		$itemname = addslashes( $itemname);
		$sql = " insert into activity_report( userID, activity, itemname, activity_date ) ";
		$sql .= " values( '$userid', '$activity', '$itemname', '$date' )";
		$this->query( $sql );
	}
	
	/* View all the user activity
	 * @param none
	 */
	function lists_all_activity(){
		$sql = "select distinct( activity ) from activity_report ar ";
		$this->query( $sql );
		$all_activity = array();
		while( $row = $this->fetcharray() ){
			$all_activity[] = $row;
		}
		$this->freeresult();
		return $all_activity;		
	}

	/* View activity given the activityid, startdate and end-date
	 * @param int activityid, startdate, end-date
	 */
	function view_activity( $userid, $activity, $startdate, $enddate ){
		$sqladd ="";
		$sql = " select * from activity_report ar where 1=1 ";
		if ($userid != 0) $sqladd .= " and ar.userID=$userid ";
		if ($activity != "" && $activity != '0' ) $sqladd .= " and ar.activity='$activity' ";
		if ($startdate != 0) $sqladd .= " and ar.activity_date > " . intval($startdate) ;	
		if ($enddate != 0) $sqladd .= " and ar.activity_date < " . intval($enddate) ;	
		$sql .= $sqladd;
		$this->query( $sql );
		$activity = array();
		while( $row = $this->fetcharray() ){
			$activity[] = $row;
		}
		return $activity;		
	}
}
?>