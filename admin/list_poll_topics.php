<?php 
	$con = mysql_connect( 'localhost', 'root', '' );
		if(!$con) {
			echo 'Error Connecting Database Server: <br> Error: '.mysql_error();
			exit();
		} else {
			$db = mysql_select_db('brcms', $con);
			if(!$db) {
				echo 'Error Connecting Database. <br>Error: '.mysql_error();
				exit();
			} else {

				//get the current date
				$date = date('Y-m-d');

				$query  = "SELECT poll_topic.* FROM poll_topic "; #WHERE poll_topic.topic_date = '$date' "; #BETWEEN poll_topic.topic_date AND poll_topic.expiry_date";
				echo $query;
				
				echo "<br>List of Topics:<br>";
					
				$rs = mysql_query($query);
					if(!$rs) {
						echo mysql_error();
						exit;
					} else {
						while($data = mysql_fetch_assoc($rs)) {
							echo '<br><a href="display_poll_response_interface.php?topic_id='.$data['topic_id'].'">'.$data['topic'].'</a>';
						}
					}
			}
		}
?>