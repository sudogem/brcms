<?php
include( 'configuration.php' );
require ( 'coreclass.php' );

	$tpl = new template_parser( '../templates/login3.tpl.php' ); 
	$tags = array (
	  '{TITLE}' => 'Welcome to El Nuevo Bantay Radyo WCMS ',
	  '{DESCRIPTION}' => 'Use a valid username and password to gain access to the administration console.',
	  '{USERNAME}' => 'Username:',
	  '{POST_USERNAME}' => $username,
	  '{PASSWORD}' => 'Password:',
	  '{SUBMIT}' => 'Submit',
	  '{LOGIN_URL}' => 'check_login.php'
	);
	
  	$tpl->parse_template( $tags );
	print $tpl->display();
?>