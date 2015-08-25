<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="admin/admin_scripts.js" ></script>
</head>

<body>
<?php
print_r($_POST);
?>
<form name="adminForm" method="post" action="check.php">
<input type="checkbox" name="toggle" value="" onClick="checkAll(4);" >
<br>
<input name="cid[]" id="cb0" type="checkbox" value=""  onClick="isChecked(this.checked);"><br>
<input name="cid[]" id="cb1" type="checkbox" value=""  onClick="isChecked(this.checked);"><br>
<input name="cid[]" id="cb2" type="checkbox" value=""  onClick="isChecked(this.checked);"><br>
<input name="cid[]" id="cb3" type="checkbox" value=""  onClick="isChecked(this.checked);"><br>
<input type="submit">
</form>
</body>
</html>
//print_r($_POST);
$db = new database;



$sql = " select * from article_versions av ";
$sql .= " where av.stageID=5 and av.status='published'";

if (!($result = $db->query( $sql ))){
	die ( 'Error:' . $db->error());
}
$article_versions = array();
while( $row = $db->fetcharray() ) {
	$article_versions[] = $row; 
}
$row_data = '';
for( $i = 0; $i < count($article_versions) ; $i++ ) {
	if ( $article_versions[$i]->articleID ) {
		 (($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '">';
		
		$row_data .= '<td>';
		$row_data .= $i+1;
		$row_data .= '</td>';
					
		$row_data .= '<td>';
		$row_data .= '<input type="checkbox" name="checkitem[]" id="checkitem[]" value="' . $article_versions[$i]->articleID . '">';
		$row_data .= '</td>';			
		
		$row_data .= '<td>';
		$row_data .= '<a href="' . VIEW_ARTICLE_URL . $article_versions[$i]->articleID . '">';
		$row_data .= '&nbsp;' . $article_versions[$i]->title;
		$row_data .= '</a>';
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$author_name = getArticle_authors ( $article_versions[$i]->articleID );
		$row_data .= '&nbsp;' .  $author_name;
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$category_name = getCategory_name( $article_versions[$i]->articleID );
		$row_data .= '&nbsp;' . $category_name;
		$row_data .= '</td>';

		$row_data .= '<td>';
		$category_name = getFrontpage_type( $article_versions[$i]->articleID );
		$row_data .= '&nbsp;' . $category_name;
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$row_data .= '&nbsp;' . getStage_name ( $article_versions[$i]->stageID );
		$row_data .= '</td>';
		
		$row_data .= '<td>';
		$row_data .= '&nbsp;' . friendlyDate2($article_versions[$i]->created);
		$row_data .= '</td>';
		
		switch ( $_SESSION['stageID'] ) {
			case 5:// published date of the article..can be viewd by the admin only???
				$row_data .= '<td>';
				$date = ($article_versions[$i]->dateline)?friendlyDate2($article_versions[$i]->dateline):'0';
				$row_data .= '&nbsp;' . $date;
				$row_data .= '</td>';
				break;
			default:
				$row_data .= '<td>';
				$date = ($article_versions[$i]->modified)?friendlyDate2($article_versions[$i]->modified):'0';
				$row_data .= '&nbsp;' . $date;
				$row_data .= '</td>';
				break;	
		}
		$row_data .= '</tr>';
	}			
}


if ( isset($_POST['submit'] )) {
	$year = $_POST['year'];
	$month = $_POST['month'];
	$month2 = strdate("$month",'');
	
	if ($_POST['reportype']==2 ){
	$optreportype .= '<option value="1"  >Usage Report</option>';
	$optreportype .= '<option value="2" selected>Lists of member Report</option>';
	$optreportype .= '<option value="3" >News Contents Report</option>';
// obtain list of users
$sql = " select * from content_users ";
if (!($result = $db->query( $sql ))){
	die ( 'Error:' . $db->error());
}
$content_users = array();
while ( $row = $db->fetcharray() ) $content_users[] = $row;
$row_data2 = '';
for( $i = 0; $i < count($content_users); $i++ ){
	if ( $content_users[$i]->userID ) {
		(($i % 2) == 0 )? $bgcolor = "" : $bgcolor="#F5F5F5";
		$row_data2 .= '<tr class="tdhover" id="tdata" bgcolor = "'. $bgcolor . '" align = "left">';
	
		$row_data2 .= '<td>';
		$row_data2 .= $i+1;
		$row_data2 .= '</td>';
		
		$row_data2 .= '<td align="left">';
		$row_data2 .= '<a href="' . VIEW_PROFILE_URL_MANAGER . $content_users[$i]->userID . '">';
		$row_data2 .= '<input type="hidden" value = "' . $content_users[$i]->userID . '">';
		$row_data2 .= '&nbsp;'. $content_users[$i]->fullname;
		$row_data2 .= '</td>';
		
		$row_data2 .= '<td align="left">';
		$row_data2 .= '&nbsp;'. $content_users[$i]->username;		
		$row_data2 .= '</td>';	
		
		$row_data2 .= '<td align="left">';
		if ($content_users[$i]->is_enabled) {
			$row_data2 .= '<img src="images/publish_x.png" width="12" height="12" border="0" alt="" />';
		}
		else{
			$row_data2 .= '<img src="images/tick.png" width="12" height="12" border="0" alt="" />';	
		}
		$row_data2 .= '</td>';		
			
		$row_data2 .= '<td align="left">';
		$group_name = getGroup_name ( $content_users[$i]->usertypeID );
		$row_data2 .= '&nbsp;'.$group_name;
		$row_data2 .= '</td>';
		
		$row_data2 .= '<td>';
		$row_data2 .= '&nbsp;'.$content_users[$i]->email;
		$row_data2 .= '</td>';

		$row_data2 .= '<td>';
		if ($content_users[$i]->phoneno){
			$contactno = $content_users[$i]->phoneno;
		}
		else{
			if ($content_users[$i]->celno){
				$contactno = $content_users[$i]->celno;
			}
			else $contactno = '--';
		}
		$row_data2 .= '&nbsp;'. $contactno;
		$row_data .= '</td>';
		
		$row_data2 .= '</tr>';
	}
}
	
	}
	if ($_POST['reportype']==3 ){
	$optreportype .= '<option value="1"  >Usage Report</option>';
	$optreportype .= '<option value="2" >Lists of member Report</option>';
	$optreportype .= '<option value="3" selected >News Contents Report</option>';
	}
	
	if( $_POST['reportype'] == 1 ) {
		include('../graph/graph_creator.php');
		$sql1 = "select count(people_online.member) as Visitors from people_online where 
		people_online.member = 'n' 
		and month = '$month'
		and year = '$year'
		";
		
		$sql2 = "select count(people_online.member) as Members from people_online where 
		people_online.member = 'y'
		and month = '$month'
		and year = '$year'
		";
		$v=$db->query( $sql1 );
		$m=$db->query( $sql2 );
		$visitors=$db->fetcharray($v);
		$members=$db->fetcharray($m);
		if ($visitors->Visitors == 0 ) {
			$data[0] = "-1";
		}else{			
			$data[0] = $visitors->Visitors;
		}
		if ($members->Members == 0 ) {
			$data[1] = "0";
		}else{
			$data[1] = $members->Members;			
		}	
		$leg[0] = 'Visitors';
		$leg[1] =  'Members';
		$graph = new graph_creator( 300, 460, "Usage Report as of $month2 $year" , $leg, $data );
		$graph->create_pie_graph();	
	 }
}	
