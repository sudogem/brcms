<?php
	#this function constantly monitors the corporate partern's
	#banner status, and automatically sends a message to the
	#corporate partner if thier advertisment is about to expire 
include('autoresponder.php');	
	
class auto_res extends auto_responder{
	
	var $max;			#is the maximum impressions
	var $current_imp;		#the current number of remaining impressions
	var $status;		#the status of the ads
	
	function auto_res($destination, $message, $origin) {
		parent::auto_responder($destination, $message, $origin);
	}
	
	function notification_mail($max, $current, $status) {
	
		#where:
		#	$max is the maximum impressions purchased
		# 	$current is the remaining impressions of the ad
		#	$status is the current status of the ad
		
		$this->max = $max;
		$this->current_imp = $current;
		$this->status = $status;
		
		$val = ($this->max / 2) / 2;		#get the 1/4 of the
		
		if($this->status == 'expired') {
			if(!$this->send_mail()) {
				return false;
			} else {
				return true;
			}
		}
		
		if($this->current_imp == $val) {
			if(!$this->send_mail()) {
				return false;
			} else {
				return true;
			}
		}
	}
}
?>