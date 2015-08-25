<?php
/**
 * Todays quote: 
 * freewill is the most wonderful gift that we had, 
 * but sometimes it can be the most dangerous gift when we abuse it. -{mindhack++}
 */
class quote_of_the_day extends database {
	function quote_of_the_day() {
		$this->database();
	}
	
	function add_quote( $author = 'mindhack', $quote = '' ) {
		$sql = "insert into quotes( quote_author, quote_message ) ";
		$sql .= "values ( '$author', '$quote' )";
		if ( $this->query( $sql ) ) 
			return true;
		else 
			return false;
	}
	
	function update_quote( $quoteID = 0, $author = 'mindhack', $quote = 'all day long i think about sex..huh' ) {
		$sql = "update quotes ";
		$sql .= "set quote_author = '$author' ,";
		$sql .= " quote_message = '$quote' ";
		$sql .= " where quoteID = " . intval( $quoteID );
		if ( $this->query( $sql ) ) 
			return true;
		else 
			return false;
	}
	
	function view_quote( $quoteID = 0 ){
		$sql = "select * from quotes ";
		$sql .= " where quoteID =" . intval( $quoteID );
		$this->query( $sql );
		$quote = array();
		while( $quote[] = $this->fetcharray());
		$this->freeresult();
		return $quote;
	}
	
	function generate_random_quote() {
		$sql = "select * from quotes order by rand() ";
		$this->query( $sql );
		$quote = array();
		$this->fetcharray();
		$quote[] = $this->row;
		return $quote;
		$this->freeresult();
		$this->close();
	}
	
	function view_all_quotes(){
		$sql = "select * from quotes ";
		$this->query( $sql );
		$quote = array();
		while ( $quote[] = $this->fetcharray() );
		$this->freeresult();
		return $quote;
	}
}
?>