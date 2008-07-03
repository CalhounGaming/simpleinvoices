{*
/*
* Script: add.tpl
* 	 Customers add template
*
* Authors:
*	 Justin Kelly, Nicolas Ruflin
*
* Last edited:
* 	 2007-07-18
*
* License:
*	 GPL v2 or above
*/
*}

{* if customer is updated or saved.*} 

{if $smarty.post.last_name != "" && $smarty.post.last_name != null } 
	{include file="../extensions/school/templates/default/enrollment/save.tpl"}

{else}
{* if  name was inserted *} 
	{if $smarty.post.last_name } 
		<div class="validation_alert"><img src="./images/common/important.png"</img>
		You must enter a teachers name</div>
		<hr />
	{/if}
	

	
<form name="frmpost" ACTION="index.php?module=teacher&view=add" METHOD="post"><h3>Add New Teacher</h3>
<hr />
	
<table align=center>
	<tr>
		<td class="details_screen">Student</td>
		<td>
			<select name="student_id">
			{foreach from=$students item=student}
				<option {if $student.id == "1"} selected {/if} value="{$student.id}">{$student.name}, {$student.first_name} {$student.middle_name}</option>
			{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td class="details_screen">Course</td>
		<td>
			<select name="course_id">
			{foreach from=$courses item=course}
				<option {if $course.id == "1"} selected {/if} value="{$course.id}">{$course.description}</option>
			{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td class="details_screen">Start Reason</td>
		<td>
			<select name="start_reason">
			{foreach from=$start_reasons item=start_reason}
				<option {if $start_reason.id == "1"} selected {/if} value="{$start_reason.id}">{$start_reason.reason}</option>
			{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td class="details_screen">Dropped Reason</td>
		<td>
			<select name="start_reason">
			{foreach from=$dropped_reasons item=dropped_reason}
				<option {if $dropped_reason.id == "1"} selected {/if} value="{$dropped_reason.id}">{$dropped_reason.reason}</option>
			{/foreach}
			</select>
		</td>
	</tr>
</table>
<p>
</div>
<hr />
<div style="text-align:center;">
	<input type="submit" name="customer" value="Add Enrollment">
	<input type="hidden" name="op" value="insert_enrollment">
</div>
</form>
{/if}
