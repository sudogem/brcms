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

				$query  = "SELECT poll_topic.* FROM poll_topic"; 
				$query .= " WHERE  poll_topic.topic_date = '$date' OR '$date' BETWEEN poll_topic.topic_date AND poll_topic.expiry_date ";
							
				$rs = mysql_query($query) or die('Error On Query> <br>Error: '.mysql_error());	//perform query to the databas
				$data = mysql_fetch_assoc($rs);		//get individual data
				
				print_r($data);
				//get labels and display them individually	
				$label = explode(',', $data['response_label']);
				echo '<br>';
				print_r($label);
			}
		}
?>

<!-- Display Poll Topic in HTML format here -->
<pre>
	<strong>Topic:</strong> <?php echo $data['topic']?>
	<br>
	<strong>Click on your response Here:</strong>
		<form name="form1" method="post" action="save_poll_response.php">
		<input type="hidden" name="topic_id" value="<?php echo $data['topic_id']; ?>">
			<?php 
				for($i=0; $i<count($label); ++$i) {
					echo '&nbsp;&nbsp;<label><input type="radio" name="response" value="'.$label[$i].'">'.$label[$i].'</label>';
				}
			?>
			<br>
			<input type="submit" value="Go"><input type="reset" value="Cancel">
    		<!-- label><input type="radio" name="response" value="radio">Radio</label -->
		</form>
</pre>


