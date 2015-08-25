<?php 
include( 'configuration.php' );
include('coreclass.php');
//include("../admin/graph/graph_creator.php");
function create_poll_graph($topic_id) {	
	//create an instance of class database here
	$con = new database();
	
	//the purpose of this query is to get the response labels of the poll survey
	$query_label = "select poll_topic.* from poll_topic where poll_topic.topic_id = '$topic_id'";
	//echo $query_label;
	$rs = $con->query($query_label);
		
		if(!$con) {
			echo "<strong>Error:</strong> ".$con->error();
			exit;
		} else {
			$label = mysql_fetch_assoc($rs);
		}
	
	//get individual label
	$arr_label = explode(',', $label['response_label']);
	//print_r($arr_label);
	//echo count($arr_label);
	$arr_query = array();		//create an array
	$arr_result = array();		
	$data = array();
	//get user responses
	$x = count($arr_label);
	for($i=0; $i < $x ; $i++ ) {
		$arr_query[$i] = "SELECT * FROM poll_data WHERE 
				poll_data.topic_id = '$topic_id' and poll_data.response = '$arr_label[$i]' ";
		$arr_result[$i] = mysql_query($arr_query[$i]) or die("Error : ".mysql_error());
		$data[$i] = mysql_num_rows($arr_result[$i]);
	}
	$n = count($data);
	for( $i=0;$i<$n;$i++ ){
		$sum .= $data[$i];
	}
	if ($sum == 0) {
		echo '<script>alert("Sorry, no votes results found.");window.close();</script>';
		exit();
	}
	$label_2 = array();
	$value_2 = array();
	
	//extract the value of each fields
	$graph = new graph_creator( 320, 600, $label['topic'], $arr_label, $data, $center_value = 0.45 );
	$graph->create_pie_graph();
}

function create_usage_graph($from_date, $end_date) {
	//create an instance of class database here
	$con = new database();
	
	//set up query string
	$query_members = "SELECT * FROM people_online WHERE people_online.member = 'y' 
					  AND people_online.log_date BETWEEN '$from_date' AND '$end_date'";
					  
	$query_visitors = "SELECT * FROM people_online WHERE people_online.member = 'n' 
					  AND people_online.log_date BETWEEN '$from_date' AND '$end_date'";
	
	$rs_members = $con->query($query_members) or die($con->error());
	$rs_visitors = $con->query($query_visitors) or die($con->error());
	// COMMENT : must use OOP style ( use the $con object uve created  ) not a procedural one...-mh
	
	$data_member = mysql_fetch_assoc($rs_members);// this is wrong...
	$data_visitors = mysql_fetch_assoc($rs_visitors);

	$data_member = $con->getnumrows($rs_members);
	$data_visitors =  $con->getnumrows($rs_visitors);
	$data = $data_member + $data_visitors;
	if ($data == 0) {
		echo '<script>alert("Sorry, no usage results found.");window.close();</script>';
		exit();
	}
	
	//echo 'm='.$data_member;
	//echo 'v='.$data_visitors;
	$arr_label = array("Members", "Visitors");
 	//$arr_data = array($data_member['MEMBERS'], $data_visitors['VISITORS']);
	$arr_data = array($data_member, $data_visitors);
	//start displaying the graph
	$from_date = explode('-', $from_date );
	$from_date = strdate($from_date[1], '','') . ' '.$from_date[2]. ','. $from_date[0]; 
	
	$end_date = explode('-', $end_date );
	$end_date = strdate($end_date[1], '', '') . ' '.$end_date[2] . ','. $end_date[0] ; 
	
	$graph = new graph_creator( 320, 600, "People Online As of $from_date to $end_date", $arr_label, $arr_data, $center_value = 0.45 );
	$graph->create_pie_graph();
}

function create_activity_report_graph($from_date, $end_date) {
	echo "Sory Not Finish With This Part Yet!!!";
}
?>