<?php
class rotating_images {

	var $javaScript;
	
	function rotate_images( $images = array(), $area = '' ) {
	
		$this->javaScript =	'<script type="text/javascript">
			<!--
				//you may add your image file or text below
		
			var ' . $area . '_ =new Array(); ';
				
				$n = count($images);
				for($i=0; $i < $n; ++$i) {
					if ( checkhttptext( $images[$i]->banner_clickURL )){
						$this->javaScript .= $area . '_[' .$i. ']=' .'"<a href=' . ($images[$i]->banner_clickURL) . '><img src=' ."'" . makeRelativePath($images[$i]->banner_imageurl, 7) ."'". ' border=0></a>"; ';
					}
					else{
						$this->javaScript .= $area . '_[' .$i. ']=' .'"<a href=http://' . ($images[$i]->banner_clickURL) . '><img src=' ."'" . makeRelativePath($images[$i]->banner_imageurl, 7) ."'". ' border=0></a>"; ';
					}
				}
			$this->javaScript .= 'var current=0;
		
			var ns6=document.getElementById&&!document.all;
		
			function changeItem(){
				if(document.layers){
					document.'.$area.'.document.write(' . $area . '_[current])
					document.'.$area.'.document.close()
				}
			
				if(ns6)document.getElementById("' . $area . '").innerHTML='. $area .'_[current]
				{
					if(document.all){
						'. $area .'.innerHTML='. $area .'_[current]
					}
				}
				if (current=='.$n.') { 
					current=0 
				} else { 
					current++ 
				}
				setTimeout("changeItem()",1000)
			}
				window.onload=changeItem
			//-->
		</script>';

	}

	
	function get_javaScript() {
		return $this->javaScript;
	}
}
?>