<link rel="stylesheet" href="../templates/admin2.css" >
<form name="login" action="{LOGIN_URL}" method="post">
<table width="435" border="0"  align="center" cellpadding="5" cellspacing="1" class="tlogin" >
  <tr>
    <td width="166" height="95"><div align="center"><img src="../admin/images/security.png" width="64" height="64" /></div></td>
    <td colspan="2"><h1 class="tcaptions">{TITLE}</h1> </td>
    </tr>
  <tr>
    <td rowspan="3"><span class="tnotes">{DESCRIPTION} </span></td>
    <td height="31">{USERNAME}</td>
    <td><input type="text" name="username" value= "{POST_USERNAME}" /></td>
  </tr>
  <tr>
    <td width="87" height="31">{PASSWORD}</td>
    <td width="146"><input type="password" name="password" /></td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td><input type="submit" name="submit" value="{SUBMIT}" class="" /></td>
  </tr>
</table>

</form>