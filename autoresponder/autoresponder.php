<?php 
class auto_responder {

	var $message;				#the content of the email
	var $destination;			#the destination of the message
	var $origin;				#the origin (from) of the message or the sender
	var $prompt;				#the message sent by this system.
	
	
	function auto_responder($destination, $message, $origin) {
		$this->destination	= $destination;
		$this->message		= $message;
		$this->origin		= $origin;
	}
	
	#this function is used to verify if the origin or
	#the sender is of correct format
	function verify_origin() {
		if($this->origin == "") {
			return false;
		} else {
			return true;
		}
	}
	
	#this function verifies if the destination address
	#is of correct format.
	function verify_destination() {
		if($this->destination == "") {
			return false;
		} else {
			return true;
		}
	}
	
	#this function makes sure that the message is not empty
	function verify_message() {
		if($this->message == "") {
			return false;
		} else {
			return true;
		}
	}
	
	#this function sends the email message to the destination
	#address.
	function send_mail() {
		if(!$this->verify_origin()) {
			$this->prompt = "ERROR: invalid message source address. ".$this->origin;
			exit();
		}
		
		if(!$this->verify_destination()) {
			return false;
		}
		
		if(!$this->verify_message()) {
			return false;
		}
		
		if(!mail($this->destination, 'A message from El Nuevo Bantay Radyo', $this->message, $this->origin)) {
			return false;
		} else {
			return true;
		}
	}
}
?>