<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Other Polls</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" >
	/**
	* Pops up a new window in the middle of the screen
	*/
	function popupWindow(mypage, myname, w, h, scroll ) {
		var winl = (screen.width - w) / 2;
		var wint = (screen.height - h) / 2;
		winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable'
		//alert(winprops);
		win = window.open(mypage, myname, winprops)
		if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
	}
</script>
</head>

<body>
<?php
require ( 'admin/coreclass.php' );
$db = new database;



/**
 * Get the poll of the day
 */
 $date = date('Y-m-d');
$sql  = "SELECT * FROM poll_topic"; 
$sql .= " WHERE topic_date = '$date' OR '$date' BETWEEN topic_date AND expiry_date ";
//echo $sql;
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
$topiclist = array();
while( $row = $db->fetcharray() )$topiclist[] = $row ;
//print_r($topiclist );
//$db->freeresult();
//print_r($_POST);
if ( isset($_POST['pol']) ){
$ptopicid = $_POST['pol'];
$date = date('Y-m-d');
$sql  = "SELECT * FROM poll_topic"; 
$sql .= " WHERE topic_date = '$date' OR '$date' BETWEEN topic_date AND expiry_date and topic_id = '$ptopicid' ";
//echo $sql;
$db = new database;



if (!($result = $db->query($sql))){
	die('Error:'. $db->error());
}
$poll = array();
while( $poll[] = $db->fetcharray() );
	$topicid = $poll[0]->topic_id;
	$topic = $poll[0]->topic;
	$labels = $poll[0]->response_label;
	$labels = explode(",", $labels);
	foreach( $labels as $idx => $value ){
		$optlabel .= '<input name="label" type="radio" value="' . $value . '">' . $value ;
		$optlabel .= '<br>';
	}
	$viewpollresult .= '<input type="button" class="button2" onClick=popupWindow("' . "admin/create_poll_graph.php?topic_id=" . $topicid . '","win1",530,350,"yes","yes"); name="submit" value="Results"  class="button" />';
	//$viewpollresult = '<a href="#"  onClick=popupWindow("' . "admin/create_poll_graph.php?topic_id=" . $topicid . '","win100",530,350,"yes","yes");>';
	//$viewpollresult .= '&nbsp;<b class="whitetext">Results</b>';
	$viewpollresult .= '</a>';
	
	$polls .= '<form name="pollform" method="post" action="admin/save_poll_response2.php">';
	$polls .= '	<input type="hidden" name="topicid" value="'. $ptopicid . '" >';
	$polls .= $topic;
	$polls .= '<br>'; 
	$polls .= $optlabel;
	$polls .= '<input type="submit" name="submit" value="Vote"  class="button" />';
	$polls .= $viewpollresult;
}
?>
<table width="100%" border="0" style="font:normal 12px Arial, Helvetica, sans-serif; ">
  <tr>
    <td width="252" valign="top"><span style="font:normal 12px Verdana;">Select Poll:</span></td>
    <td width="529" valign="top">
	<form name="adminForm" method="post" action="view_more_poll.php" >
	<select name="pol" onChange="document.adminForm.submit();" style="background-color:#E9EFF5;
	border: 1px solid #999999; ">
	<option value="">Select Poll from the list</option>
		<?php
			foreach( $topiclist as $id => $data ){
				echo '<option value="' .  $data->topic_id . '" >' . $data->topic;
				echo '</option>';
			}
		?>
    </select>
	</form>
	</td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $polls;?></td>
  </tr>
</table>

</body>
</html>
