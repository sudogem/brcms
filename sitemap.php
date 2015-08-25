<?php
require ( 'admin/coreclass.php' );
$db = new database;



$x = new online_tracker;
$x->tracker();

$gerger = new gerger_timer();
$gerger->start();
$gerger->setprecision(4);

$sql = " select * from other_site_content where status='Published' and title='sitemap' order by created desc ";
if (!($result = $db->query($sql))) {
	die('Error:'.$db->error() );
}
$about = array();
while( $about[] = $db->fetcharray() );
$db->freeresult();
$title = $about[0]->title;
$body = $about[0]->body;
/*
 * Get the default stylesheets
 */
include( 'admin/template.configuration.php' );
$stylesheet = ' themes/'.$default_template_name.'/'.$default_template_stylesheet; 
$db->close();
$gerger->stop();
$pagegenerated = $gerger->display();

// Generate the page now
$tpl = new template_parser( 'themes/templates/sitemap.tpl.php' );
$tags = array(
		'{TITLE}'				=> $title,	
		'{BODY}'				=> $body,
		'{PAGE_GENERATED}'		=> '&nbsp;'.$pagegenerated,
		'{FOOTER}' 				=> 'themes/templates/footer.tpl.php' ,
		'{STYLESHEET}'			=> $stylesheet
	);
$tpl->parse_template( $tags );
print $tpl->display();
?>