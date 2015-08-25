<?php 

	include('coreclass.php');
	
	//this function returns the user stage 
	function get_user_stage( $user_id) {
		
		$con = new database();
		
		$query = "SELECT user_stage.stageID, content_users.* 
				  FROM user_stage, content_users 
				  WHERE user_stage.userID = content_users.userID
				  AND content_users.userID = '$user_id'";
		
		$result = $con->query($query);
		$stage_id = mysql_fetch_assoc($result);
		return $stage_id['stageID'];
	}
	
	function get_user_data( $user_id) {
		
		$con = new database();
		
		$query = "select * from content_users where userID = '$user_id'";
		$result = $con->query($query);
		$data = mysql_fetch_assoc($result);
		return $data;
	}
	
	//this function returns the writer's articles
	function get_writer_articles( $user_id ) {
		
		$con = new database();
		$query = "select articles.articleID, articles.stageID, 
					 		articles.title, articles.created from articles where articles.userID = '$user_id'";
				  
		$page = new Pager($query, 'navlist', '../templates/data_table.tpl.php');
		
		return $page->display_record($_GET['page']);
	}
	
	function get_all_articles() {
	
		$con = new database();
		$query = "select articles.articleID, articles.stageID, articles.title, articles.created from articles";
		$page = new Pager($query, 'navlist', '../templates/data_table.tpl.php');
		
		return $page->display_record($_GET['page']);
	}
	
	//function returns the article detaisl
	function get_article_details( $article_id ) {
				
		$query = "select * from articles where articleID = '$article_id'";
		$con = new database();
		$result = $con->query($query);
		
		if($result) {
			$data = mysql_fetch_assoc($result);
			return $data;
		} else {	
			return mysql_error();
		}
	}
	
	//retrueve common menu
	function create_common_menu() {
	
		$menu = '';
		
		$query = "select * from common_menu";
		$con = new database();
		
		$result = $con->query($query);
		
		if(!$result) {
			$menu.=mysql_error();
		} else {
			while($data = mysql_fetch_assoc($result)) {
				$menu.='<a href="'.$data['menu_link'].'">'.$data['menu_name'].'</a>&nbsp;&nbsp;|';
			}	
		}
		//this link is temporary
		//$menu .='</li>';
		return $menu;
	}
	
	//retrieve user specific menu
	function user_specific_menu() {
		$menu = '';
		
		$query = "select * from user_menu";
		$con = new database();
		$result = $con->query($query);
		if(!$result) {
			$menu.=mysql_error();
		} else {
			while($data = mysql_fetch_assoc($result)) {
				$menu.='<li><a href="'.$data['menu_link'].'">'.$data['menu_name'].'</a></li>';
			}	
		}
		return $menu;
	}	
?>