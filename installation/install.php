<?php
require( '../admin/coreclass.php' );
if ( isset( $_POST['installme'] ) ) {
	$hostname = $_POST['hostname'];
	$dbname = $_POST['dbname'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$con = @mysql_connect( $hostname, $username, $password );
	if (!$con) die(mysql_error());
	$sql = " CREATE DATABASE $dbname ";
	if (!mysql_query($sql)) {
		die("Error:" . mysql_error());
	}
	$sql = " USE $dbname ";
	if (!mysql_query($sql)) {
		die("Error:" . mysql_error());
	}
	
	$file = "brcms.sql";
	$mysql_command = "mysql -h $hostname -u $username $dbname < $file ";
	system( $mysql_command );
	$file = "../classes/class_dbsettings.php";
	$fp = fopen( $file, 'w+' );
	if (!$fp) {
		die("Cannot open the config file:$file.");
	}
	
	$s = "<?php \r\n";
	$s .= "class dbsettings { \r\n";
	$s .= "\r\n// Auto-generated config file. \r\n";
	$s .= "// WARNING: Do not change anything in this file. \r\n\r\n";
	$s .= "var \$dbservername = '$hostname'; \r\n";
	$s .= "var \$dbusername = '$username'; \r\n";
	$s .= "var \$dbpassword = '$password'; \r\n";
	$s .= "var \$databasename = '$dbname'; \r\n";
	$s .= "var \$persistency = false; \r\n";
	$s .= "}\r\n";
	$s .= "?>";
	fwrite( $fp, $s,strlen($s));
	
	$file = "../admin/configuration.php";
	$fp = fopen( $file, 'w+' );
	if (!$fp) {
		die("Cannot open the config file:$file.");
	}
	
	$s = "<?php \r\n";
	$s .= "\r\n// Auto-generated config file. \r\n";
	$s .= "// WARNING: Do not change anything in this file. \r\n\r\n";
	$s .= "\$website = '$website'; \r\n";
	$s .= "\$absolute_path = 'C:/Program Files/Apache Group/Apache2/htdocs/BRWCMS_FINAL/';\r\n";
	$s .= "\$dbservername = '$hostname'; \r\n";
	$s .= "\$dbusername = '$username'; \r\n";
	$s .= "\$dbpassword = '$password'; \r\n";
	$s .= "\$databasename = '$dbname'; \r\n";
	$s .= "\$persistency = false; \r\n";
	$s .= "\$themes_dir = '../themes/'; \r\n";
	$s .= "\$upload_dir = '../images/uploads/'; \r\n";
	$s .= "\$backup_dir = '../backups/'; \r\n";		
	$s .= "?>";
	fwrite( $fp, $s,strlen($s));
	fclose( $fp );
	echo '<script>alert("Successfully installed the WCMS.");history.go(-1);</script>';
	
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Installer</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />
<script type="text/javascript">
	function validate(){
		var f = document.installform;
		if ( f.hostname.value == '' ) {
			alert("Please enter a hostname.");
			f.hostname.focus();
			return false;
		}
		else if( f.dbname.value == "" ) {
			alert("Please enter a database name.");
			f.dbname.focus();
			return false;
		}
		else if ( f.username.value == "" ) {
			alert("Please enter a username.");
			f.username.focus();
			return false;
		}
			return true;
	}
</script>
<body>
<form name="installform" action="install.php" method="post" onSubmit="return validate();" >
  <table width="500" border="0" align="center" class="ctable4">
    <tr>
      <td class="table_header">Installer</td>
    </tr>
    <tr>
      <td class="h2credits">Web Content Management System of El Nuevo Bantay Radyo v1.0 </td>
    </tr>
    <tr>
      <td>Please enter the following fields below. </td>
    </tr>
    <tr>
      <td><b>Note:</b> Be sure that this software was placed in the directory of C:\Program Files\Apache Group\Apache2\htdocs\BRWCMS_FINAL</td>
    </tr>
    <tr>
      <td>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="4%" rowspan="4" class="bold"></td>
            <td width="54%" class="bold"> MYSQL Hostname : <br>
            <span class="data"><em>(This is usually &quot;localhost&quot;)  </em></span>      </td>
            <td width="42%"><span class="bold">
              <input type="text" name="hostname"  class="formtextfield" size="30" value="localhost" >
            </span></td>
          </tr>
          <tr>
            <td class="bold">MYSQL Database Name :<br>
            <span class="bold"><span class="data"><em>(Database name you wish to use. Be sure that the database is created by the admin) </em></span></span></td>
            <td><input name="dbname" type="text" class="formtextfield" size="30" value="brcms"></td>
          </tr>
          <tr>
            <td class="bold">MYSQL Database Username : <br>
            <span class="bold"><span class="bold"><span class="data"><em>(Input either &quot;root&quot; or the username given by the admin.) </em></span></span></span></td>
            <td><input name="username" type="text" class="formtextfield" size="30" value="root"></td>
          </tr>
          <tr>
            <td class="bold">MYSQL Database Password : <br>
            <span class="bold"><span class="bold"><span class="bold"><span class="data"><em>(Simply you must provide a password for that username.) </em></span></span></span></span> </td>
            <td><input name="password" type="text" class="formtextfield" size="30"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" name="installme" class="button" value="Install"></td>
          </tr>
          <tr >
            <td class="table_header" colspan="3">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>