{*
/*
* Script: details.tpl
* 	 Invoice details template
*
* License:
*	 GPL v3 or above
*
* Website:
*	http://www.simpleinvoices.org
*/
*}
<b>You are editing {$preference.pref_inv_wording} {$invoice.id}</b>
<div id="gmail_loading" class="gmailLoader" style="float:right; display: none;">
        	<img src="images/common/gmail-loader.gif" alt="Loading ..."/> Loading ...
</div>
 <hr></hr>

<form name="frmpost" action="index.php?module=invoices&view=save" method="post">

	<table align=center>
	<tr>
		<td colspan=6 align=center></td>
	</tr>
        <tr>
		<td class='details_screen'>{$preference.pref_inv_wording} {$LANG.number_short}</td><td><input type=hidden name="invoice_id" value={$invoice.id}  size=15>{$invoice.id}</td>
	</tr>
	<tr>
	        <td class="details_screen">{$LANG.date_formatted}</td>
        	<td><input type="text" class="date-picker" name="date" id="date1" value='{$invoice.calc_date}'></input></td>
	</tr>
	<tr>
		<td class='details_screen'>{$LANG.biller}</td><td>
			
		{if $billers == null }
			<p><em>{$LANG.no_billers}</em></p>
		{else}
			<select name="biller_id">
			{foreach from=$billers item=biller}
				<option {if $biller.id == $invoice.biller_id} selected {/if} value="{$biller.id}">{$biller.name}</option>
			{/foreach}
			</select>
		{/if}
					
		</td>
	</tr>
	<tr>
		<td class='details_screen'>{$LANG.customer}</td><td>
		
			{if $customers == null}
	        <p><em>{$LANG.no_customers}</em></p>
		
			{else}
			
			<select name="customer_id">
			{foreach from=$customers item=customer}
				<option {if $customer.id == $invoice.customer_id} selected {/if} value="{$customer.id}">{$customer.name}</option>
			{/foreach}
			</select>
		
			{/if}
		
		</td>
	</tr>
	{*
	TODO: implement status 
	<tr>
		<td class="details_screen">Invoice Status</td>
		<td>
			<select name="status_id">
				<option value="0">New</option>
				<option {if $invoice.status_id == 1} selected{/if} value="1">Sent</option>
				<option {if $invoice.status_id == 2} selected{/if} value="1">Paid</option>
			</select>
		</td>
	</tr>
	*}


{if $invoice.type_id == 1 }
	        <tr>
        	        <td colspan=6 class='details_screen'>{$LANG.description}</td>
	        </tr>
	        <tr>
			<td colspan=6 ><textarea input type="text" class="editor" name="description0" rows=10 cols=70 WRAP=nowrap>{$invoiceItems.0.description|unescape}</textarea></td>
        	</tr>

	 {$customFields.1}
	 {$customFields.2}
	 {$customFields.3}
	 {$customFields.4}
	 {*
	 	{showCustomFields categorieId="4" itemId=$smarty.get.invoice}
	 *}

	
		        <tr>       	         
			<td class='details_screen'>{$LANG.gross_total}</td><td><input type="text" name="unit_price" value="{$invoiceItems.0.unit_price}" size=10 />
			<input type="hidden" name="quantity0" value="1">
			<input type="hidden" name="id0" value="{$invoiceItems.0.id}">
			<input type="hidden" name="products0" value="{$invoiceItems.0.product_id}">
			
			</td>
			
		</tr>
		<tr>

{/if}

{if $invoice.type_id == 2 || $invoice.type_id == 3 }

     {if $invoice.type_id == 2 }
		<tr>
		<td colspan=6>
		<table>
		<tr>
        	        <td class='details_screen'>{$LANG.quantity_short}</td>
        	        <td class='details_screen'>{$LANG.description}</td>
        	        <td class='details_screen'>{$LANG.tax}</td>
        	        <td class='details_screen'>{$LANG.unit_price}</td>
	        </tr>
	{/if}

        {if $invoice.type_id == 3}
		<tr>
		<td colspan=6>
		<table>
                <tr>
                        <td class='details_screen'>{$LANG.quantity_short}</td>
                        <td class='details_screen'>{$LANG.item}</td>
                        <td class='details_screen'>{$LANG.unit_price}</td>
                </tr>
        {/if}
	
