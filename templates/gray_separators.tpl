<body>
<br />
<div id="container">
	<div id="header">
	</div>
	<table width="100%" align="center">	
		<tr>
			<td colspan="5"><img src="{$logo}" border="0" hspace="0" align="left"></td>
			<th align="right"><span class="font1">{$preference.pref_inv_heading}</span></th>
		</tr>
 
		<tr>
			<td colspan="6" class="tbl1-top">&nbsp;</td>
		</tr>
	</table>
 
<!-- Customer section - start -->
 
	<table class="right">
 
	<tr>
			<td class="tbl1-bottom col1" ><b>{$LANG.customer}:</b></td>
			<td class="tbl1-bottom col1" colspan="3">{$customer.name}</td>
	</tr>
 
        {if $customer.attention != null }
    <tr>
            <td class=''>{$LANG.attention_short}:</td>
			<td align=left class='' colspan="3" >{$customer.attention}</td>
                </tr>
       {/if}
        {if $customer.street_address != null }
    <tr >
            <td class=''>{$LANG.address}:</td>
			<td class='' align=left colspan="3">{$customer.street_address}</td>
    </tr>   
        {/if}
        {if $customer.street_address2 != null}
                {if $customer.street_address == null}
    <tr>
            <td class=''>{$LANG.address}:</td>
			<td class='' align=left colspan="3">{$customer.street_address2}</td>
    </tr>   
                {/if}
                {if $customer.street_address != null}
    <tr>
			<td class=''></td>
			<td class='' align=left colspan="3">{$customer.street_address2}</td>
    </tr>   
                {/if}
        {/if}
 
		{merge_address field1=$customer.city field2=$customer.state field3=$customer.zip_code street1=$customer.street_address street2=$customer.street_addtess2 class1="" class2="" colspan="3"}
 
         {if $customer.country != null}
    <tr>
            <td class=''></td>
			<td class='' colspan="3">{$customer.country}</td>
    </tr>
        {/if}
 
	{print_if_not_null label=$LANG.phone_short field=$customer.phone class1='' class2='t' colspan="3"}
	{print_if_not_null label=$LANG.fax field=$customer.fax class1='' class2='' colspan="3"}
	{print_if_not_null label=$LANG.mobile_short field=$customer.mobile_phone class1='' class2='' colspan="3"}
	{print_if_not_null label=$LANG.email field=$customer.email class1='' class2='' colspan="3"}
 
	{print_if_not_null label=$customFieldLabels.customer_cf1 field=$customer.custom_field1 class1='' class2='' colspan="3"}
	{print_if_not_null label=$customFieldLabels.customer_cf2 field=$customer.custom_field2 class1='' class2='' colspan="3"}
	{print_if_not_null label=$customFieldLabels.customer_cf3 field=$customer.custom_field3 class1='' class2='' colspan="3"}
	{print_if_not_null label=$customFieldLabels.customer_cf4 field=$customer.custom_field4 class1='' class2='' colspan="3"}
 
		<tr>
			<td class="" colspan="4"></td>
		</tr>
	</table>
 
	<!-- Customer section - end -->
 
	<table class="left">
 
    <!-- Biller section - start -->
        <tr>
                <td class="tbl1-bottom col1" border=1 cellpadding=2 cellspacing=1><b>{$LANG.biller}:</b></td>
				<td class="col1 tbl1-bottom" border=1 cellpadding=2 cellspacing=1 colspan="3">{$biller.name}</td>
        </tr> 
 
        {if $biller.street_address != null}
		<tr>
                <td class=''>{$LANG.address}:</td>
				<td class='' align=left colspan="3">{$biller.street_address}</td>
		</tr>
        {/if}
        {if $biller.street_address2 != null }
			{if $biller.street_address == null }
		<tr>
                <td class=''>{$LANG.address}:</td>
				<td class='' align=left colspan="3">{$biller.street_address2}</td>
		</tr>   
			{/if}
			{if $biller.street_address != null }
		<tr>
                <td class=''></td>
				<td class='' align=left colspan="3">{$biller.street_address2}</td>
        </tr>   
			{/if}
        {/if}
 
		{merge_address field1=$biller.city field2=$biller.state field3=$biller.zip_code street1=$biller.street_address street2=$biller.street_address2 class1="" class2="" colspan="3"}
 
		{if $biller.country != null }
		<tr>
				<td class=''></td>
				<td class='' colspan="3">{$biller.country}</td>
		</tr>
       	{/if}
 
	{print_if_not_null label=$LANG.phone_short field=$biller.phone class1='' class2='' colspan="3"}
	{print_if_not_null label=$LANG.fax field=$biller.fax class1='' class2='' colspan="3"}
	{print_if_not_null label=$LANG.mobile_short field=$biller.mobile_phone class1='' class2='' colspan="3"}
	{print_if_not_null label=$LANG.email field=$biller.email class1='' class2='' colspan="3"}
 
	{print_if_not_null label=$customFieldLabels.biller_cf1 field=$biller.custom_field1 class1='' class2='' colspan="3"}
	{print_if_not_null label=$customFieldLabels.biller_cf2 field=$biller.custom_field2 class1='' class2='' colspan="3"}
	{print_if_not_null label=$customFieldLabels.biller_cf3 field=$biller.custom_field3 class1='' class2='' colspan="3"}
	{print_if_not_null label=$customFieldLabels.biller_cf4 field=$biller.custom_field4 class1='' class2='' colspan="3"}
 
		<tr>
				<td class="" colspan="4"> </td>
		</tr>
 
	<!-- Biller section - end -->
 
		<tr>
			<td colspan="4"><br /></td>
		</tr>
 
	</table>
 
	<table class="left" width="100%">
		<tr>
			<td colspan="6"><br /></td>
		</tr>
 
		<tr>
		<td class="tbl1-bottom col1" colspan="6"></br></td>
		</tr>
 
 
	{if $invoice.type_id == 2 }
			<tr bgcolor="#AAAAAA">
				<td class="tbl1-bottom col1"><b>{$LANG.quantity_short}</b></td>
				<td class="tbl1-bottom col1" colspan="3"><b>{$LANG.item}</b></td>
				<td class="tbl1-bottom col1" align="right"><b>{$LANG.Unit_Cost}</b></td>
				<td class="tbl1-bottom col1" align="right"><b>{$LANG.Price}</b></td>
			</tr>
 
				{foreach from=$invoiceItems item=invoiceItem}
 
			<tr class="" >
				<td class="">{$invoiceItem.quantity|siLocal_number_trim}</td>
				<td class="" colspan="3">{$invoiceItem.product.description}</td>
				<td class="" align="right">{$preference.pref_currency_sign}{$invoiceItem.unit_price|siLocal_number}</td>
				<td class="" align="right">{$preference.pref_currency_sign}{$invoiceItem.gross_total|siLocal_number}</td>
			</tr>
			{if $invoiceItem.description != null}
			<tr class="" >
				<td class=""></td>
				<td class="" colspan="5">{$LANG.description}: {$invoiceItem.description}</td>
			</tr>
			{/if}
 
            <tr class="tbl1-bottom">
                <td class=""></td>
				<td class="" colspan="5">
					<table width="100%">
						<tr>
 
					{inv_itemised_cf label=$customFieldLabels.product_cf1 field=$invoiceItem.product.custom_field1}
					{do_tr number=1 class="blank-class"}
					{inv_itemised_cf label=$customFieldLabels.product_cf2 field=$invoiceItem.product.custom_field2}
					{do_tr number=2 class="blank-class"}
					{inv_itemised_cf label=$customFieldLabels.product_cf3 field=$invoiceItem.product.custom_field3}
					{do_tr number=3 class="blank-class"}
					{inv_itemised_cf label=$customFieldLabels.product_cf4 field=$invoiceItem.product.custom_field4}
					{do_tr number=4 class="blank-class"}
 
						</tr>
					</table>
                </td>
            </tr>
             	{/foreach}
	{/if}
 
	{if $invoice.type_id == 3 }
			<tr class="tbl1-bottom col1">
				<td class="tbl1-bottom "><b>{$LANG.quantity_short}</b></td>
				<td colspan="3" class=" tbl1-bottom"><b>{$LANG.item}</b></td>
				<td align="right" class=" tbl1-bottom"><b>{$LANG.Unit_Cost}</b></td>
				<td align="right" class=" tbl1-bottom  "><b>{$LANG.Price}</b></td>
			</tr>
 
			{foreach from=$invoiceItems item=invoiceItem}
 
			<tr class=" ">
				<td class="" >{$invoiceItem.quantity|siLocal_number}</td>
				<td>{$invoiceItem.product.description}</td>
				<td class="" colspan="4"></td>
			</tr>
 
 
            <tr>       
                <td class=""></td>
				<td class="" colspan="5">
                    <table width="100%">
                        <tr>
 
					{inv_itemised_cf label=$customFieldLabels.product_cf1 field=$invoiceItem.product.custom_field1}
					{do_tr number=1 class="blank-class"}
					{inv_itemised_cf label=$customFieldLabels.product_cf2 field=$invoiceItem.product.custom_field2}
					{do_tr number=2 class="blank-class"}
					{inv_itemised_cf label=$customFieldLabels.product_cf3 field=$invoiceItem.product.custom_field3}
					{do_tr number=3 class="blank-class"}
					{inv_itemised_cf label=$customFieldLabels.product_cf4 field=$invoiceItem.product.custom_field4}
					{do_tr number=4 class="blank-class"}
 
                        </tr>
                    </table>
                </td>
            </tr>
 
			<tr class="">
				<td class=""></td>
				<td class="" colspan="5"><i>{$LANG.description}: </i>{$invoiceItem.description}</td>
			</tr>
			<tr class="">
				<td class="" ></td>
				<td class=""></td>
				<td class=""></td>
				<td class=""></td>
				<td align="right" class="">{$preference.pref_currency_sign}{$invoiceItem.unit_price|siLocal_number}</td>
				<td align="right" class="">{$preference.pref_currency_sign}{$invoiceItem.total|siLocal_number}</td>
			</tr>
			{/foreach}
	{/if}
 
	{if $invoice.type_id == 1 }
		    <table class="left" width="100%">
 
                <tr class="col1" >
                    <td bgcolor="#AAAAAA" colspan="6"><b>{$LANG.description}</b></td>
                </tr>
 
          {foreach from=$invoiceItems item= invoiceItem}
 
			    <tr class=" ">
                    <td class="t" colspan="6">{$invoiceItem.description|unescape}</td>
                </tr>
 
		{/foreach}
	{/if}
 
