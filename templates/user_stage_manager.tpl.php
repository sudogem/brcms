<div id="panel">
<form name="users" method="post" action="index.php?option=user_stage_manager&task=save">
	<div id="toolbar_panel">
		<div id="toolbar_btn">
		<a href="index.php?option=user_stage_manager&task=save" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','../admin/images/save_f2.png',1)"><img src="../admin/images/save.png" name="Image1" width="32" height="32" border="0">Save</a>
		</div>
		<div id="toolbar_btn">
		<a href="index.php?option=user_stage_manager&task=close" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','../admin/images/cancel_f2.png',1)"><img src="../admin/images/cancel.png" name="Image2" width="32" height="32" border="0">Close</a>
		</div>
	</div>

<h1 class="asterisk">User Stage Manager </h1>
<table width="100%" border="0" cellpadding="4" cellspacing="1" class="ctable" >
  <tr class="table_header"  align="center">
    <td width="11%">{NAME}</td>
    <td width="15%">{GROUP}</td>
    <td width="12%">{WRITING}</td>
    <td width="13%">{EDITING}</td>
    <td width="22%">{PROOFREADING}</td>
    <td width="18%">{PUBLISHING}</td>
  </tr>
  {TABLE_DATA}
</table>
</form>
</div>
