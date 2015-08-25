<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{SITENAME}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript" src="templates/setfooter.js" ></script>
<script type="text/javascript" language="javascript1.2" src="templates/main.js" ></script>
<script type="text/javascript" language="javascript" src="admin/admin_scripts.js" ></script>
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
			if ( f.impressions_purchased.value) {
			}
			if ( f.impressions_purchased.value < 0 ||  f.impressions_purchased.value < 10 ){
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

<link rel="stylesheet" type="text/css" href="../templates/admin2.css" />
</head>

<body>
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
					<div id="toolbar_panel">
						<div id="toolbar_btn">
								<input type="submit" value="cancel" name="cancel" class="formbutton" >
								<input type="submit" value="save" name="add" class="formbutton" >
								<input type="hidden" value="add" name="task" >
						</div>
							
					  </div>
					
					<h3 class="msginfo">{MESSAGE}</h3>	
					<h1 class="asterisk">Banner Ads: New </h1>
<table width="100%" class="ctable"  >
		<tr>
			<td width="100%"  valign="top">			  
			<table width="100%" class="ctable" id="tdata"  cellspacing="0" border="0"  >
              <tr class="table_header">
                <th colspan="2" align="left" class="tdcaptions"> Details</th>
              </tr>
              <tr>
                <td width="236"> Banner Name: </td>
                <td width="1420">
                  <input type="text" name="bannername" class="inputbox" size="40" value="" />
                </td>
              </tr>
              <tr>
                <td> Client Name:: </td>
                <td><select name="clientnames" class="inputbox" >
                    <option value="">- Select Client -</option>
                    
                    
					{CLIENTNAMES}
                  
                  </select>
                </td>
              <tr>
                <td>Click URL:</td>
                <td><input type="text" name="clickurl" class="inputbox" size="40" value="" /></td>
              </tr>
              <tr>
                <td valign="top">Banner Description :</td>
                <td><textarea name="desc" cols="42" rows="5" class="inputbox"></textarea>
				</td>
              </tr>
              <tr>
                <td>Banner Size : </td>
                <td><select name="bannersize"  class="inputbox" >
                    <option value=""> - Select Banner size - </option>
                    
                    
							{BANNERSIZE}
					
                  
                  </select>
                </td>
              </tr>
              <tr>
                <td>Impressions Purchased : </td>
                <td><input type="text" name="impressions_purchased"  class="inputbox" size="40" value="" /></td>
              </tr>
              <!-- <tr>
               <td>Total Amount : </td>
                <td>Php
                    <input type="text" name="totalamount"  readonly style="border:0px; color:#000; background-color:transparent; " ></td>
              </tr>
              <tr>
                <td>Amount paid : </td>
                <td><input type="text" onChange="return checkbalance();"  name="amountpaid" class="inputbox" size="40" value="" /></td>
              </tr>
              <tr>
                <td>Credit Balance : </td>
                <td><input type="text" name="balance"  readonly style="border:0px; color:#000; background-color:transparent; " ></td>
              </tr>
              <tr>
                <td>Change:</td>
                <td><input type="text" name="change"  readonly style="border:0px; color:#000; background-color:transparent; " ></td>
              </tr>-->
              <tr>
                <td>Show Banner: </td>
                <td>
				<input name="showbanner" type="radio" value="1"  >Yes
				<input name="showbanner" type="radio" value="0" checked >No
				</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
            </table></td>
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

		