{foreach key=line from=$invoiceItems item=invoiceItem name=line_item_number}
		
		
	        <tr class="row{$line}">
				<td>
					<a title="Delete this line item"onclick="delete_line_item({$line}); " class="show-customer" href="#" style="display: inline;"><img src="./images/common/delete_item.png" /></a>
					<input type="hidden" id='delete{$line}' name='delete{$line}' size="3">
					<input 
						type="text" 
						name='quantity{$line}' 
						id='quantity{$line}' 
						value='{$invoiceItem.quantity|number_format:2}' 
						size="10"
					>
					<input type="hidden" name='id{$line}' value='{$invoiceItem.id}' size="10"> </td>
					<td>
			                
			        {if $products == null }
						<p><em>{$LANG.no_products}</em></p>
					{else}
						{*	onchange="invoice_product_change_price($(this).val(), {$line}, jQuery('#quantity{$line}').val() );" *}
						<select 
							name="products{$line}"
							id="products{$line}"
							rel="{$line}"
							class="product_change"
						>
						{foreach from=$products item=product}
							<option {if $product.id == $invoiceItem.product_id} selected {/if} value="{$product.id}">{$product.description}</option>
						{/foreach}
						</select>
					{/if}
				</td>
				{section name=tax start=0 loop=$defaults.tax_per_line_item step=1}
					<td>				                				                
						<select 
							id="tax_id[{$line}][{$smarty.section.tax.index}]"
							name="tax_id[{$line}][{$smarty.section.tax.index}]"
						>
						<option value=""></option>
						{assign var="index" value=$smarty.section.tax.index}
						{foreach from=$taxes item=tax}
							<option {if $tax.tax_id.id == $invoiceItem.tax.$index} selected {/if} value="{$tax.tax_id}">{$tax.tax_description}</option>
						{/foreach}
					</select>
					</td>
				{/section}
				<td>
					<input id="unit_price{$line}" name="unit_price{$line}" size="7" value="{$invoiceItem.unit_price|number_format:2}"></input>
				</td>
	        </tr>
		

	{if $invoice.type_id == 3}
		

		<tr>

			<td colspan="6" class="details_screen">{$LANG.description}</td>
		<tr>
                        <td colspan="6"><textarea input type="text" class="editor" name="description{$line}" rows=5 cols=70 wrap="nowrap">{$invoiceItem.description|unescape}</textarea></td>
                </tr>
	
	{/if}
{/foreach}

	<tr>
		<td>
			<a href="./index.php?module=invoices&view=add_invoice_item&invoice={$invoice.id}&type={$invoice.type_id}&tax_id={$invoiceItems.0.tax_id}"><img src="./images/common/famfamAdd.png"></img>{$LANG.add_invoice_item}</a>
		</td>
		<td>
		</td>
	</tr>

	 {$customFields.1}
	 {$customFields.2}
	 {$customFields.3}
	 {$customFields.4}
	 {*
	 	 {showCustomFields categorieId="4" itemId=$smarty.get.invoice}
	 *}
			<tr>
				<td colspan=6 class='details_screen'>{$LANG.note}:</td>
			</tr>
			<tr>
	             <td colspan=6 ><textarea input type=text class="editor" name="note" rows=10 cols=70 WRAP=nowrap>{$invoice.note|unescape}</textarea></td>
			</tr>
			

	{/if}
	
	
	<tr>
		<td class='details_screen'>{$LANG.tax}</td>
		<td>
	                         
	                         	
{if $taxes == null }
	<p><em>{$LANG.no_taxes}</em></p>
{else}
	<select name="tax_id">
	{foreach from=$taxes item=tax}
		<option {if $tax.tax_id == $invoiceItems.0.tax_id} selected {/if} value="{$tax.tax_id}">{$tax.tax_description}</option>
	{/foreach}
	</select>
{/if}


	</td>
	</tr>
	<td class='details_screen'>{$LANG.inv_pref}</td><td>


{if $preferences == null }
	<p><em>{$LANG.no_preferences}</em></p>
{else}
	<select name="preference_id">
	{foreach from=$preferences item=preference}
		<option {if $preference.pref_id == $invoice.preference_id} selected {/if} value="{$preference.pref_id}">{$preference.pref_description}</option>
	{/foreach}
	</select>
{/if}
	                         
	                         </td>
	                </tr>

	


        </table>
	<!-- addition close table tag to close invoice itemised/consulting if it has a note -->
	</table>

<hr></hr>
<table class="buttons" align="center">
    <tr>
        <td>
            <button type="submit" class="positive" name="submit" value="{$LANG.save}">
                <img class="button_img" src="./images/common/tick.png" alt=""/> 
                {$LANG.save}
            </button>

 			<input type="hidden" name="action" value="edit">
			<input type="hidden" name="type" value="{$invoice.type_id}";
            <input type="hidden" name="op" value="insert_preference">
        	<input type="hidden" name="max_items" value="{$lines}">
        	
            <a href="./index.php?module=invoices&view=manage" class="negative">
                <img src="./images/common/cross.png" alt=""/>
                {$LANG.cancel}
            </a>
    
        </td>
    </tr>
 </table>
 	
</form>
