<?php

//stop the direct browsing to this file - let index.php handle which files get displayed
checkLogin();


/*echo <<<EOD
<title>{$title} :: {$LANG['manage_invoices']}</title>
EOD;*/

#insert customer

$sql = "SELECT * FROM {$tb_prefix}invoices ORDER BY inv_id desc";

$result = mysql_query($sql) or die(mysql_error());
$number_of_rows = mysql_num_rows($result);


/*if (mysql_num_rows($result) == 0) {
	$display_block = "";
}else{
	$display_block = <<<EOD*/


$invoices = null;
for($i = 0;$invoice = getInvoices($result);$i++) {
	
	
	$biller = getBiller($invoice['inv_biller_id']);
	$customer = getCustomer($invoice['inv_customer_id']);
	$invoiceType = getInvoiceType($invoice['inv_type']);
	$preference = getPreferences($invoice['inv_preference']);
	$defaults = getSystemDefaults();
	
	$invoices[$i]['invoice'] = $invoice;
	$invoices[$i]['biller'] = $biller;
	$invoices[$i]['customer'] = $customer;
	$invoices[$i]['invoiceType'] = $invoiceType;
	$invoices[$i]['preference'] = $preference;
	$invoices[$i]['defaults'] = $defaults;



	#Overdue - number of days - start
	if ($invoice['owing'] > 0 ) {
		$overdue_days = (strtotime(date('Y-m-d')) - strtotime($invoice['calc_date'])) / (60 * 60 * 24);
		$overdue = floor($overdue_days);
	}		
	else {
		$overdue ="";
	}
	
	$url_pdf = "{$_SERVER['HTTP_HOST']}{$install_path}/index.php?module=invoices&view=templates/template&submit={$invoice['inv_id']}&action=view&location=pdf&invoice_style={$invoiceType['inv_ty_description']}";
	$url_pdf_encoded = urlencode($url_pdf);
	$url_for_pdf = "./pdf/html2ps.php?process_mode=single&renderfields=1&renderlinks=1&renderimages=1&scalepoints=1&pixels={$pdf_screen_size}&media={$pdf_paper_size}&leftmargin={$pdf_left_margin}&rightmargin={$pdf_right_margin}&topmargin={$pdf_top_margin}&bottommargin={$pdf_bottom_margin}&transparency_workaround=1&imagequality_workaround=1&output=1&location=pdf&URL={$url_pdf_encoded}";
        
	$invoices[$i]['overdue'] = $overdue;
	$invoices[$i]['url_for_pdf'] = $url_for_pdf;
							
	//}
								
}



$smarty -> assign("number_of_rows",$number_of_rows);
$smarty -> assign("invoices",$invoices);


getRicoLiveGrid("ex1","	{ type:'number', decPlaces:0, ClassName:'alignleft' },,,
	{ type:'number', decPlaces:2, ClassName:'alignleft' },
	{ type:'number', decPlaces:2, ClassName:'alignleft' }");

?>
