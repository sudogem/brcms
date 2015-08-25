<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="admin.css" />
 
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>

<script type="text/javascript" language="javascript1.2" src="../Editor/editor.js" ></script>
<link rel="stylesheet" type="text/css" href="../templates/admin.css" />

</head>

<body>
	<div id="wrapper">
		<div id="container">
			<div id="header">
				{HEADER}
			</div>
			<div id="topnav">
				{TOPNAV}
			</div>
			<div id="sidenav">
				{SIDENAV}
			</div>
			<div id="content">

<form method="post" onSubmit="editor.prepareSubmit()" action="../Editor/save.php">
	<!-- Define ID placeholder -->
	<?php 
		// if the task is edit..den lets get the request articleid
		if ( $_GET['task'] == 'edit' ) { 
	?>
	<input type="hidden" name="articleID" value="<?php echo $_REQUEST['articleID']; ?>">
	<?php
		}
	?>
	<input type="hidden" name="userID" value="<?php echo $_SESSION['userID']?>">
	<input type="hidden" name="stageID" value="1" >
	<input type="hidden" name="task" value="save" >
	<!-- Patch Some PHP Code Here (Temporary Code) -->
	
	<?php 
		if(isset($_REQUEST['articleID'])) {
			$content = $data['article_body'];			
			$content=addslashes(preg_replace('`[\r\n]`','\n',$content));
		} else {
		
		}
	?>

	<br>
	
	<!-- Article Information -->
	<table width="556">
		<tr>
			<td width="101"><strong>Article Title:</strong></td> 
			<td width="443"><input name="title" value="" size="50"></td>
		</tr>
	
		<tr>
			<td><strong>Category:</strong></td>      
			<td>
			<!--<input name="category" value=""> -->
			<select name="category">
				<option value="x">Select Category</option>
			</select> 
			</td>
		</tr>
	
		<tr>
			<td><strong>Date Written:</strong></td>  
			<td>{DATE_WRITTEN}</td>
		</tr>
	
		<tr>
			<td><strong>Date Edited</strong></td>
			<td><?php echo date('m').'/'.date('d').'/'.date('Y'); ?></td>
		</tr>
	</table>
	
	<br>
	
	<center>
		<!-- The Editor-->
		<script type="text/javascript">
			var editor = new WYSIWYG_Editor('editor', '<?php echo $content; ?>' );
			editor.display();
		</script>
	</center>
</form>
			</div>
		</div>
	<div class="clear">&nbsp;</div>
	<div id="footer">
		{FOOTER}
	</div>	
		
	</div>
		
</body>
</html>
