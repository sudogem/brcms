<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />
<script type="text/javascript" language="javascript">
	function mh(){
		var f = document.adminForm;
		if ( f.subject.value == "" ){
			alert( "You must provide a subject." );
			return false;
		}
		if ( f.description.value == "" ){
			alert( "You must provide a description." );
			return false;
		}
		return true;
	}

</script>

</head>

<body >
	<div id="wrapper">
		<div id="container">
			<div id="header">
				{HEADER}
			</div>
			<div id="topnav">
				{TOPNAV}
			</div>
			<div id="content">
				<div id="outerpanel">
					<div id="panel" >
					<form name="adminForm" method="post" action="save_task.php">
					<div id="toolbar_panel">
					  <div id="toolbar_btn">
								<input type="submit" onClick="return mh();" value="Save" name="save" class="formbutton" >
								<input type="submit" value="Cancel" name="cancel" class="formbutton" >
								<input type="hidden" value="edit" name="task" >
								<input type="hidden" name="boxchecked" value="0" >
								<input type="hidden" value="Not Started" name="status" />
					  </div>
					</div>			
					<h3 class="msginfo">{MESSAGE}</h3>	
						<h1 class="asterisk">Tasks : Edit</h1>
					    <table width="100%" class="ctable" id="tablebgcolor">
							<tr>
							  <td valign="top">							  <table width="100%" class="ctable" id="tdata"  cellspacing="0" border="0"  >
                                <tr class="table_header" >
                                  <th colspan="3" align="left" class="tdcaptions"> Details </th>
                                </tr>
                                <tr>
                                  <td><span class="hsmall">Items marked with a * are required unless stated otherwise.</span> </td>
                                  <td width="1696" rowspan="2" valign="top">
								Kindly select the writer below to assigned the task.
								
								<table width="100%" border="0" cellpadding="4" cellspacing="0" class="ctable2" >
                                      <tr class="table_header2">
                                        <td width="1%" class="">#</td>
                                        <td width="2%" class="">&nbsp;</td>
                                        <td width="15%" class="">FullName</td>
                                        <td width="10%" class="">Status</td>																				
                                        <td width="20%" class="" align="center"># of Task</td>
										<td width="20%" class=""># of Completed task </td>
										<td width="20%" class=""># of Remaining task</td>										
										<td width="20%" class="">Maximum # of task</td>										
                                      </tr>
									{TABLE_DATA}
									<tr class="table_header2">
									  <td colspan="100%" id="paging"  class="" align="center">&nbsp;</td>
									</tr>
                                  </table>								  
								  </td>
                                </tr>
                                <tr valign="top">
                                  <td valign="top">
								  <table width="100%" border="0">
                                    <tr>
                                      <td >Subject : * </td>
                                      <td><input type="text" name="subject" class="inputbox" size="40" value="{subject}" /></td>
                                    </tr>
                                    <tr>
                                      <td width="30%" valign="top">Description : </td>
                                      <td width="70%"><textarea name="description" cols="42" class="inputbox" rows="10">{description}</textarea></td>
                                    </tr>
                                    <tr>
                                      <td valign="top">Start Date : </td>
                                  <td valign="top">
                                    <select name="smonth"  class="inputbox" >
                                      
                                    
					{FROM_MONTH}
					
                                  
                                    </select>
                                    <select name="sday"  class="inputbox" >
                                      
                                      		
					{FROM_DAY}
					
                                  
                                    </select>
                                    <select name="syear"  class="inputbox" >
                                      
                                      		
					{FROM_YEAR}
					
                                  
                                    </select>
      Time:
      <input name="stime" type="text" class="inputbox" value="{STIME}" size="4" >
                                  </td>
                                </tr>
                                <tr>
                                  <td valign="top">Due Date : </td>
                                  <td valign="top"><select name="emonth"  class="inputbox" >
                                      
                                    
                                    
					{FROM_MONTH}
					
                                  
                                  
                                    </select>
                                      <select name="eday"  class="inputbox" >
                                        
                                      
                                      		
					{FROM_DAY}
					
                                  
                                    
                                      </select>
                                      <select name="eyear"  class="inputbox" >
                                        
                                      
                                      		
					{FROM_YEAR}
					
                                  
                                    
                                      </select>
      Time:
      <input name="etime" type="text" class="inputbox" id="etime" value="{STIME}" size="4" ></td>
                                </tr>
                                <tr>
                                  <td valign="top">Priority : * </td>
                                  <td valign="top"><select name="priority" class="inputbox">
                                      
                                    
                                      
                      
												{PRIORITY}
										
                    
                                  
                                  
                                  </select></td>
                                </tr>
                                <tr valign="top">
                                  <td valign="top">Status : </td>
                                  <td valign="top">{STATUS}</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table></td>
                                </tr>
                              </table>
							  </td>
					  </tr>
					  </table>
				
			</td>
		</tr>
		
					</form>
					</div>	
				</div>
</div>
</div>
	<div class="clear">&nbsp;</div>
	<div id="footer">
		{FOOTER}
	</div>	
		
	</div>
		
</body>

</html>

		