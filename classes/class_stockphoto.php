<?php

class stockphoto extends database {
	var $imageID;
	function stockphoto() {
		$this->database();
	}
	
	function addNewImage( $filename, $photoby, $caption, $alt ){
		$sql = " insert into stockphotos( image_filename, image_photographer_author, image_captions, image_alttext)
		         values('$filename', '$photoby', '$caption', '$alt' )";
		$this->query( $sql );
		$this->imageID = $this->insertID;
		$this->filename = $filename;
	}
	
	function getImageDetails( $imgID ){
		$sql = "select * from stockphotos where imageID= '$imgID' ";
		$this->query( $sql );
		$imgdetails = array();
		while( $imgdetails[] = $this->fetcharray());
		$this->freeresult();
		return $imgdetails;
	}
	
	function removeImage( $image_filename ) {
		$sql = " select * from corporate_partners_imgs where banner_imageurl='$image_filename' ";
		$this->query( $sql );
		while ( $image[] = $this->fetcharray() );
		$n = $this->getnumrows();
		for( $i=0; $i<$n; $i++ ) {
			$imgID = $image[$i]->imageID;
			$sql = " delete from corporate_partners_imgs where imageID='$imgID' ";
			$this->query( $sql );
			$sql = " delete from stockphotos where imageID='$imgID' ";
			$this->query( $sql );
		}
	}	
	
	function updateImage( $imageID, $filename, $photoby, $caption, $alt ) {
		$sql = " update stockphotos ";
		$sql .= "		 set image_photographer_author = '$photoby' ,";
		if ( $filename != "" ) {
			$sql .= "		 image_filename = '$filename', ";		
		}
		$sql .= "		 image_captions = '$caption' , ";
		$sql .= "		 image_alttext = '$alt' ";
		$sql .= "		 where imageID= '$imageID' ";
		$this->query( $sql );				
	}

	function insertImageToArticle( $articleID ) {
		$imageID = $this->imageID;
		$sql = " insert into article_imgs( articleID, imageID ) 
				values( '$articleID', '$imageID' )	
		";
		$this->query( $sql );
	}
		
	function addImageToArticle( $imagesets, $articleID ) {
		if ( is_array( $imagesets ) ) {
			foreach( $imagesets as $key => $value ) {
				$sql = " insert into article_imgs( articleID, imageID ) 
						values( '$articleID', '$value' )";
				$this->query( $sql );
			}
		}
	}

	function notshowArticle_image( $imagesets, $articleID ){
		if ( is_array( $imagesets ) ) {
			foreach( $imagesets as $key => $value ) {
				$sql = " update article_imgs ";				
				$sql .= " set show_image = 0 ";
				$sql .= " where articleID = " . $articleID;
				$this->query( $sql );
			}
		}
	}
	
	function showArticle_image( $imagesets, $articleID ){
		if ( is_array( $imagesets ) ) {
			foreach( $imagesets as $key => $value ) {
				$sql = " update article_imgs ";				
				$sql .= " set show_image = 1 ";
				$sql .= " where imageID = " . $value;
				$this->query( $sql );
			}
		}
	}

	function updateArticleImagesets( $imagesets, $articleID ) {
		if ( is_array( $imagesets ) ) {
			foreach( $imagesets as $key => $value ) {
				$sql = " update article_imgs ";				
				$sql .= " set articleID = " . intval( $articleID );
				$sql .= " where article_imgID = " . $value;
				$this->query( $sql );				
			}
		}
	}
	
	function addImageToClient( $clientID ){
		$imageID = $this->imageID;
		$filename = $this->filename;
		$sql = " insert into corporate_partners_imgs( banner_clientID, banner_imageurl, imageID ) 
				values( '$clientID', '$filename', '$imageID' ) ";
		$this->query( $sql );
		$this->insertclientID = $this->insertID;
	}
	
	function updateBannerClient( $bid ) {
		$imageID = $this->imageID;
		$filename = $this->filename;
		$sql = "update corporate_partners_imgs 
				set banner_imageurl = '$filename' ,
				imageID = '$imageID'
				where bannerID='$bid' ";
		$this->query( $sql );				
	}
}

?>