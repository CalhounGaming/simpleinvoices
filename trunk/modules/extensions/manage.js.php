<script>

{literal}
/*
var view_tooltip ="{/literal}{$LANG.quick_view_tooltip} {ldelim}1{rdelim}{literal}";
var edit_tooltip = "{/literal}{$LANG.edit_view_tooltip} {$invoices.preference.pref_inv_wording} {ldelim}1{rdelim}{literal}";

		'<!--0 Quick View --><a class="index_table" title="'+  +''+ view_tooltip +'"  href="index.php?module=products&view=details&id={1}&action=view"> <img src="images/common/view.png" height="16" border="-5px" padding="-4px" valign="bottom" alt="" /></a>',

		'<!--1 Edit View --><a class="index_table" title="'+  +''+ edit_tooltip +'"  href="index.php?module=products&view=details&id={1}&action=edit"><img src="images/common/edit.png" height="16" border="-5px" padding="-4px" valign="bottom" alt="" /><!-- print --></a>',
*/

			var columns = 5;
			var padding = 12;
			var grid_width = $('.col').width();

			//LANG
			var LANG_rate = {/literal}'{$LANG.rate}'{literal};
			
			grid_width = grid_width - (columns * padding);
			percentage_width = grid_width / 100; 
		
			
			$('#manageGrid').flexigrid
			(
			{
			url: 'index.php?module=extensions&view=xml',
			dataType: 'xml',
			colModel : [
				{display: 'Actions', name : 'actions', width : 10 * percentage_width, sortable : false, align: 'center'},
				{display: 'ID', name : 'id', width : 10 * percentage_width, sortable : true, align: 'left'},
				{display: 'Name', name : 'name', width : 30 * percentage_width, sortable : true, align: 'left'},
				{display: 'Description', name : 'description', width : 40 * percentage_width, sortable : true, align: 'left'},
				{display: 'Status', name : 'enabled', width : 10 * percentage_width, sortable : true, align: 'left'}
				
				],
				

			searchitems : [
				{display: 'ID', name : 'id'},
				{display: 'Name', name : 'name'},
				{display: 'Description', name : 'description', isdefault: true}
				],
			sortname: 'name',
			sortorder: 'asc',
			usepager: true,
			/*title: 'Manage Custom Fields',*/
			useRp: false,
			rp: 25,
			showToggleBtn: false,
			showTableToggleBtn: false,
			height: 'auto'
			}
			);


{/literal}

</script>
