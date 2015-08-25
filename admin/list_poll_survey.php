<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: login.php');
}
if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}
if ( isset( $_SESSION['task'] ) && $_SESSION['task'] != '' ) {
	switch ( $_SESSION['task'] ) {
		case 'edit':
			$message  = 'Changes of "' . $_SESSION['title'] . '" was succesfully saved ';
			break;
		case 'add':
			$message = 'Successfully saved poll :' . $_SESSION['title'];
			break;
		default:
			$message = '';
			break;	
	}
	unset ($_SESSION['title']);	
	unset ($_SESSION['task']);	
}
else {
  $print_welcome_message = true;			
}


$sql = 'SELECT poll_topic.* FROM poll_topic order by topic_date DESC';
$db = new database;



//print_r($_SESSION);
//print $sql;	
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$poll_topic = array();
while( $row = $db->fetcharray() ) {
	$poll_topic[] = $row; 
}
$n = $db->getnumrows();
$db->freeresult();

$totalrows = count( $poll_topic );

$limit = 10;
$paging = ceil( $totalrows / $limit );
$scroll = 1;
$scrollnumber = 5;

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}else{
	$page = 1;
}
$start = $page * $limit - ($limit);
$pagelink = new paging( $page, $totalrows, $limit, $paging, $scroll, $scrollnumber );

//print_r($article_versions);
$j = $start+1;
for( $i = $start; $i < $start+$limit ; $i++ ) {
	if ( $poll_topic[$i]->topic_id ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $j++;
		$row_data .= '</td>';
		
		#check box
		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="cid[]" id="cb' . $i . '" value="' . $poll_topic[$i]->topic_id . '" onClick="isChecked(this.checked);"/>';
		$row_data .= '</td>';			
		
		#the title
		$row_data .= '<td class="blue2">';
		$row_data .= '<a href="' . VIEW_POLL_DETAIL . $poll_topic[$i]->topic_id . '">';
		$row_data .= '&nbsp;' . $poll_topic[$i]->topic;
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		#topic date
		$row_data .= '<td class="blue2">';
		#$row_data .= '<a href="' . VIEW_ARTICLE_URL . $$poll_topic[$i]->topic_id . '">';
		$row_data .= '&nbsp;' . $poll_topic[$i]->topic_date;
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		
		#expiry date
		$row_data .= '<td class="blue2">';
		//$row_data .= '<a href="' . VIEW_ARTICLE_URL . $$poll_topic[$i]->topic_id . '">';
		$row_data .= '&nbsp;' . $poll_topic[$i]->expiry_date;
		//$row_data .= '</a>';
		$row_data .= '</td>';
		
		#link to graph
		$row_data .= '<td class="blue2">';
		$row_data .= '<a href="#"  onClick=popupWindow("' . "create_poll_graph.php?topic_id=" . $poll_topic[$i]->topic_id . '","win1",650,350,"yes","yes");>';
		$row_data .= '&nbsp;View Graphical Result';
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		$_SESSION['$poll_topic_id'] = $poll_topic[$i]->topic_id;
		
		$row_data .= '</tr>';
	}			
}


// link for print preview
#$link = "preview_article.php?articleID=$articleID";
// print $set_template;
// start compiling the page...
$tpl = new template_parser( "../templates/reports/list_poll_survey_tpl.php" );
$tags = array(
		'{SITENAME}'		=>	'Poll Survey Manager',
		'{POLL_ID}'			=>  'Poll Number',
		'{POLL_TITLE}'		=>	'Poll Title',
		'{DATE_CREATED}'	=>	'Date Created',
		'{EXPIRY_DATE}'		=>	'Expiry Date',
		'{VIEW_GRAPH_LABEL}'=>	'View Graph',
		'{TABLE_DATA}'		=>	$row_data,
		'{PAGE_LINK}'		=>  $pagelink->pagelinks,
		'{MESSAGE}'			=>	$message,
		'{NUMITEMS}'		=> ''. $totalrows,
		'{TOPNAV}' 			=> 'top_menu.php',
		'{FOOTER}' 			=>  'footer.php' 
		);
		
$tpl->parse_template( $tags );
print $tpl->display();
?>