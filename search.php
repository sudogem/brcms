<?php 
	function con() {	
		$con = mysql_connect('localhost', 'root', '');
		if(!$con) {
			echo 'Error Connecting to Database Server. <br>The Error Was: '.mysql_error();
		} else {
			$db_con = mysql_select_db('brcms',$con);
				if(!$db_con) {
					echo 'Error Connecting to Databse. <br>The Error was: '.mysql_error();
				} 
		}
	}
	
	function search_split_terms($terms) {
		$terms = preg_replace("/\"(.*?)\"/e", search_transform_term('\$1'), $terms);
		$terms = preg_split("/\s+|,/", $terms);
		$out = array();
	
		foreach($terms as $term) {
			$term = preg_replace("/\{WHITESPACE-([0-9]+)\}/e","chr(\$1)", $term);
			$term = preg_replace("/\{COMMA\}/", ",", $term);
			$out[] = $term;
		}
	return $out;
	}

	function search_transform_term($term) {
		$term = preg_replace("/(\s)/e", "'{WHITESPACE-'.ord('\$1').'}'", $term);
		$term = preg_replace("/,/",	"{COMMA}", $term);
	return $term;
	}

	function search_escape_rlike($string) {
		return preg_replace("/([.\[\]*^\$])/", '\\\$1',$string);
	}

	function search_db_escape_terms($terms) {
		$out = array();
	
		foreach($terms as $term) {
			$out[] = '[[:<:]]'.addslashes(search_escape_rlike($term)).'[[:>:]]';
			//$out[] = '%'.addslashes(search_escape_rlike($term)).'%';
		}
	return $out;
	}
	
	function search_rx_escape_terms($terms) {
		$out = array();
	
		foreach($terms as $term) {
			$out[] = '\b'.preg_quote($term, '/').'\b';
		}
	return $out;
	}

	//this function actually searches the keywords table
	//returns an array of id number
	function search_keyword($terms) {
		con();
		
		$terms = search_split_terms($terms);
		$terms_db = search_db_escape_terms($terms);
		$terms_rx = search_rx_escape_terms($terms);
		$parts = array();
				
		foreach($terms_db as $term_db) {
			$parts[] = "article_keywords.keywords RLIKE '$term_db'";
		}
		
		//search for similar items on the keywords table
		$parts = implode(' AND ', $parts);
		$sql = "SELECT article_keywords.articleID FROM article_keywords WHERE $parts";
		$rows = array();
		
		//perform query to the database
		$result = mysql_query($sql);
		
		//start fetching results
		if(!$result) {
			return false;
		} else {
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$rows[] = $row;
			}
			//print_r($rows);
			return $rows;		//return array of id numbers
		}
	}

	//search for items on the article_versions table
	function search_item($arrayIDs) {
		con();
		$rs = array();
		
		for($i=0; $i<count($arrayIDs); $i++) {
			//search every item
			$query = "SELECT article_versions.article_versionID, article_versions.articleID, article_versions.title, left(article_versions.article_body, 100) as Summary FROM article_versions WHERE article_versions.articleID = '$arrayIDs[$i]'";
			
			//print($query);
			
			$result = mysql_query($query);
				if(!$result){
					echo mysql_error();;
				} else {
					while($row = mysql_fetch_assoc($result)) {
						$rs[] = $row;
					}
				}
		}
		//print_r($rs);
		return $rs;	//return array or results
	}

	function combine_ids($aArgs) {
		$str='';
		$arr_ids = array();
		for($i=0; $i<count($aArgs); ++$i) {
			$str.= $aArgs[$i]['articleID'].',';
		}
		$arr_ids = explode(",", ereg_replace(",$",'', $str));
		return $arr_ids;
	}
	
	function dumpArray($aArgs) {
		print "<pre>";
			print_r($aArgs);
		print "</pre>";
	}
?>