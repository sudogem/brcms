<link rel="stylesheet" href="../templates/login.css" >
<body>
<div id="login_header">
</div>
<div id="login_container">
<form name="login" action="{LOGIN_URL}" method="post">
<div align="center">
<div id="login">
	<div id="login_desc">
	  <div align="center"><img src="../admin/images/security.png" width="64" height="64" /><br>
      </div>
	  	    Use a valid username and password to gain access to the administration console.
	</div>
				<p class="tcaptions">Welcome to El Nuevo Bantay Radyo WCMS</p>

	<div id="login_txtbox">
			<div class="clear"></div>
		<label><b>Username:</b></label><input type="text" name="username" value= "{POST_USERNAME}" /><br><br>
		<label><b>Password:</b></label><input type="password" name="password" />
		<div class="clear">&nbsp;</div>
		<input type="submit" name="submit" value="Submit" class="login_btn" />
		<input type="submit" name="cancel" value="Cancel" class="login_btn" />
		
	</div>
	<div class="clear"></div>
</div>
</div>
</form>
</body>