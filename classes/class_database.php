<?php
/*
 * @className   : database
 * @purpose     : Connect to the database and perform some database queries :-)  
 * @version 	: 3.2 23-Nov-2005 1:42 AM
 * @author 	    : mh (dream to be an illuminati member-)
 * @todaysQuotes: Lorem ipsum dolor sit amet consectetur adispicing elit sed diam
 */
include ('class_dbsettings.php');
class database extends dbsettings {
	var $query_result;
	
	// Constructor..
	function database() {
		$settings = new dbsettings();
		$this->dbservername = $settings->dbservername;
		$this->dbusername = $settings->dbusername;
		$this->dbpassword = $settings->dbpassword;
		$this->persistency = $settings->persistency;
		$this->persistency = true;
		$this->databasename = $settings->databasename;
		$this->logme();
		/*$this->dbservername = $dbservername;
		$this->dbusername = $dbusername;
		$this->dbpassword = $dbpassword;
		$this->databasename = $databasename;
		$this->persistency = $persistency;*/
		//echo $this->databasename ;
		
		if ( $this->persistency ) {
			$this->linkID = mysql_pconnect( $this->dbservername, $this->dbusername, $this->dbpassword );
		}else{
			$this->linkID = mysql_connect( $this->dbservername, $this->dbusername, $this->dbpassword );
		}
		
		if ( $this->linkID ){ 
			if ( $this->databasename != "" ){
				$dbselect = mysql_select_db( $this->databasename );
				if ( !$dbselect ){
					$this->error(); 
					$this->close();
					return false;
				}
				else{
					//echo 'Database selected.';
				}
			}
			//echo 'im connected :-)...';
			return $this->linkID;
		}
		else{
			// TODO: call destructor method here..
			$this->destructor();
			return false;
		}
	}// detabeys
	function connect($dbservername, $dbusername, $dbpassword, $databasename, $persistency ){
		$this->dbservername = $dbservername;
		$this->dbusername = $dbusername;
		$this->dbpassword = $dbpassword;
		$this->persistency = $persistency;
		$this->databasename = $databasename;
	}
	function logme(){
		static $i;
		$i++;
		//echo $i;
	}
	function error(){
		return '[MYSQL ERROR='.mysql_error() . ' SQL: ' . $this->query . ']';
	}//iror
	
   /* Destroy the pre-existing result
	* @access public
	* @param nothing
	*/ 
	function destroy_result(){
		if ( $this->linkID ) {
			if ( $this->query_result) {
				unset($this->query_result);
			}
		}
		//unset($this->linkID);   // unset this or not ?
	}//destroyresult
	
	/*
	 * my simple workaround destructor..since PHP 4 doesn't support destructor..{mh}
	 */
	function destructor(){
		register_shutdown_function( array(&$this, 'close') );
	}//destraktor

   /* Execute a database query
	* @access public
	* @param string $query -> SQL query to execute
	*/ 
	function query( $query = "" ){
		$this->destroy_result();
		$this->query = $query;
		//echo $this->query;
		if ( $query != "" ) { 
			$this->query_result = mysql_query( $this->query );
			$this->insertID = mysql_insert_id(  );// insertID, we will use this later ok..		
		}
		if ( $this->query_result ) {
			//echo ' query success ';
		}
		else {
			echo ' query failed :( ' . $this->error() ;
		}
		return $this->query_result;
	}//kwe-ry
	
	/* Get array of query results
	* @access public 
	* @param int $resourceID -> fetch a result row as an object
	*/
	function fetcharray( $resourceID = 0 ){
		if ( !$resourceID ) {
			$resourceID = $this->query_result;
		}
		if ( $resourceID ) {
			$this->row = mysql_fetch_object( $resourceID );
			return $this->row;
		}
		
	}//pets-arey
	
	/* Get number of rows in result
	* @access public 
	* @param int $resourceID  
	*/
	function getnumrows( $query_result = 0 ) {
		if ( $query_result ) $this->query_result = $query_result;
		if ( $this->query_result ) {
			$this->numrows = mysql_num_rows( $this->query_result );
		}
		return $this->numrows;
	}// getnamrows
	
   /* Close the database connexion.org
	* @access public
	* @param nothing
	*/
	function close (){
		if ( $this->linkID ) {
			if ( $this->query_result ) {
				$this->destroy_result();
				$this->freeresult();
				mysql_close( $this->linkID );
			}
		}else{
			return false;
		}
	}//klos
	
	/* Free result memory
	* @access public
	* @param get the current resourceID
	*/
	function freeresult( $resourceID = 0 ){
		if ( !$resourceID) {
			$resourceID = $this->query_result;
		}
		if ( $resourceID ) {
			$free_result = mysql_free_result( $resourceID );
			//echo ' im free na jud intawon.. ';
			return $free_result;
		}
		return false;
	}// pre-result
	
	/* Return the ID generated from the previous INSERT operation 
	* @access public
	* @param current resoureID
	*/
	function getInsertID() {
		return $this->insertID;
	}
}
?>
