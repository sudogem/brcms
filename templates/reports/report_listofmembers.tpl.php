<div id="toolbar_panel">
	<div id="toolbar_btn">
	<a href="javascript:void window.open('{LINK}', 'report_listofmembers', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/preview_f2.png',1)"><img src="../admin/images/preview.png" name="Image3" width="32" height="32" align="absmiddle" border="0">Preview</a>
	</div>
</div>
<table width="100%" border="0" cellpadding="4" cellspacing="0" class="ctable2">
<h1 class="asterisk">{RPT_HEADER}</h1>						
  <tr class="table_header">
	<td width="2%" class="tdcaptions">#</td>
	<td width="16%" class="tdcaptions">{FULLNAME}</td>
	<td width="12%" class="tdcaptions">{USERNAME}</td>	
	<td width="8%" align="left" class="tdcaptions">{IS_ENABLED}</td>		
	<td width="10%" class="tdcaptions">{GROUP}</td>
	<td width="10%" class="tdcaptions">{EMAIL}</td>
	<td width="25%" class="tdcaptions">{PHONENO}</td>
  </tr>
  {TABLE_DATA}
	  <tr>
	  <td colspan="100%" align="center" class="missingfield">{RESULT_MSG}</td>
	  </tr>
		<tr class="table_header">
		<td colspan="100%" id="paging"  class="tdcaptions" align="center">{PAGELINK}&nbsp;</td>
		</tr>
</table>