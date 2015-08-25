<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="../templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="../templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="../admin/admin_scripts.js" ></script>
		<script language="javascript">
		<!--
		function setbannerSize(){
			var f = document.adminForm;
			switch( f.bannersize.value ){
				case "148x300":
					f.costs.value = "1000";
					break;
				case "180x700":	
					f.costs.value = "2000";
					break;
				case "800x140":	
					f.costs.value = "5000";
					break;
				case "600x140":	
					f.costs.value = "4000";
					break;
			}
			validatepurchased();
			checkbalance();
		}
		function validatepurchased(){ 
			var f = document.adminForm;
			if ( f.impressions_purchased.value < 0 ||  f.impressions_purchased.value < 1 ){
				if ( f.impressions_purchased.value ) {
					alert( 'Banner impressions must be a minimum of 5000.' );
				}
			}
			else{
				switch( f.bannersize.value ){
					case "148x300":
						f.totalamount.value = (f.impressions_purchased.value / 5000) * 1000 ;
						break;
					case "800x140":	
						f.totalamount.value = (f.impressions_purchased.value / 5000) * 5000 ;
						break;
					case "600x140":	
						f.totalamount.value = (f.impressions_purchased.value / 5000) * 4000 ;
						break;
					case "180x700":	
						f.totalamount.value = (f.impressions_purchased.value / 5000) * 2000 ;
						break;
				}
			}	
		}
		function checkbalance(){
			var f = document.adminForm;
			if ( (parseInt(f.amountpaid.value)) > (parseInt(f.totalamount.value)) ) { 
				f.change.value = parseInt(f.amountpaid.value) - parseInt(f.totalamount.value) ;
				f.balance.value = "0";
			}
			else if ( parseInt(f.amountpaid.value) < parseInt(f.totalamount.value)) {
				f.change.value = "0";
				f.balance.value = parseInt(f.totalamount.value) - parseInt(f.amountpaid.value);
			}
			else if ( f.amountpaid.value == f.totalamount.value ) {
				f.change.value = "0";
				f.balance.value = "0";
			}
		}
		
		function changeDisplayImage() {
			if (document.adminForm.imageurl.value !='') {
				document.adminForm.imagelib.src='images/ads/' + document.adminForm.imageurl.value;
			} else {
				document.adminForm.imagelib.src='images/blank.png';
			}
		}
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (form.name.value == "") {
				alert( "You must provide a banner name." );
			} else if (getSelectedValue('adminForm','cid') < 1) {
				alert( "Please select a client." );
			} else if (!getSelectedValue('adminForm','imageurl')) {
				alert( "Please select an image." );
			} else if (form.clickurl.value == "") {
				alert( "Please fill in the URL for the banner." );
			} else {
				submitform( pressbutton );
			}
		}
		//-->
		</script>

<link rel="stylesheet" type="text/css" href="{STYLESHEET}" />
</head>

<body onLoad="setbannerSize();">
	<div id="wrapper">
		<div id="container">
			<div id="header">
				{HEADER}
			</div>
			<div id="topnav">
				{TOPNAV}
			</div>
			<div id="content">
					<div id="panel" >
			<form name="adminForm" method="post" action="save_banner2.php" >
			<input type="hidden" value="edit" name="task" >
					<div id="toolbar_panel">
							<div id="toolbar_btn">
								<a href="banner_ads_manager.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('edit','','../admin/images/edit_f2.png',1)"><img src="../admin/images/edit.png" name="edit" width="32" height="32" align="absmiddle"border="0">Cancel</a>
							</div>
							<div id="toolbar_btn">
								<a href="#" onClick="document.adminForm.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('cancel','','../admin/images/save_f2.png',1)"><img src="../admin/images/save.png" name="cancel" width="32" height="32" align="absmiddle"border="0">Save</a>
							</div>
					  </div>
					  <h3 class="msginfo">{MESSAGE}</h3>	
					<h1 class="asterisk">Banner Client: {TASK}</h1>
                    <table width="100%" class="ctable"  >
		<tr>
			<td width="100%"  valign="top">
				<table width="100%" class="ctable" id="tdata"  cellspacing="0" border="0"  >
                  <tr class="table_header"> 
                    <th colspan="2" align="left" class="tdcaptions"> Details</th>
                  </tr>
                  <tr> 
                    <td width="169"> Banner Name:: </td>
                    <td width="634"> <input type="text" name="bannername" class="inputbox" size="40" value="{BANNERNAME}" />
                     
                    </td>
                  </tr><tr> 
                    <td> Client Name:: </td>
                    <td><select name="clientnames" class="inputbox" >
                    <option value="">- Select Client -</option>
                    
                    
					{CLIENTNAMES}
                  
                  </select>			    </td>
                  <tr>
                    <td>Banner Filename::</td>
                    <td>                    {BANNERURL}</td>
                  </tr>
                  <tr>
                    <td>Click  URL::</td>
                    <td><input type="text" name="clickurl" class="inputbox" size="40" value="{CLICKURL}" /></td>
                  </tr>
				  
                  <tr> 
                    <td valign="top">Banner Description ::</td>
                    <td><textarea name="desc" cols="42" rows="5" class="inputbox">{BANNERDESC}</textarea></td>
                  </tr>
                  <tr>
                    <td valign="top">Banner Size : </td>
                    <td valign="top"><select name="bannersize" onChange="setbannerSize();" class="inputbox" >
                    <option value=""> - Select Banner size - </option>
                    
                    
							{BANNERSIZE}
					
                  
                  </select>
                      
                    </td>
                  </tr>
                  <tr>
                    <td valign="top">Impressions Purchased : </td>
                    <td valign="top"><input type="text" name="impressions_purchased" onBlur="validatepurchased();" class="inputbox" size="40" value="" /></td>
                  </tr>
<!--<td>Total Amount : </td>
                <td>Php
                    <input type="text" name="totalamount"  readonly style="border:0px; color:#000; background-color:transparent; " ></td>
              </tr>
              <tr>
                <td>Amount paid : </td>
                <td><input type="text" onChange="return checkbalance();"  name="amountpaid" class="inputbox" size="40" value="" /></td>
              </tr>
              <tr>
                <td>Credit Balance : </td>
                <td><input type="text" name="balance"  value="" readonly style="border:0px; color:#000; background-color:transparent; " ></td>
              </tr>
              <tr>
                <td>Change:</td>
                <td><input type="text" name="change"  readonly style="border:0px; color:#000; background-color:transparent; " ></td>
			  <tr>-->
                    <td valign="top">Clicks : <br>
                   <!-- <input class="formbutton" type="submit" name="resetclicks" value="Reset clicks"  />-->
				   </td>
                    <td valign="top">{CLICKS}</td>
                  </tr>
                  <tr>
                    <td valign="top">Show Banner: </td>
                    <td valign="top">{YESNO}</td>
                  </tr>
                  <tr> 
                    <td valign="top">Banner Image::  </td>
                    <td valign="top" >
							{BANNERIMAGE}
					</td>
                  </tr>
                  <tr> 
                    <td colspan="2">&nbsp;</td>
                  </tr>
                </table>
			</td>
			</tr>
			  </table>
					</form>
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

		