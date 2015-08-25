<script type="text/javascript" language="javascript" >
	function openpopup(){
		var popurl= "../admin/display_report.php";
		winpops = window.open(popurl,"","width=700,height=600,scrollbars,");
	}
</script>
<form name="form1" method="post" >
<table border="0">
			<tr>
				<td></td>
				<td>Month</td>
				<td>Day</td>
				<td>Year</td>
			</tr>
			<tr>
				<td> From:</td>
				
				<!-- Month -->
				<td>
					<select name="from_month">
					{FROM_MONTH}
					</select>
				</td>
				
				<!-- Day -->
				<td>
					<select name="from_date">		
					{FROM_DAY}
					</select>
				</td>
				
				<!-- Year -->
				<td>
					<select name="from_year">		
					{FROM_YEAR}
					</select>
				</td>
			</tr>
			<tr>
			  <td>To:</td>
			  <td><select name="end_month">
			    
						{FROM_MONTH}
					
		      </select></td>
			  <td><select name="end_date">
			    		
						{FROM_DAY}
					
		      </select></td>
			  <td><select name="end_year">
			    		
						{FROM_YEAR}
					
		      </select></td>
    </tr>
			<tr>
				<td>&nbsp; </td>
				
				<!-- Month -->
				<td>&nbsp;
				</td>
				
				<!-- Day -->
				<td colspan="2"><input type="submit" value="Generate"  class="formbutton"name="submit" onClick="xopenpopup();">&nbsp;
				</td>
				
				<!-- Year -->	
			</tr>
		</table>
</form>

