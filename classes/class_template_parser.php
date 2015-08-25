<?php 
	// the template parser class

class template_parser {
		
		//define class attribute
		var $output;
		
		function template_parser($template_file) {
			(file_exists($template_file)) ? $this->output = file_get_contents($template_file) : die("Template file: ".$template_file." not found");
		}

		function parse_template($tags = array()){
		//print_r($tags);
			if(count($tags)>0) {
				foreach($tags as $tag=>$data) {
					$data = (file_exists($data)) ? $this->parse_file($data) : $data;
					//$this->output = str_replace( $tag, $data, $this->output);
					$this->output = eregi_replace( $tag, $data, $this->output);
				}
			} else {
				die("Error. No Tags where provided for replacement.");
			}
		}
		
		function parse_file($file) {
			ob_start();
			@include( $file );
			$content = ob_get_contents();
			ob_end_clean();
			return $content;
		}
		
		function display() {
			return $this->output;
		}
		
}
?>