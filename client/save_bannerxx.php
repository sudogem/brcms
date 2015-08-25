<?php
require( '../admin/coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: ../index.php');
}
if (isset($_POST['upload'])){

}
//print_r($_POST);
//print_r($_SESSION);
$clientID = $_SESSION['clientID'];
$insertclientID = $_SESSION['insertclientID'];
$clientname = $_POST['clientname'];
$bannername = $_POST['bannername'];
if ( isset($_POST['imageurl']) ) {
	$imageurl = $_POST['imageurl'];
}

$clickurl = $_POST['clickurl'];
$desc = $_POST['desc'];
$showbanner = $_POST['showbanner'];
$imageID = getImages_info( $imageurl, 'imageID' );

$db = new database;



if (isset($_SESSION['bannerID'])){
	$bannerID = $_SESSION['bannerID'];
	$sql = " update corporate_partners_imgs 
			 set banner_name = '$bannername', 
			 banner_imageurl = '$imageurl' ,
			 banner_clickurl = '$clickurl',
			 banner_description = '$desc'
			 where bannerID = '$bannerID'
			 ";
 	$result = $db->query($sql);
	if( $result ){
		$_SESSION['task'] = 'edit';	
		$_SESSION['title'] = $bannername;
	}
}
else{
	if ( $insertclientID ) { // get the newly uploaded image of the user
		$sql = " update corporate_partners_imgs 
				 set banner_name = '$bannername', 
				 banner_imageurl = '$imageurl' ,
				 banner_clickurl = '$clickurl',
				 banner_description = '$desc'
				 where bannerID = '$insertclientID' ";
		$result = $db->query($sql);	
		if ( $result ) {
			$_SESSION['task'] = 'add';	
			$_SESSION['title'] = $bannername;
			unset( $_SESSION['insertclientID'] );
		}
	}
	else{
		$sql = " insert into corporate_partners_imgs ( imageID, banner_name, banner_clientID, banner_description, banner_imageurl, banner_clickurl)
				values( '$imageID', '$bannername', '$clientID', '$desc', '$imageurl', '$clickurl')";
		if (!($result = $db->query($sql))) {
			die('Error:'.$db->error() );
		}
		if( $result ){
			$_SESSION['task'] = 'add';	
			$_SESSION['title'] = $bannername;
		}
	}
}
header('location: my_banners.php');
?>