{if ($invoice.type_id == 2 && $invoice.note != "") || ($invoice.type_id == 3 && $invoice.note != "" )  }
 
		<tr>
			<td class="" colspan="6"><br /></td>
		</tr>
		<tr>
			<td class="" colspan="6" align="left"><b>{$LANG.notes}:</b></td>
		</tr>
		<tr>
			<td class="" colspan="6">{$invoice.note|unescape}</td>
		</tr>
 
		<tr>
		<td class="tbl1-bottom col1" colspan="6"></br></td>
		</tr>
 
{/if}
 
	<tr class="">
		<td class="" colspan="6" ><br /></td>
	</tr>
 
    {* tax section - start *}
	{if $invoice_number_of_taxes > 0}
	<tr>
        <td colspan="2"></td>
		<td colspan="3" align="right">{$LANG.gross_total}&nbsp;</td>
		<td colspan="1" align="right">{if $invoice_number_of_taxes > 1}<u>{/if}{$preference.pref_currency_sign}{$invoice.gross|siLocal_number}{if $invoice_number_of_taxes > 1}</u>{/if}</td>
    </tr>
    {/if}
	{if $invoice_number_of_taxes > 1 }
	        <tr>
        	        <td colspan="6"><br /></td>
	        </tr>
    {/if}
    {section name=line start=0 loop=$invoice.tax_grouped step=1}
    	{if ($invoice.tax_grouped[line].tax_amount != "0") }
 
    	<tr>
	        <td colspan="2"></td>
			<td colspan="3" align="right">{$invoice.tax_grouped[line].tax_name}&nbsp;</td>
			<td colspan="1" align="right">{$preference.pref_currency_sign}{$invoice.tax_grouped[line].tax_amount|siLocal_number}</td>
	    </tr>
	    {/if}
 
	{/section}
	{if $invoice_number_of_taxes > 1}
	<tr>
        <td colspan="2"></td>
		<td colspan="3" align="right">{$LANG.tax_total}&nbsp;</td>
		<td colspan="1" align="right"><u>{$preference.pref_currency_sign}{$invoice.total_tax|siLocal_number}</u></td>
    </tr>
    {/if}
	{if $invoice_number_of_taxes > 1}
	<tr>
		<td colspan="6"><br /></td>
	</tr>
    {/if}
    <tr>
        <td colspan="2"></td>
		<td colspan="3" align="right"><b>{$preference.pref_inv_wording} {$LANG.amount}&nbsp;</b></td>
		<td colspan="1" align="right"><span class="double_underline"><u>{$preference.pref_currency_sign}{$invoice.total|siLocal_number}</u></span></td>
    </tr>
    {* tax section - end *}
{*
		<tr>
			<td class="" colspan="2"></td>
			<td align="right" colspan="3">{$LANG.gross_total}</td>
			<td align="right" class="">{$preference.pref_currency_sign}{$invoice.gross|siLocal_number}</td>
		</tr>
 
 
    {section name=line start=0 loop=$invoice.tax_grouped step=1}
 
		{if ($invoice.tax_grouped[line].tax_amount != "0") }  
 
		<tr class=''>
	        <td colspan="2"></td>
			<td colspan="3" align="right">{$invoice.tax_grouped[line].tax_name}</td>
			<td colspan="1" align="right">{$preference.pref_currency_sign}{$invoice.tax_grouped[line].tax_amount|siLocal_number}</td>
	    </tr>
 
	    {/if}
 
	{/section}
 
	<tr class=''>
        <td colspan="2"></td>
		<td colspan="3" align="right">{$LANG.tax_total}</td>
		<td colspan="1" align="right"><u>{$preference.pref_currency_sign}{$invoice.total_tax|siLocal_number}</u></td>
    </tr>
 
 
	<tr class="">
		<td class="" colspan="6" ><br /></td>
	</tr>
	<tr class="">
		<td class="" colspan="2"></td>
		<td class="" align="right" colspan="3"><b>{$preference.pref_inv_wording} {$LANG.amount}</b></td>
		<td  class="" align="right"><span class="double_underline" >{$preference.pref_currency_sign}{$invoice.total|siLocal_number}</span></td>
	</tr>
*}
	<tr>
		<td class="tbl1-bottom col1" colspan="6"></br></td>
	</tr>
 
