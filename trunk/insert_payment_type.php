<html>
<head>
<?php include('./include/menu.php'); ?>
<script type="text/javascript" src="niftycube.js"></script>
<script type="text/javascript">
window.onload=function(){
Nifty("div#container");
Nifty("div#subheader");
Nifty("div#content,div#nav","same-height small");
Nifty("div#header,div#footer","small");
}
</script>

<title> Simple Invoices - Tax rate to add
</title>
<?php include('./config/config.php'); 
include("./lang/$language.inc.php");
include('./include/validation.php');

jsBegin();
jsFormValidationBegin("frmpost");
jsValidateRequired("pt_description","Payment type description");
jsFormValidationEnd();
jsEnd();

#do the product enabled/disblaed drop down
$display_block_enabled = "<select name=\"pt_enabled\">
<option value=\"1\" selected>$wording_for_enabledField</option>
<option value=\"0\">$wording_for_disabledField</option>
</select>";


?>

<BODY>
<?php
$mid->printMenu('hormenu1');
$mid->printFooter();
?>

<link rel="stylesheet" type="text/css" href="themes/<?php echo $theme; ?>/tables.css">
<br>

<FORM name="frmpost" ACTION="insert_action.php" METHOD=POST onsubmit="return frmpost_Validator(this)">
<div id="container">
<div id="header">

<table align=center>
	<tr>
		<td colspan=3 align=center><b>Payment type to add</b></th>
	</tr>
</table>

</div id="header">
<div id="subheader">

<table align=center>
	<tr>
		<td>Payment type description</td><td><input type=text name="pt_description" size=50></td>
	</tr>
	<tr>
		<td><?php echo $wording_for_enabledField; ?></td><td><?php echo $display_block_enabled;?></td>
	</tr>
	
</table>
</div>
<div id="footer">

<p><input type=submit name="submit" value="Insert Payment Type">
<input type=hidden name="op" value="insert_payment_type"></p>
</div>


</FORM>
</BODY>
</HTML>







