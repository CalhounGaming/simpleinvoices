<?php 
include_once('./include/include_main.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php 
#include('./include/functions.php');
/* validataion code */
include("./include/validation.php");

echo <<<EOD
<link rel="stylesheet" type="text/css" href="themes/{$theme}/jquery.thickbox.css">
EOD;

jsBegin();
jsFormValidationBegin("frmpost");
jsValidateRequired("prod_description",$LANG_product_description);
jsValidateifNum("prod_unit_price",$LANG_product_unit_price);
jsFormValidationEnd();
jsEnd();

/* end validataion code */

#do the product enabled/disblaed drop down
$display_block_enabled = "<select name=\"prod_enabled\">
<option value=\"1\" selected>$wording_for_enabledField</option>
<option value=\"0\">$wording_for_disabledField</option>
</select>";

#get custom field labels
$prod_custom_field_label1 = get_custom_field_label(product_cf1);
$prod_custom_field_label2 = get_custom_field_label(product_cf2);
$prod_custom_field_label3 = get_custom_field_label(product_cf3);
$prod_custom_field_label4 = get_custom_field_label(product_cf4);
?>

<script language="javascript" type="text/javascript" src="include/jquery.js"></script>
<script language="javascript" type="text/javascript" src="include/jquery.thickbox.js"></script>
<script language="javascript" type="text/javascript" src="include/tiny_mce/tiny_mce_src.js"></script>
<script language="javascript" type="text/javascript" src="include/tiny-mce.conf.js"></script>
</head>
<BODY>

<?php
echo <<<EOD

<FORM name="frmpost" ACTION="index.php?module=products&view=save" METHOD=POST onsubmit="return frmpost_Validator(this)">

<div id="top"><b>&nbsp;{$LANG_product_to_add}&nbsp;</b></div>
 <hr></hr>
       <div id="browser">

<table align=center>
	<tr>
		<td class="details_screen">{$LANG_product_description}</td>
		<td><input type=text name="prod_description" size=50></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG_product_unit_price}</td>
		<td><input type=text name="prod_unit_price" size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$prod_custom_field_label1} <a href="./documentation/info_pages/custom_fields.html?keepThis=true&TB_iframe=true&height=300&width=500" title="Info :: Custom fields" class="thickbox"">*</a></td>
		<td><input type=text name="prod_custom_field1" size=50></td>
	</tr>
	<tr>
		<td class="details_screen">{$prod_custom_field_label2} <a href="./documentation/info_pages/custom_fields.html?keepThis=true&TB_iframe=true&height=300&width=500" title="Info :: Custom fields" class="thickbox">*</a></td>
		<td><input type=text name="prod_custom_field2" size=50></td>
	</tr>
	<tr>
		<td class="details_screen">{$prod_custom_field_label3} <a href="./documentation/info_pages/custom_fields.html?keepThis=true&TB_iframe=true&height=300&width=500" title="Info :: Custom fields" class="thickbox">*</a></td>
		<td><input type=text name="prod_custom_field3" size=50></td>
	</tr>
	<tr>
		<td class="details_screen">{$prod_custom_field_label4} <a href="./documentation/info_pages/custom_fields.html?keepThis=true&TB_iframe=true&height=300&width=500" title="Info :: Custom fields" class="thickbox">*</a></td>
		<td><input type=text name="prod_custom_field4" size=50></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG_notes}</td>
		<td><textarea input type=text name='prod_notes' rows=8 cols=50>{$prod_notesField}</textarea></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG_product_enabled}</td>
		<td>{$display_block_enabled}</td>
	</tr>
</table>
<!-- </div> -->
<hr></hr>
<div id="footer">
	<input type=submit name="submit" value="{$LANG_insert_product}">
	<input type=hidden name="op" value="insert_product">
</div>
EOD;
include("footer.inc.php");
?>

</div>
</FORM>
</BODY>
</HTML>