</table>	
<!-- Summary - start -->
 
	<table width="100%" align="left">
		<tr bgcolor="#AAAAAA">
				<td class="col1 tbl1-bottom" colspan="4"><b>{$preference.pref_inv_wording} {$LANG.summary}</b></td>
		</tr>
 
	</table>	
 
	<table width="100%" align="right">
		<tr>
			<td colspan="6"><br /></td>
		</tr>
	</table>
 
	<table class="right">
	<!-- Show the Invoice Custom Fields if valid -->
		{ if $invoice.custom_field1 != null}
		<tr>
				<td nowrap class="">{$customFieldLabels.invoice_cf1}:</td>
				<td class="" align="right" colspan="1">{$invoice.custom_field1}</td>
		</tr>
		{/if}
		{ if $invoice.custom_field2 != null}
		<tr>
				<td nowrap class="">{$customFieldLabels.invoice_cf2}:</td>
				<td class="" align="right"  colspan="1">{$invoice.custom_field2}</td>
		</tr>
		{/if}
		{ if $invoice.custom_field3 != null}
		<tr>
				<td nowrap class="">{$customFieldLabels.invoice_cf3}:</td>
				<td class="" align="right" colspan="1">{$invoice.custom_field3}</td>
		</tr>
		{/if}
		{ if $invoice.custom_field4 != null}
		<tr>
				<td nowrap class="">{$customFieldLabels.invoice_cf4}:</td>
				<td class="" align="right" colspan="1">{$invoice.custom_field4}</td>
		</tr>
		{/if}
		<tr>
				<th class="" align="left">{$preference.pref_inv_wording} {$LANG.number_short}: </th>
				<td class="" colspan="2" align="left">{$preference.pref_inv_wording} {$invoice.id}</td>
		</tr>
		<tr>
				<th class="" align="left">{$preference.pref_inv_wording} {$LANG.date}: </th>
				<td class="" colspan="2" align="right">{$preference.pref_inv_wording} {$invoice.date}</td>
		</tr>
		<tr>
				<th class="" align="left">{$LANG.total}: </td>
				<td class="" align="right" colspan="2">{$preference.pref_currency_sign}{$invoice.total|siLocal_number}</td>
		</tr>
		<tr>
				<td class="" align="left"><b>{$LANG.paid}:</b></td>
				<td class="" align="right" colspan="2" >{$preference.pref_currency_sign}{$invoice.paid|siLocal_number}</td>
		</tr>
		<tr>
				<td class="col1 tbl1-bottom" colspan="3" > </td>
		</tr>
		<tr>
				<td nowrap class="" align="left"><b>{$LANG.owing}:</b></td>
				<td class="" align="right" colspan="2" >{$preference.pref_currency_sign}{$invoice.owing|siLocal_number}</td>
		</tr>
	</table>
 
	<!-- Summary - end -->
 
 
 
