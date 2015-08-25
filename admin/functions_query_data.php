<?php
/**
 * This function will send a query to the table user_stage then, retrieve the
 * stages that the user has been assign..
 * return the recordset in array()  
 */
function query_data( $userID ) {
// get this user stages of this user... 

$sql = "select * from user_stage us
		where us.userID = " .intval($userID ) .
		" order by us.stageID ASC ";  // sort the STAGES accordingly..
		
$db = new database;



if (!($result = $db->query( $sql ))) {
	die('Error:'. $db->error());
}

$user_stages = array();
while ( $row = $db->fetcharray() ) {
	$user_stages[] = $row;
}
$db->freeresult();// simply free the result..
print 'USERNAME='.$_SESSION['username'];
// ok pepol,, lets chek his user stages..

$sql = " select * from ";
// if the user has been assign with SOME workflows...
$state = 0;
foreach( $user_stages as $field => $user_stage ) {
	if ( $user_stage->stageID ) {
		switch ( $user_stage->stageID ) {
			case 1: // if the user is on writing stage, retrieve his articles
				$sql .= " articles a ,";
				$sql .= " article_author aa ";
				$state = 1; // we assume that there was another stages been assign..
				break;
			case 2: // the user is assign on editing stage..
				$editing_stage = 1;
				break;
			case 3: // ..proofreading stage..
				$proofreading_stage = 1;
				break;
			case 4: // ..publishinng stage..
				$publishing_stage = 1;
				break;
		}
	}
}
// if this user has been assign with these stages..editing, proofreading ..etc...
if (($editing_stage == 1) || ($proofreading_stage == 1) || ($publishing_stage == 1)) {
	if ( count ($user_stages) > 1 ) {// this user is assign with SOME WORKFLOWS..
		if ($state) {  // 
			$sql .= " ,article_versions av ";	
		}
		else{
			// simply, first call of the article versions..
			$sql .= " article_versions av ";	
		}
	}else{// this user has been set with one workflows..
		$sql .= "  article_versions av ";
	}

}
$sql .= " where "; // WHERE CLAUSE HERE..very important!!!! 
$state = 0;
if ( count( $user_stages ) > 1 ) { // this user has been assign with SOME WORKFLOWS
	foreach( $user_stages as $field => $user_stage ) {
		if ( $user_stage->stageID ) {
			switch( $user_stage->stageID ) {
				case 1: // writer
					$sql .= " a.stageID = 1 ";
					$sql .= " and aa.userID = $userID ";
					$state = 1;
					break;
				case 2: // editor
					// PROBLEM : concatenation of and..ex. editor+chef
					if ($state) {
						$sql .=" and av.stageID = 2 ";
					}else{
					    $sql .=  " av.stageID = 2 ";
					} 
					break;
				case 3: // editor n chief
					if ($state) {
						$sql .= " and av.stageID = 3 ";
					}else{
						$sql .= " av.stageID = 3 ";
					}
					//$sql .= " and av.modified_by = $userID ";
					break;
				case 4: // publisher
					$sql .= " and av.stageID = 4 ";			
					break;
			}
		}
	}

}
else {
	foreach( $user_stages as $field => $user_stage ) {
		if ( $user_stage->stageID ) {
			switch( $user_stage->stageID ) {
				case 1: // writer
					$sql .= " a.stageID = 1 ";
					//$sql .= " and aa.userID = $userID ";
					break;
				case 2: // editor
					$sql .= " av.stageID = 2 ";
					//$sql .= " and av.modified_by = $userID ";
					break;
				case 3: // editor n chief
					$sql .= " av.stageID = 3 ";
					//$sql .= " or av.modified_by = $userID ";
					break;
				case 4: // publisher
					$sql .= " av.stageID = 4 ";			
					break;
			}
		}
	}
}

print '[SQL='. $sql;
if (!($result = $db->query( $sql ))) {
	die('Error:'. $db->error());
}
$query_data = array();
while ( $query_data[] = $db->fetcharray() );
print '[totalrec='.$db->getnumrows();
//print_r($query_data );
return $query_data;

$db->close(); // close connection
}

?>