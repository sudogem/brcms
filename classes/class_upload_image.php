<?php 
class upload_image {
	//define class variables
	var $file_type;					//file type
	var $tmp_file_name;				//temporary file name
	var $file_name;					//file name
	var $upload_dir;				//upload dir
	var $max_file_size;				//file size
	
	var $msg;						//for messaging
	
	function upload_image( $file_type, $tmp_file_name, $file_name, $upload_dir, $max_file_size ) {
		//start instantating class variables
		$this->file_type = $file_type;
		$this->tmp_file_name = $tmp_file_name;
		$this->file_name = $file_name;
		$this->upload_dir = $upload_dir;
		$this->max_file_size = max_file_size;
	}	
	
	//get upload directory
	function get_upload_directory() { 
    	$upload_dir = trim($this->upload_dir); 
		
		//test if upload directory has a value
    	if ($upload_dir) { 
        	$ud_len = strlen($upload_dir); 
        	$last_slash = substr($upload_dir,$ud_len-1,1); 
            	
				//check if upload dir ends with /	
				if ($last_slash <> "/") { 
                	$upload_dir = $upload_dir."/"; 
            	} else { 
                    $upload_dir = $upload_dir; 
            	} 
			
			//open the directory
        	$handle = @opendir($upload_dir); 
            
			//test if directory exist
			if ($handle) { 
                $upload_dir = $upload_dir; 
                closedir($handle); 
            } else { 
                $this->msg = "ERROR: Directory <strong>Does not exist.</strong>"; 
				$upload_dir = "ERROR";
            } 
    	} else { 
        	$this->msg = "ERROR: No <strong>Upload Directory</strong> passed"; 
			$upload_dir = "ERROR";
    	} 
    	return $upload_dir;
	} 
	
	//check if file already existed on the upload directory
	function existing_file() { 
    	
		$file_name = trim($this->file_name); 
    	$upload_dir = $this->get_upload_directory(); 

    	if ($upload_dir == "ERROR") { 
        	$this->msg = "There was on reading the directory. <br> The error was: ".$this->get_message();
    	} else { 
        	$file = $upload_dir . $file_name; 
        		if (file_exists($file)) { 
            		//$this->msg = "Error: File already existed on the directory."; 
					echo "<script> alert('Image $file_name already exists.'); window.history.go(-1);</script>\n";
					exit();					
        		} else { 
            		return false; 
        		} 
    	}     
	} 
	
	//function to upload the file
	function upload() {
		if ( strlen($this->file_name) > 21 ) {
			echo "<script>alert('The filename must not exceed to 20 characters long. '); window.history.go(-1);</script>\n";
			exit;
		}
  		// Does the file have the right MIME type?
  		if ((( $this->file_type == 'image/x-png') | ($this->file_type == 'image/pjpeg') | ($this->file_type == 'image/bmp') | ($this->file_type == 'application/x-shockwave-flash')) | 
			(( $this->file_type == 'image/gif') |  ( $this->file_type == 'image/png')) | ($this->file_type == 'image/jpeg') ) {
    		$this->msg = 'File Accepted for Uploading. <strong>'.$this->file_type.'</strong>' ; 
		
			if(!$this->existing_file()) {
  				// put the file where we'd like it
  				$upfile = $this->upload_dir.$this->file_name;
		
				//upload file
  				if (is_uploaded_file($this->tmp_file_name)) {
     				if (!move_uploaded_file($this->tmp_file_name, $upfile)) {
       					$this->msg =  'Problem: Could not move file to destination directory <strong>'.$this->upload_dir.'</strong>';
     				}
  				} else {
    				$this->msg =  'Problem: Possible file upload attack. Filename:<strong> '.$this->file_name.'</strong>';
  				}
			} else {	
				return $this->get_message();
				exit;
			}
		} else {
			//$this->msg = 'Error: File is not an image file <strong>'.$this->file_type.'</strong>';
			echo "<script>alert('The file must be gif, png, jpg, jpeg, bmp '); window.history.go(-1);</script>\n";
			exit();			
		}
	}	//end of function
	
	function get_uploaded_file() {
		$up_file = $this->get_upload_directory();
		if($up_file == "ERROR") {
			return $this->get_message().$upfile;
		} else {
			echo "<script>alert('Upload of $this->file_name to $this->upload_dir successful!!');</script>\n";
			
			return $up_file.$this->file_name;
		}
	}
	
	//this function is for troubleshooting only
	function display() {
		echo '<br>File Type: '.$this->file_type;
		echo '<br>Temp File Name: '.$this->tmp_file_name;
		echo '<br>File Name: '.$this->file_name;
		echo '<br>Upload Dir: '.$this->upload_dir;
		echo '<br>Max File Size: '.$this->max_file_size;
	}
	
	function get_message() {
		return $this->msg;
	}
}// end of class
?>