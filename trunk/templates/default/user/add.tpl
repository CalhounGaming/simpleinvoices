{*
* Script: add.tpl
* 	Biller add template
*
* Last edited:
* 	 2008-08-25
*
* License:
*	 GPL v3 or above
*}


{if $smarty.post.email != null && $smarty.post.submit != null } 
	{include file="../templates/default/user/save.tpl"}
{else}
<form name="frmpost" action="index.php?module=user&view=add" method="post" id="frmpost"><h3>{$LANG.user_add}</h3>

<table align="center">
	<tr>
		<td class="details_screen">{$LANG.email} 
		<a 
				class="cluetip"
				href="#"
				rel="docs.php?t=help&p=required_field"
				title="{$LANG.Required_Field}"
		>
		<img src="./images/common/required-small.png" alt="" />
		</a>	
		</td>
		<td><input type="text" name="email" value="{$smarty.post.email}" size=35 id="email" class="required" onblur="checkField(this);"></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.role} 
			<a
				class="cluetip"
				href="#"
				rel="docs.php?t=help&p=user_role"
				title="{$LANG.role}"
			> 
			<img src="./images/common/help-small.png" alt="" />
			</a>
		</td>
		<td>
				<select name="role">
				    <option value='null'>-- {$LANG.none} --</option>
					{foreach from=$roles item=role}
						<option  value="{$role.id}">{$role.name}</option>
					{/foreach}
				</select>
		</td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.password}</td>
		<td><input type="password" name="password_field" value="{$smarty.post.password_field}" size="25" /></td>
	</tr>
	<tr>
		<td class="details_screen">{$LANG.enabled}</td>
		<td>
			{html_options name=enabled options=$enabled selected=1}
		</td>
	</tr>
	</div>
	</div>
	</div>
	</tbody>
</table>
<br />
<table class="buttons" align="center">
    <tr>
        <td>
            <button type="submit" class="positive" name="submit" value="Insert User">
                <img class="button_img" src="./images/common/tick.png" alt="" /> 
                {$LANG.save}
            </button>

            <input type="hidden" name="op" value="insert_user" />
        
            <a href="./index.php?module=user&view=manage" class="negative">
                <img src="./images/common/cross.png" alt="" />
                {$LANG.cancel}
            </a>
    
        </td>
    </tr>
</table>
</form>
{/if}
