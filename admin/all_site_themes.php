<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
include ('template.configuration.php');// LOAD DEFAULT TEMPLATES

if (!($dir = opendir($themes_dir))){
	echo "<div class=\"msgboxError\">";	
	echo "<br>Sorry, the themes directory is not found";
	echo "<br>Please try again later.";
	echo "<div align=\"center\"><a href=\"index.php\">Back to Home</a></div>";
	echo "</div>";
	return;
}
$totalentries = 0;
while($name = readdir($dir)){
	if ($name == '.' || $name == '..'){
		continue; 
	}
	if (is_dir($themes_dir.$name)){
		$total_entries++;
	}
}
rewinddir($dir);
if (!isset($_GET['view_start'])) $view_start = 1;
else $view_start = $_GET['view_start'];

/* we will display 9 templates at a time */
$k = 1;
// loop it until root directory is found..
/* TODO: hidden files, system files 
and executable files MUST be check to prevent system vulnerabilities..prone to hacking??? */
while ($name = readdir($dir)){
	if ($name == '.' || $name == '..' ) continue;
	if (is_dir($themes_dir.$name)) {
		if ($k == $view_start || $view_start == 1) break;
		$k++;
	}
}

// TODO: put error handling...
do {
 if(is_dir($themes_dir.$name)){ // lets check if template is found...
	if (is_file($themes_dir.$name."/template.info.php")){
		include($themes_dir.$name."/template.info.php");
		$tpl = new template_parser( '../templates/template_thumbnail.tpl.php' );
		$tags = array(
				'{TEMPLATE_NAME}' 		=> $template_name,
				'{CREATED_BY}' 			=> 'Created by',
				'{TEMPLATE_AUTHOR}'		=> $template_author,				
				'{TEMPLATE_STYLESHEET}'	=> $template_stylesheet,
				'{LINK_THUMBNAIL}' 		=> $template_large_preview,
				'{SRC_THUMBNAIL}' 		=> 'themes/'.$template_thumbnail,
				);
		$tpl->parse_template( $tags );
		print $tpl->display();
		$k++;
		if($k==($view_start+9))break;
	}
  }	
}while($name = readdir($dir));
closedir();				

?>