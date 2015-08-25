<?php
require ( 'coreclass.php' );

session_start();

// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: login.php');
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Upload a file</title>
</head>
<body>
<link rel="stylesheet" href="../templates/<?php echo $css; ?>/css/template_css.css" type="text/css" />
<table class="adminform">
  <form method="post" action="uploadimage2.php" enctype="multipart/form-data" name="filename">
    <tr>
      <th width="10" class="title">&nbsp;</th>
      <th width="214" class="title"> Create New Folder</th>
    </tr>
    <tr>
      <td align="center">Folder Name :</td>
      <td align="left"> <input class="inputbox" name="userfile" type="text" />
        <input class="button" type="submit" value="Create" name="fileupload" /> 
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td> Max size = <?php echo ini_get( 'post_max_size' );?> </td>
    <tr>
      <td>&nbsp;</td>
      <td> <input type="hidden" name="directory" value="<?php echo $directory;?>" /> 
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
