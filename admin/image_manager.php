<?php
include( 'configuration.php' );
require ( 'coreclass.php' );
include ('resizer.php');
session_start();

// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: login.php');
}

if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
	$usertype = $_SESSION['usertype'];
}
$db = new database;




$images_dir = '../images/ads/';
if (!($dir = opendir($images_dir ))){
	echo "<div class=\"msgboxError\">";	
	echo "<br>Sorry, the images directory is not found";
	echo "<br>Please try again later.";
	echo "<div align=\"center\"><a href=\"index.php\">Back to Home</a></div>";
	echo "</div>";
	return;
}

$viewby = $_POST['view'];
$clientID = $_POST['cp'];
//print_r($_POST);

if ( isset($_POST['submit'])) {
	switch( $viewby ) {
		case 'uploads':
			$sql = " select * from stockphotos";	
			break;
		case 'cpartners':
			$sql = " select * from corporate_partners_imgs ";
			$sql .= " where banner_clientID= " . intval($clientID);
			break;
		default :	
			break;
	}
	if (!($result = $db->query($sql))){
			die('Error:'. $db->error());
	}
	$cpimgs = array();
	while( $cpimgs[] = $db->fetcharray());
	// display images by uploads... 
	if ( $viewby == 'uploads' ) {
		for( $i= 0; $i < count($cpimgs)-1; $i++ ) {
			foreach( $cpimgs as $imageID => $imagename ) {
				if ( $imageID == 'imageID' ) {
					$dir_images .= '<div class = "xpthumbnail2">';
					$dir_images .= '<a href="' . $cpimgs[$i]->imageID . '">';
					$imageurl = makeRelativePath($cpimgs[$i]->image_filename, 4);
					$imageID = $cpimgs[$i]->imageID;
					$dir_images .= "<a href = \"javascript:openPopup('preview_image_details.php?imageID=$imageID' ,'1024x768','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=200,height=200')\">";
					$dir_images .= '<div class="center"><img src="' . $imageurl . '" width="50" height="65" border="0" alt ="' . $file . '"></div>';
					$dir_images .= '</a>';
					$dir_images .= '<br>'.makeRelativePath( $imageurl, 6);
					$dir_images .= '<br><a href="delete_image.php?imageID=' . $cpimgs[$i]->imageID . '" ><img src="../admin/images/edit_trash.gif" border="0"></a>';
					$dir_images .= '</div>';
				}
			}
		}
	}
	// display images by corporate partners.. 
	if ( $viewby == 'cpartners' ) {
		for( $i= 0; $i < count($cpimgs)-1; $i++ ) {
			foreach( $cpimgs as $imageID => $imagename ) {
				if ( $imageID == 'bannerID' ) {
					$dir_images .= '<div class = "xpthumbnail2">';
					$dir_images .= '<a href="' . $cpimgs[$i]->banner_imageurl . '">';
					$imageurl = makeRelativePath($cpimgs[$i]->banner_imageurl, 4);
					$dir_images .= "<a href = \"javascript:openPopup('$imageurl','1024x768','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=200,height=200')\">";
					$dir_images .= '<div class="center"><img src="' . $imageurl . '" width="50" height="65" border="0" alt ="' . $file . '"></div>';
					$dir_images .= '</a>';
					$dir_images .= '<br>'.makeRelativePath($imageurl, 6);
					$dir_images .= '<br><a href="delete_image.php?imageID=' . $cpimgs[$i]->imageID . '" ><img src="../admin/images/edit_trash.gif" border="0"></a>';
					$dir_images .= '</div>';
				}
			}
		}
	}
}
else{
	$sql = " select * from stockphotos";	
	if (!($result = $db->query($sql))){
			die('Error:'. $db->error());
	}
	$cpimgs = array();
	while( $cpimgs[] = $db->fetcharray());
	for( $i= 0; $i < count($cpimgs)-1; $i++ ) {
		foreach( $cpimgs as $imageID => $imagename ) {
			if ( $imageID == 'imageID' ) {
				$dir_images .= '<div class = "xpthumbnail2">';
				$dir_images .= '<a href="' . $cpimgs[$i]->imageID . '">';
				$imageurl = makeRelativePath($cpimgs[$i]->image_filename, 4);
				$dir_images .= '<a href="#" border="0"  onClick=popupWindow("' . "$imageurl" . '",' . "$i" . ',530,350,"yes","yes");><br>';
				$parts = pathinfo( $imageurl );
				switch( $parts["extension"] ){
					case 'swf':
						$dir_images .= '<div class="center"><img src="images/swf_16.png" border="0" align="middle" ></div>';					
						break;
					default:
						$dir_images .= '<div class="center"><img src="' . $imageurl . '" width="50" height="65" border="0" alt ="' . $file . '"></div>';					
						break;	
				}
				$dir_images .= '</a>';
				$dir_images .= '<br>'.makeRelativePath( $imageurl, 6);
				$dir_images .= '<br><a href="delete_image.php?imageID=' . $cpimgs[$i]->imageID . '" ><img src="../admin/images/edit_trash.gif" border="0"></a>';
				$dir_images .= '</div>';
			}
		}
	}
}

/**
 * Populate all the corporate partners into an array..
 */
$sql = " select * from corporate_partners ";
if (!($result = $db->query($sql))){
		die('Error:'. $db->error());
}
$cp = array();
while( $cp[] = $db->fetcharray());
$corporate_partners = '';
foreach( $cp as $field => $data ) {
	$corporate_partners .= '<option value="' . $data->clientID . '">';
	$corporate_partners .= $data->clientname;
	$corporate_partners .= '</option>';
}

// start generating page
$tpl = new template_parser( '../templates/image_manager2.tpl.php' );
// TODO: 
// Put all the site variables here and its metadata like STYLESHEETS, SITENAME, ETC...
$tags = array(
		'{DIR_IMAGES}'	=> $dir_images,
		'{CP}'			=> $corporate_partners,
		'{GET_DIR}'		=> $getdir,	
		'{SITENAME}' 	=> 'CMS Adminss',
		'{HEADER}' 		=> '&nbsp;',
		'{TOPNAV}' 		=> 'top_menu.php',
		'{FOOTER}' 		=>  'footer.php' 
		);
//print_r($tags);		
$tpl->parse_template( $tags );
print $tpl->display();
?>