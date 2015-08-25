<script type="text/javascript">
	
	function confirmSubmit() {
		//return false;
		
		if(confirm("Are you sure you want to submit your comments / feedbacks?")) {
			if((document.feedback_form.username.value == "") || (document.feedback_form.feedback.value == "")) {
				alert("Ooops! The Name field and the Feedback Field should contain data.!");
				return = false;
			} else {
				return true;
			}
		}
	}
	
	function confirmReset() {
	}
</script>


<form method="post" action="feedback.php" name="feedback_form" onSubmit="confirmSubmit();">
	<table id="feedback">
		<tr>
			<td>Name: </td>
			<td><input type="text" name="username"></td>
		</tr>
		
		<tr>
			<td>Email Address: </td>
			<td><input type="text" name="emailAddress"></td>
		</tr>
		
		<tr>
			<td>Feedbacks / Comments: </td>
			<td><textarea name="feedback" cols="40" ></textarea></td>
		</tr>
		<tr>
			<td><input type="submit" value="Submit Feedback / Comments" name="submit"></td>
			<td><input type="reset" value="Cancel And Clear Fields" name="reset"></td>
		</tr>
			
	</table>
</form>	
