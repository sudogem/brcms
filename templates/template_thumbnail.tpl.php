<div id="templateThumbnail">
        <div id="thumbnailbody">
                <form name="template" method="post" action="update_template.php">
                <h1><b>{TEMPLATE_NAME}</b></h1>
                <h2>{CREATED_BY}: {TEMPLATE_AUTHOR}</h2>
                <div class="thumbnail">
                <a href="javascript:openPopup('../{LINK_THUMBNAIL}','1024x768','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=1000,height=600')"><img src="../{SRC_THUMBNAIL}" alt="" width="180" border="0" ></a>
                </div>
				<input name="Submit" type="submit" value="Use this template" class="btnUseTemplate">
				<input type="hidden" name="editconfig" value="true">
				<input type="hidden" name="template_name" value="{TEMPLATE_NAME}">
				<input type="hidden" name="template_author" value="{TEMPLATE_AUTHOR}">
				<input type="hidden" name="template_stylesheet" value="{TEMPLATE_STYLESHEET}">
				<input type="hidden" name="template_thumbnail" value="{SRC_THUMBNAIL}">
				<input type="hidden" name="template_large_preview" value="{LINK_THUMBNAIL}"> 
                </form>
        </div>
</div>