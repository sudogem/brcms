<?php
// current tracks #105: listening my fave MYMP "Mga gagmayg butang.." in english Every little thing
class rotate_banner extends database {
	function rotate_banner( ) {
		//$this->database();
		/*if ( isset($bid) ) {
			$sql = "select * from corporate_partners_imgs where bannerID='$bid' ";
			$this->query($sql);
			if ($this->getnumrows() > 0 ) {
				$sql = "update corporate_partners_imgs set impmade=impmade+1 where bannerID='$bid' ";
				$this->query($sql);
			}
		}*/
	}
	/**
	 * 	Retrieve the banners specified by the bannertype and display it
	 */
	function view_banner( $bannertype ) { 
		$sql = "select * from corporate_partners_imgs where banner_show=1 and banner_type = '$bannertype' ";
		if (!$this->query($sql)) die('Error:' .$this->error());
		$numrows = $this->getnumrows();
		if ( $numrows > 0) {             
			mt_srand( (double) microtime()*1000000 );
			$bannum = mt_rand( 0, --$numrows );			
		}
		else{
			$bannum = 0;
		}
		$sql = "select * from corporate_partners_imgs where banner_show=1 and banner_type = '$bannertype' limit $bannum, 1";
		if (!$this->query($sql)) die('Error:' .$this->error());
		$bannerdata = array();
		$bannerdata = $this->fetcharray();
		if ( $bannerdata ) { // get the banner
			// increment the banner impression 
			$id = $this->row->bannerID;
			$sql = "update corporate_partners_imgs set impmade=impmade+1 where bannerID='$id' ";
			$this->query($sql);
			$sql = "select * from corporate_partners_imgs where banner_show=1 and bannerID='$id' ";
			$this->query($sql);
			$this->fetcharray();
			$imptotal = $this->row->imptotal;
			$impmade = $this->row->impmade;
			// then lets check if this impression is the last one..
			if ( $imptotal == $impmade ) {
				// it means expired na ang banner....dili na cya madisplay sa website..bwahahahah!!! (devil laughs)
				$sql = "update corporate_partners_imgs set banner_show = -1 where bannerID='$id' "; 
				$this->query($sql);
			}
		}
		return $bannerdata;
	}
	/**
	 * Get the clicked bannerID if there is..
	 */
	function getclicks( $bid ) {
		if ( isset($bid) ) {
			$sql = "select * from corporate_partners_imgs  where bannerID = '$bid' and banner_show=1 ";
			$this->query( $sql );
			$this->fetcharray();
			if ( $this->getnumrows() > 0) { // if banner exists..add one clicks..
				$sql = "update corporate_partners_imgs set banner_clicks=banner_clicks+1 where bannerID='$bid' ";
				$this->query( $sql );
				$banner_clickURL = $this->row->banner_clickURL;
				$pat = "http.*://";
				if ( ! eregi( $pat, $banner_clickURL )) {
					$clickurl = "http://$banner_clickURL";
				}
				else{
					$clickurl = $banner_clickURL;
				}
				header( 'location:' . $clickurl  );
			}
		}
	}
	/*
	 * Redirect to the page if the ads was clicked..
	 */
	function redirectclicks(){

	}
}
?>