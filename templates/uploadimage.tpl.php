<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Upload a file</title>
</head>
<body>
<link rel="stylesheet" href="../templates/<?php echo $css; ?>/css/template_css.css" type="text/css" />
<table class="adminform">
  <form method="post" action="uploadimage.php" enctype="multipart/form-data" name="filename">
    <tr>
      <th class="title"> File Upload : <?php echo $directory; ?></th>
    </tr>
    <tr>
      <td align="center">
        <input class="inputbox" name="userfile" type="file" />
      </td>
    </tr>
    <tr>
      <td align="center">
        <input class="inputbox" name="userfile" type="file" />
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
