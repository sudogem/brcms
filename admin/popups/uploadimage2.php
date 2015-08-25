<?php 
	require( '../../admin/coreclass.php' );
	
	session_start();
	$file_type = $_FILES['userfile']['type'];
	$tmp_file_name = $_FILES['userfile']['tmp_name'];
	$file_name = $_FILES['userfile']['name'];
	$upload_dir = '../../images/uploads/';
	$msize = ini_get( 'post_max_size' );
	$max_file_size = $msize;
	
	$photo = new stockphoto;
	if ( isset( $_FILES ) && isset( $_POST['fileupload']) ) {
		$upload = new upload_image( $file_type, $tmp_file_name, $file_name, $upload_dir, $max_file_size );
		$upload->upload();
		$upload->get_upload_directory();
		$upload->get_message();
		$filename = $upload->get_uploaded_file();
		$photo->addNewImage( $upload->upload_dir . $upload->file_name , '', '', '');
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Upload Image</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../../templates/admin2.css" />
<table >
  <form method="post" action="uploadimage2.php" enctype="multipart/form-data" name="filename">
    <tr>
      <th  width="347"   class="fileuploadtitle">  Upload Image: <?php echo $directory; ?></th>
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
