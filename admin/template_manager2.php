<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
session_start();
if ( !isset($_SESSION['login'])) {
	header('Location: login.php');
}

if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}

// get the variables view start from the URL GET
(!isset($_GET['view_start'])) ? $view_start = 1: $view_start = $_GET['view_start'];

//$themes_dir = '../'.$themes_dir;
if (!($dir = opendir($themes_dir ))){
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
	//echo $themes_dir.$name . "<br>";
}
// lalaki: love pwd magrewind ta a2 gibuhat ganina...
// babae: cge a2 irewind kay.. e record nako..
rewinddir($dir); 

// get the total directories found..
for( $j=1; $j<=$total_entries; $j=$j+9 ) {
	if ($j==1) { $optvalue = '<option value="test" selected>--- Quick Jump ---</option>';}
	$optvalue .= '<option value="template_manager2.php?view_start='.$j.'">'.$j.' to '.($j+8).'</option>';
}

/* we will dislplay 9 templates at a time */
$k = 1;
// loop it until root directory is found..
/* TODO: hidden files, system files 
and executable files MUST be check to prevent system vulnerabilities..prone to hacking? maybe.. */
while ($name = readdir($dir)){
	if ($name == '.' || $name == '..' ) continue;
	if (is_dir($themes_dir.$name)) {
		if ($k == $view_start || $view_start == 1) break;
		$k++;
	}
}

do {
 if(is_dir($themes_dir.$name)){ // lets check if template is found...
	if (is_file($themes_dir.$name."/template.info.php")){
		include($themes_dir.$name."/template.info.php");
		$k++;
		if($k==($view_start+9))break;
	}
  }	
}while($name = readdir($dir));
closedir();				

include ( 'template.configuration.php' );// LOAD DEFAULT TEMPLATES

// ok girls, lets start compiling now... yeah baby!!!
$tpl = new template_parser( '../templates/template_manager2.tpl.php' );
$tags = array(
		'{TEMPLATE_NAME}' 				=> $default_template_name,
		'{CREATED_BY}' 					=> 'Created by',
		'{TEMPLATE_AUTHOR}' 			=> $default_template_author,
		'{LINK_THUMBNAIL}' 				=> $default_template_large_preview,
		'{SRC_THUMBNAIL}' 				=> $default_template_thumbnail,
		'{VIEW_START_DESC}' 			=> $view_start - 9,
		'{VIEW_START_ASC}' 				=> $view_start + 9,
		'{OPTION_VALUES}' 				=> $optvalue,
		'{ALL_TEMPLATES}' 				=> 'all_site_themes.php',
		'{CURRENT_TEMPLATE}' 			=> 'Current template',
		'{DETAILS_CURRENT_TEMPLATE}' 	=> 'The currently enabled template.',
		'{BROWSE_TEMPLATE}' 			=> 'Browse Templates',
		'{LIST_OF_TEMPLATES}' 			=> 'A list of templates which can use for your website.',
		'{SITENAME}' 					=> 'CMS Adminss',
		'{HEADER}' 						=> ' ',
		'{TOPNAV}' 						=> 'top_menu.php',
		'{FOOTER}' 						=> 'footer.php' 
		);
$tpl->parse_template( $tags );
print $tpl->display();
?>