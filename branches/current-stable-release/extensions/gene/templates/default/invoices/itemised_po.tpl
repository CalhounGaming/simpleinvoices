{*
/*
* Script: itemised.tpl
* 	 Itemised invoice template
*
* Authors:
*	 Justin Kelly, Nicolas Ruflin
*
* Last edited:
* 	 2007-07-18
*
* License:
*	 GPL v2 or above
*
* Website:
*	http://www.simpleinvoices.org
*/
*}

{*
<form action="" method="">
*}
<form name="frmpost" action="index.php?module=invoices&view=save" method=POST onsubmit="return frmpost_Validator(this)">
<h3>Purchase Order
<div id="gmail_loading" class="gmailLoader" style="float:right; display: none;">
        	<img src="images/common/gmail-loader.gif" alt="Loading ..."/> Loading ...
</div>
</h3>
{include file="$path/header.tpl" }


<tr>
	<td class="details_screen">
		{$LANG.quantity}
	</td>
	<td class="details_screen">
		{$LANG.description}
	</td>
	<td class="details_screen">
		Unit Cost
	</td>
</tr>


        {section name=line start=0 loop=$dynamic_line_items step=1}

			<tr id=line class="line{$smarty.section.line.index}"> 
				<td><input id="quantity{$smarty.section.line.index}" type=text value="" name="quantity{$smarty.section.line.index}" size="5"></td>
				<td>
				                
			{if $products == null }
				<p><em>{$LANG.no_products}</em></p>
			{else}
				<select id="country" name="products{$smarty.section.line.index}" onchange="invoice_product_change_cost($(this).val(), {$smarty.section.line.index}, jQuery('#quantity{$smarty.section.line.index}').val() );" >

					<option value=""></option>
				{foreach from=$products item=product}
					<option {if $product.id == $defaults.product} selected {/if} value="{$product.id}">{$product.description}</option>
				{/foreach}
				</select>
			{/if}
				                				                
                </td>
				<td>
					<input id="unit_cost{$smarty.section.line.index}" name="unit_cost{$smarty.section.line.index}" size="7" value=""></input>
				{*
					 -- <input type=text name="unit_cost{$smarty.section.line.index}" size="5"></td>
				*}
				</td>		
</tr>

        {/section}
        {*
        <a href="#" onclick="add_line_item(4)">add lint item</a>
           *}
	{$show_custom_field.1}
			<tr>
			<td class="details_screen">
				{$custom_field_labels.invoice_cf2}
			</td>
			<td>
			<select name="customField2" >
				{html_options values=$po_received  output=$po_received }
			</select>
			</td>
			</tr>
{*
	{$show_custom_field.2}
*}
	{$show_custom_field.3}
	{$show_custom_field.4}
{*
	{showCustomFields categorieId="4" itemId=""}
*}


<tr>
        <td colspan=3 class="details_screen">{$LANG.notes}</td>
</tr>

<tr>
        <td colspan=3><textarea input type=text name="note" rows=5 cols=70 WRAP=nowrap></textarea></td>
</tr>

<tr><td class="details_screen">{$LANG.tax}</td>
<td>

{if $taxes == null }
	<p><em>{$LANG.no_taxes}</em></p>
{else}
	<select name="tax_id">
	{foreach from=$taxes item=tax}
		<option {if $tax.tax_id == $defaults.tax} selected {/if} value="{$tax.tax_id}">{$tax.tax_description}</option>
	{/foreach}
	</select>
{/if}

</td>
</tr>

<tr>
<td class="details_screen">{$LANG.inv_pref}</td><td input type=text name="preference_id">

{if $preferences == null }
	<p><em>{$LANG.no_preferences}</em></p>
{else}
	<select name="preference_id">
	{foreach from=$preferences item=preference}
		<option {if $preference.pref_id == $defaults.preference} selected {/if} value="{$preference.pref_id}">{$preference.pref_description}</option>
	{/foreach}
	</select>
{/if}

</td>
</tr>	
<tr>
	<td align=left>
		<a href="docs.php?t=help&p=invoice_custom_fields" rel="gb_page_center[450, 450]">{$LANG.want_more_fields}<img src="./images/common/help-small.png"></img></a>

	</td>
</tr>
<!--Add more line items while in an itemeised invoice - Get style - has problems- wipes the current values of the existing rows - not good
<tr>
<td>
<a href="?get_num_line_items=10">Add 5 more line items<a>
</tr>
-->
</table>
<!-- </div> -->
<hr />
<div style="text-align:center;">
	<a href="javascript:history.go(-1)" onClick="history.go(-1)">Cancel</a> 
	<input type=hidden name="max_items" value="{$smarty.section.line.index}">
	<input type=submit name="submit" value="{$LANG.save_invoice}">
	<input type=hidden name="type" value="2">
</div>
</form>