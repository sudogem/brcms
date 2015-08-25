<?php 
	require( '../../admin/coreclass.php' );
	session_start();
	$imagesets = array();
	
	$get_imgID = $_GET['imgID'];
	if ( isset($_GET['imgID']) ) {
		$photo = new stockphoto;
		$info = $photo->getImageDetails( $get_imgID );
		$file_name2 = $info[0]->image_filename;
		$photoby = $info[0]->image_photographer_author;
		$caption = $info[0]->image_captions;
		$alttext = $info[0]->image_alttext;
	}
	
	$msize = ini_get( 'post_max_size' );
	$max_file_size = $msize;
	
	//print_r($_POST);
	if ( isset( $_POST['fileupload'] )) {
		$post_imgID = $_POST['post_imgID'];
		$photoby = $_POST['photoby'];
		$caption = $_POST['caption'];
		$alttext = $_POST['alttext'];
		$file_type = $_FILES['userfile']['type'];
		$tmp_file_name = $_FILES['userfile']['tmp_name'];
		$file_name = $_FILES['userfile']['name'];
		$uploaddir = '../'.$upload_dir;
		
		if ( $file_name != "" ) { 
			$upload = new upload_image( $file_type, $tmp_file_name, $file_name, $uploaddir, $max_file_size );
			$upload->upload();
			$upload->get_upload_directory();
			$upload->get_message();
			$filename = $upload->get_uploaded_file();
			$photo = new stockphoto;
			$photo->updateImage( $post_imgID, $upload->upload_dir . $upload->file_name, $photoby, $caption, $alttext );
		}
		else{ 
			$photo = new stockphoto;
			$photo->updateImage( $post_imgID, "", $photoby, $caption, $alttext );
			$info = $photo->getImageDetails( $post_imgID );
			$file_name2 = $info[0]->image_filename;
			$photoby = $info[0]->image_photographer_author;
			$caption = $info[0]->image_captions;
			$alttext = $info[0]->image_alttext;
			echo "<script>alert('Successfully saved the image.');window.close();</script>\n";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Image Details</title>
</head>
<body>
<link rel="stylesheet" href="../../templates/admin2.css" type="text/css" />
<table class="adminform" >
  <form method="post" action="edit_imageinfo.php" enctype="multipart/form-data" name="filename">
  	<input type="hidden" name="post_imgID" value="<?php echo $get_imgID;?>" />
    <tr class="table_header">
      <th colspan="2" class="tdcaptions" >Image Details</th>
    </tr>
    <tr>
      <td width="222" align="left"  class="caption2">New Image :</td>
      <td width="255">
        <input class="inputbox" name="userfile" type="file" value="<?php echo $file_name2;?>" />
</td>
    </tr>
    <tr>
      <td align="left" class="caption2" valign="top">Old Image: </td>
      <td width="255">
	  <img src="<?php echo $file_name2; ?>" width="210" height="150"  ></td>
    </tr>
    <tr>
      <td align="left" class="caption2">Photo by:</td>
      <td align="left">
        <input name="photoby" type="text" class="inputbox" size="30" value="<?php echo $photoby; ?>" />
      </td>
    </tr>
	
    <tr>
      <td valign="top" class="caption2">Caption :</td>
      <td><textarea class="inputbox"  cols="32" name="caption" rows="10"><?php echo $caption; ?></textarea></td>
    <tr>
      <td class="caption2">Alt text: </td>
      <td><input class="inputbox" name="alttext" type="text" size="30" value="<?php echo $alttext; ?>"/></td>
    <tr>
      <td>&nbsp;</td>
      <td>
        <input class="button" type="submit" value="Save" name="fileupload" />
        Max size = <?php echo ini_get( 'post_max_size' );?>
      </td>
    <tr>
      <td>&nbsp;</td>
      <td>
        <input type="hidden" name="directory" value="<?php echo $directory;?>" />
      </td>
    </tr>
  </form>
</table>
</body>
</html>