<table width="100%" align="left">
	<!-- invoice details section - start -->
 
	<tr>
		<td class="tbl1-bottom col1" colspan="6"><br /></td>
	</tr>
 
	<tr bgcolor="#AAAAAA">
		<td class="tbl1-bottom col1" colspan="6"><b>{$preference.pref_inv_detail_heading}</b></td>
	</tr>
	<tr>
		<td class="" colspan="6" fontsize="10pt"><i>{$preference.pref_inv_detail_line}</i></td>
	</tr>
	<tr>
		<td class="" colspan="6" fontsize="10pt">{$preference.pref_inv_payment_method}</td>
	</tr>
	<tr>
		<td class="" colspan="6" fontsize="10pt">{$preference.pref_inv_payment_line1_name} {$preference.pref_inv_payment_line1_value}</td>
	</tr>
	<tr>
		<td class="" colspan="6" fontsize="10pt">{$preference.pref_inv_payment_line2_name} {$preference.pref_inv_payment_line2_value}</td>
	</tr>
	<tr>
		<td><br /></td>
	</tr>
	<tr>
		<td colspan="6"><div style="font-size:10pt;" align="center">{$biller.footer}</div></td>
	</tr>
 
	<!-- invoice details section - end -->
 
</table>
 
<div id="footer"></div>
 
</div>
 
</body>
</html>