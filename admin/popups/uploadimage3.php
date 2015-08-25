<?php 
	require( '../../admin/coreclass.php' );
	
	session_start();
	// print_r($_SESSION);
	$clientID = $_SESSION['clientID'];// get the clientid
	$bannerID = $_SESSION['bannerID'];
	$file_type = $_FILES['userfile']['type'];
	$tmp_file_name = $_FILES['userfile']['tmp_name'];
	$file_name = $_FILES['userfile']['name'];
	$upload_dir = '../../images/ads/';
	$msize = ini_get( 'post_max_size' );
	$max_file_size = $msize;
	
	// found problem here...
	$photo = new stockphoto;
	if ( isset( $_FILES ) && isset( $_POST['fileupload']) ) {
		$upload = new upload_image( $file_type, $tmp_file_name, $file_name, $upload_dir, $max_file_size );
		$upload->upload();
		$upload->get_upload_directory();
		$upload->get_message();
		$filename = $upload->get_uploaded_file();
		$photo->addNewImage( $upload->upload_dir . $upload->file_name , '', '', '');
		$photo->addImageToClient( $clientID );
		//$photo->updateBannerClient( $bannerID );
		$_SESSION['insertclientID'] = $photo->insertclientID;// Get the newly inserted id
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Upload a file</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../../templates/admin2.css" />
<table >
  <form method="post" action="uploadimage3.php" enctype="multipart/form-data" name="filename">
    <tr>
      <th width="347"   class="fileuploadtitle"> Upload Image: <?php echo $directory; ?></th>
    </tr>
    <tr>
      <td align="center">
        <input  name="userfile" type="file" />
      </td>
    </tr>
	
    <tr>
      <td>
        <input class="button" type="submit" value="Upload" name="fileupload" />
        Max size = <?php echo ini_get( 'post_max_size' );?>
      </td>
    <tr>
      <td>
        <input type="hidden" name="directory" value="<?php echo $directory;?>" />
      </td>
    </tr>
  </form>
</table>
</body>
</html>
        <input type="hidden" name="directory" value="<?php echo $directory;?>" />
      </td>
    </tr>
  </form>
</table>
</body>
</html>
