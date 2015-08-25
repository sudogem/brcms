<?php
include( 'configuration.php' );
require ( 'coreclass.php' );

	$tpl = new template_parser( '../templates/lostpassword.tpl.php' ); 
	$tags = array (
		'{URL}'	=>	' sendpassword.php'
	);
	
  	$tpl->parse_template( $tags );
	print $tpl->display();
?>