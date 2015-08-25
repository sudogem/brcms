<?php
class document_generator extends template_parser {
	function document_generator( $template ) {
    	//generate the headers to help a browser choose the correct application
    	header( 'Content-type: application/msword' );
    	header( 'Content-Disposition: inline, filename=untitled.doc');
		$this->template_parser( $template );
		
	}
	
	function doc_tags( $tags = array() ){
		$this->parse_template( $tags );
	}
	
}
?>