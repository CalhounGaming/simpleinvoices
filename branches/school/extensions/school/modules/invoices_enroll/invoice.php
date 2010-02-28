<?php
/*
* Script: invoice.php
* 	invoice page
*
* Authors:
*	 Justin Kelly, Nicolas Ruflin
*
* Last edited:
* 	 2007-07-19
*
* License:
*	 GPL v2 or above
*
* Website:
* 	http://www.simpleinvoices.org
 */
//stop the direct browsing to this file - let index.php handle which files get displayed
checkLogin();


$billers = getActiveBillers();
$customers = school_invoice::getActiveCustomers();
$taxes = getTaxes();
$products = getActiveProducts();
$preferences = getActivePreferences();
$defaults = getSystemDefaults();


$defaultBiller = getDefaultBiller();
$defaultCustomer = getDefaultCustomer();
$defaultTax = getDefaultTax();
$defaultPreference = getDefaultPreference();

if (!empty( $_GET['get_num_line_items'] )) {
	$dynamic_line_items = $_GET['get_num_line_items'];
} 
else {
	$dynamic_line_items = $defaults['line_items'] ;
}

for($i=1;$i<=4;$i++) {
	$show_custom_field[$i] = show_custom_field("invoice_cf$i",'',"write",'',"details_screen",'','','');
}


$pageActive == "invoices";

/*Start reason*/
$sql_start = "select * from ".TB_PREFIX."course_start_reason"; 
$start_sql = sql2array($sql_start);
$smarty -> assign('start_reasons',$start_sql);

/*Dropped reason*/
$sql_drop = "select * from ".TB_PREFIX."course_dropped_reason"; 
$drop_sql = sql2array($sql_drop);
$smarty -> assign('dropped_reasons',$drop_sql);


$smarty -> assign("billers",$billers);
$smarty -> assign("customers",$customers);
$smarty -> assign("taxes",$taxes);
$smarty -> assign("products",$products);
$smarty -> assign("preferences",$preferences);
$smarty -> assign("dynamic_line_items",$dynamic_line_items);
$smarty -> assign("show_custom_field",$show_custom_field);

$smarty -> assign("defaults",$defaults);
$smarty -> assign('pageActive', $pageActive);

?>