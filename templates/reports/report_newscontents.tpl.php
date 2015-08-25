<div id="toolbar_panel">
	<div id="toolbar_btn">
	<a href="javascript:void window.open('{LINK}', 'report_newscontents', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','../admin/images/preview_f2.png',1)"><img src="../admin/images/preview.png" name="Image3" width="32" height="32" align="absmiddle" border="0">Preview</a>
	</div>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="4" >
		<h1 class="asterisk">{RPT_HEADER}</h1>						
		<tr class="table_header">
		<td width="1%"  class="tdcaptions">#</td>
		<td width="20%"  class="tdcaptions">{ARTICLE_TITLE}</td>
		<td width="10%"  class="tdcaptions">{CATEGORY}</td>
		<td width="10%"  class="tdcaptions">{AUTHOR}</td>																		
		<td width="12%" class="tdcaptions">{FRONTPAGE}</td>
		<td width="5%"  class="tdcaptions">{STAGEID}</td>
		<td width="17%"  class="tdcaptions">{DATE_CREATED}</td>
		<td width="15%"  class="tdcaptions">{DATE_PUBLISHED}</td>
		</tr>
	  {TABLE_DATA}
	  <tr>
	  <td colspan="100%" align="center" class="missingfield">{RESULT_MSG}</td>
	  </tr>
		<tr class="table_header">
		<td colspan="100%" id="paging"  class="tdcaptions" align="center">{PAGELINK}&nbsp;</td>
		</tr>
	</table>
