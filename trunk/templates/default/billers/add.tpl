{* if bill is updated or saved.*}

{if $smarty.post.name != "" && $smarty.post.submit != null } 
{$refresh_total}

<br />
<br>
{$display_block}
<br />
<br />
{else}
{* if no biller name was inserted *}

{if $smarty.post.submit !=null}
<div class="validation_alert"><img src="./images/common/important.png"</img>
You must enter a Biller name</div>
<hr></hr>
{/if}
<FORM name="frmpost" action="index.php?module=billers&view=add"
	method="post"><b>{$LANG.biller_to_add}</b>
<hr></hr>
<table align="center">
	<tr>
		<td class="details_screen">{$LANG.biller_name} <a href="./documentation/info_pages/required_field.html" rel="gb_page_center[350, 150]"><img src="./images/common/required-small.png"></img></a></td>
		<td><input type=text name="name" value="{$smarty.post.name}"
			size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.street}</td>
		<td><input type=text name="b_street_address"
			value="{$smarty.post.b_street_address}" size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.street2} <a
			href="./documentation/info_pages/street2.html"
			rel="gb_page_center[450, 450]"> <img
			src="./images/common/help-small.png"></img> </a></td>
		<td><input type=text name="b_street_address2"
			value="{$smarty.post.b_street_address2}" size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.city}</td>
		<td><input type=text name="b_city" value="{$smarty.post.b_city}"
			size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.state}</td>
		<td><input type=text name="b_state" value="{$smarty.post.b_state}"
			size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.zip}</td>
		<td><input type=text name="b_zip_code"
			value="{$smarty.post.b_zip_code}" size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.country}</td>
		<td><input type=text name="b_country" value="{$smarty.post.b_country}"
			size=50></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.phone}</td>
		<td><input type=text name="b_phone" value="{$smarty.post.b_phone}"
			size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.mobile_phone}</td>
		<td><input type=text name="b_mobile_phone"
			value="{$smarty.post.b_mobile_phone}" size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.fax}</td>
		<td><input type=text name="b_fax" value="{$smarty.post.b_fax}" size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.email}</td>
		<td><input type=text name="b_email" value="{$smarty.post.b_email}"
			size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.1} <a
			href="./documentation/info_pages/custom_fields.html"
			rel="gb_page_center[450, 450]"> <img
			src="./images/common/help-small.png"></img> </a></td>
		<td><input type=text name="b_custom_field1"
			value="{$smarty.post.b_custom_field1}" size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.2} <a
			href="./documentation/info_pages/custom_fields.html"
			rel="gb_page_center[450, 450]"> <img
			src="./images/common/help-small.png"></img> </a></td>
		<td><input type=text name="b_custom_field2"
			value="{$smarty.post.b_custom_field2}" size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.3} <a
			href="./documentation/info_pages/custom_fields.html"
			rel="gb_page_center[450, 450]"> <img
			src="./images/common/help-small.png"></img> </a></td>
		<td><input type=text name="b_custom_field3"
			value="{$smarty.post.b_custom_field3}" size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$customFieldLabel.4} <a
			href="./documentation/info_pages/custom_fields.html"
			rel="gb_page_center[450, 450]"> <img
			src="./images/common/help-small.png"></img> </a></td>
		<td><input type=text name="b_custom_field4"
			value="{$smarty.post.b_custom_field4}" size=25></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.logo_file} <a
			href="./documentation/info_pages/insert_biller_text.html"
			rel="gb_page_center[450, 450]"> <img
			src="./images/common/help-small.png"></img> </a></td>
		<td><select name="b_co_logo">
			<option selected value="_default_blank_logo.png"
				style="font-weight: bold">_default_blank_logo.png</option>
			{foreach from=$files item=file}
			<option>{$file}</option>
			{/foreach} </td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.invoice_footer}</td>
		<td><textarea input type=text name="b_co_footer"
			value="{$smarty.post.b_co_footer}" rows=4 cols=50></textarea></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.notes}</td>
		<td><textarea input type=text name="b_notes"
			value="{$smarty.post.b_notes}" rows=8 cols=50></textarea></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.enabled}</td>
		<td><select name="b_enabled">
			<option value="1" selected>{$LANG.enabled}</option>
			<option value="0">{$LANG.disabled}</option>
		</select></td>
	</tr>
	</div>
	</div>
	</div>
	</tbody>
</table>
<hr></hr>
<input type="submit" name="submit" value="{$LANG.insert_biller}" /> <input
	type="hidden" name="op" value="insert_biller" /></FORM>
{/if}
