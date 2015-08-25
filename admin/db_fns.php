<?php
require ( 'coreclass.php' );

function update ( $query = '' ) {

	$db = new database;



	if ( $result = $db->query( $query ) ) {
		
		return true;
	}
	else {
		return false;
	}

}
?>