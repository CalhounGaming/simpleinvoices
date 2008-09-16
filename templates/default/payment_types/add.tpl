{*
/*
* Script: add.tpl
* 	 Payment type add template
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

{* if customer is updated or saved.*}

{if $smarty.post.pt_description != "" && $smarty.post.submit != null }
{$refresh_total}

<br />
<br />
{$display_block}
<br />
<br />

{else}
{* if  name was inserted *}
    {if $smarty.post.submit !=null}
        <div class="validation_alert"><img src="./images/common/important.png"</img>
        You must enter a description for the payment type</div>
        <hr />
    {/if}


<form name="frmpost" action="index.php?module=payment_types&amp;view=add" method="post">
	<h3>Payment type to add</h3>
	<hr />
	<table align="center">
		<tr>
			<td class="details_screen">Payment type description 
			<a 
				class="cluetip"
				href="#"
				rel="docs.php?t=help&p=required_field"
				title="{$LANG.Required_Field}"
			>
		<img src="./images/common/required-small.png"></img></a>			
		</td>
			<td><input type=text name="pt_description" size="50"></td>
		</tr>
		<tr>
			<td class="details_screen">{$LANG.enabled}</td>
			<td>
				<select name="pt_enabled">
					<option value="1" selected>{$LANG.enabled}</option>
					<option value="0">{$LANG.disabled}</option>
				</select>
			</td>
		</tr>
	</table>
	<hr />
	<div style="text-align:center;">
		<input type="submit" name="submit" value="{$LANG.insert_payment_type}">
		<input type="hidden" name="op" value="insert_payment_type">
	</div>
</form>
    {/if}
