<?php 
	require( '../../admin/coreclass.php' );
	session_start();
	$imagesets = array();
	$file_type = $_FILES['userfile']['type'];
	$tmp_file_name = $_FILES['userfile']['tmp_name'];
	$file_name = $_FILES['userfile']['name'];
	$uploaddir = '../'.$upload_dir;
	$photoby = $_POST['photoby'];
	$caption = $_POST['caption'];
	$alttext = $_POST['alttext'];
	$msize = ini_get( 'post_max_size' );
	$max_file_size = $msize;

	if ( isset( $_FILES ) && isset( $_POST['fileupload']) ) {
		$upload = new upload_image( $file_type, $tmp_file_name, $file_name, $uploaddir, $max_file_size );
		$upload->upload();
		$upload->get_upload_directory();
		$upload->get_message();
		$filename = $upload->get_uploaded_file();
		$photo = new stockphoto;
		$photo->addNewImage( $upload->upload_dir . $upload->file_name , $photoby, $caption, $alttext );
		$photo->insertImageToArticle( $_SESSION['articleID']);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Upload Image</title>
</head>
<body>
<link rel="stylesheet" href="../../templates/admin2.css" type="text/css" />
<table class="adminform" >
  <form method="post" action="uploadimage4.php" enctype="multipart/form-data" name="filename">
    <tr class="table_header">
      <th colspan="2" class="tdcaptions" >Upload Image : <?php echo $directory; ?></th>
    </tr>
    <tr>
      <td width="81" align="left"  class="caption2">Filename :</td>
      <td width="218">
        <input  class="inputbox"   name="userfile" type="file" />
</td>
    </tr>
    <tr>
      <td align="left"  class="caption2">Photo by:</td>
      <td align="left">
        <input name="photoby" type="text" class="inputbox" size="30" />
      </td>
    </tr>
	
    <tr>
      <td valign="top"  class="caption2">Caption :</td>
      <td><textarea class="inputbox"  cols="32" name="caption" rows="10"></textarea></td>
    <tr>
      <td  class="caption2">Alt text: </td>
      <td><input class="inputbox" name="alttext" type="text" size="30"/></td>
    <tr>
      <td>&nbsp;</td>
      <td>
        <input class="button" type="submit" value="Upload" name="fileupload" />
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
