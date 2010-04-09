{if $courses == null }
	<P><em>{$LANG.no_products}</em></p>
{else}


<h3>Manage Courses :: <a href="index.php?module=course&view=add">Add New Course</a></h3>

 <hr />
{if $smarty.get.action == "search"}

Courses filtered by 
	{if $smarty.get.id != ""}Course ID = {$smarty.get.id}{/if}
	{if $smarty.get.course_id != ""}Course = '{$course_search.description}'{/if}
	{if $smarty.get.branch_id != ""}Branch = '{$branch_search.0.name}'{/if}
 <a href="index.php?module=course&view=manage">Clear filer</a> :: <a href="index.php?module=course&view=search">Search again</a>
<br>
<hr />
{/if}
<table align="center" class="ricoLiveGrid" id="rico_courses">
<colgroup>
	<col style='width:10%;' />
	<col style='width:10%;' />
	<col style='width:50%;' />
	<col style='width:20%;' />
	<col style='width:10%;' />
</colgroup>
<thead>
<tr class="sortHeader">
	<th class="noFilter sortable">{$LANG.actions}</th>
	<th class="index_table sortable">{$LANG.product_id}</th>
	<th class="index_table sortable">{$LANG.product_description}</th>
	<th class="index_table sortable">{$LANG.product_unit_price}</th>
	<th class="noFilter index_table sortable">{$LANG.enabled}</th>
</tr>
</thead>

{foreach from=$courses item=course}
	<tr class="index_table">
	<td class="index_table">
	<a class="index_table"
	 href="index.php?module=course&view=details&id={$course.id}&action=view">{$LANG.view}</a> ::
	<a class="index_table"
	 href="index.php?module=course&view=details&id={$course.id}&action=edit">{$LANG.edit}</a> </td>
	<td class="index_table">{$course.id}</td>
	<td class="index_table">{$course.description}</td>
	<td class="index_table">{$course.unit_price}</td>
	<td class="index_table">{$course.enabled}</td>
	</tr>

{/foreach}

	</table>
{/if}