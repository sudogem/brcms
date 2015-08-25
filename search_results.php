<?php
require ( 'admin/coreclass.php' );
include ( 'search.php' );
$x = new online_tracker;
$x->tracker();

$gerger = new gerger_timer();
$gerger->start();
$gerger->setprecision(4);

session_start();
if ( isset ($_POST['searchstr']) ) {
	$keywords = $_POST['searchstr'];
	$_SESSION['search_string'] = $keywords;
}
if ( isset ($_SESSION['search_string'] ) ) {
	$keywords = $_SESSION['search_string'];
}
// Perform the search
$results = search_keyword($keywords);		//search for articles on the keywords table
$ids = combine_ids($results);				//combine all found article ids into one array
$rs = search_item($ids);					//search actuall articles

$searchresults = '';
$totalrows = count( $rs );
$limit = 2;
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
//print_r($pagelink);
$j = $start+1;
for( $i = $start; $i < $start+$limit; $i++ ) {
	if ( $rs[$i]['articleID'] ) {
		$searchresults .= '<li>' . ($j++) . '.&nbsp;<a href="' . VIEW_ARTICLE_URL2 . $rs[$i]['articleID'] . '" > ' . $rs[$i]['title'] . '</a></li>';
		$searchresults .= '<p>' . $rs[$i]['Summary'] . '...' . '</p><br>';
	}
}

/*
 * Get the default stylesheets
 */
include( 'admin/template.configuration.php' );
$stylesheet = ' themes/'.$default_template_name.'/'.$default_template_stylesheet; 
$gerger->stop();
$pagegenerated = $gerger->display();

// Generate the page now
$tpl = new template_parser( 'themes/templates/search_results.tpl.php' );
$tags = array(
		'{SEARCH_STR}'		=> $keywords ,
		'{KEYWORDS}'		=> $keywords ,
		'{NUMRESULTS}'		=> ' '. count($rs) ,
		'{RESULTS}'			=> $searchresults,
		'{PAGELINK}'		=> $pagelink->pagelinks , 	
		'{PAGE_GENERATED}'	=> '&nbsp;'.$pagegenerated,
				
		'{FOOTER}' 			=> 'themes/templates/footer.tpl.php' ,
		'{STYLESHEET}'		=> $stylesheet
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>
