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
//print_r($_POST);
$bannername = $_POST['bannername'];
$clientnames = $_POST['clientnames'];
$clickurl = $_POST['clickurl'];
$desc = $_POST['desc'];
$bannersize = $_POST['bannersize'];
$impressions_purchased = $_POST['impressions_purchased'];
$totalamount = $_POST['totalamount'];
$amountpaid = $_POST['amountpaid'];
$balance = $_POST['balance'];
$change = $_POST['change'];
$showbanner = $_POST['showbanner'];
$db = new database;



if (isset($_POST['cancel'])) {
		header( 'location: banner_ads_manager.php' );
		exit;
}
//print_r($_POST);
if (isset($_POST['task'])){
	switch( $_POST['task'] ){
		case 'add':
			$sql = "insert into corporate_partners_imgs ( banner_name, banner_clickURL, 
					banner_clientID, banner_description, banner_type, imptotal, 
					banner_show, imptotal_amount, impamount_paid, impbalance, impchange ) 
					values( '$bannername', '$clickurl', '$clientnames', '$desc', '$bannersize' ,
					'$impressions_purchased', '$showbanner', '$totalamount' ,
					'$amountpaid', '$balance', '$change' ) ";	
			if (!($result = $db->query($sql))){
					die('Error:'. $db->error());
			}
			$_SESSION['title'] = $bannername;
			$_SESSION['task'] = 'add';
			// Log the activity
			$action = new activity;
			$action->track_activity( $userID, $action->saving_bannerads, $bannername );
			header( 'location: banner_ads_manager.php' );
			break;
		case 'edit':	
			$bannerID = $_SESSION['bannerID'];
			$sql = "select * from corporate_partners_imgs where bannerID = '$bannerID' ";
			if (!($result = $db->query($sql))){
					die('Error:'. $db->error());
			}
			$ads = array();
			while ( $ads[] = $db->fetcharray() );
			$oldimptotal = $ads[0]->imptotal;
			$oldbalance = $ads[0]->impbalance;
			if ( $db->getnumrows() > 0 ) {
				$impressions_purchased = $impressions_purchased + $oldimptotal;
				$balance = $balance + $oldbalance; // get the old credit balance, sum em up..// we will use this later..
				$sql = "update corporate_partners_imgs 
						set banner_name = '$bannername' ,
						banner_clientID =  '$clientnames' ,
						banner_clickURL = '$clickurl' ,
						banner_description = '$desc' ,
						banner_type = '$bannersize' , 
						banner_show = '$showbanner' , 
						imptotal = '$impressions_purchased' ,
						impbalance = '$balance' 
						where bannerID = '$bannerID' 
						" ;
				if (!($result = $db->query($sql))){
						die('Error:'. $db->error());
				}
				$_SESSION['title'] = $bannername;
				$_SESSION['task'] = 'edit';
			}
			break;	
	}
}
header( 'location: banner_ads_manager.php' );
?>