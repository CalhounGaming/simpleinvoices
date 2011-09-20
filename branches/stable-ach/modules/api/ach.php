<?php

$xml_message="";

$logger->log('ACH API page called', Zend_Log::INFO);
if ($_POST['pg_response_code']=='A01') {
#if (!empty($_POST)) {

	$logger->log('ACHl validate success', Zend_Log::INFO);

	//insert into payments
	$paypal_data ="";
	$logger->log('ACH Data:', Zend_Log::INFO);
	$logger->log(print_r($_POST), Zend_Log::INFO);
	//get the domain_id from the paypal invoice
	#$custom_array = explode(";", $_POST['custom']);
	//check if payment has already been entered

	$check_payment = new payment();
	$check_payment->filter='online_payment_id';
	$check_payment->online_payment_id = $_POST['pg_trace_number'];
	$check_payment->domain_id = '1';
    $number_of_payments = $check_payment->count();
	$logger->log('ACH - number of times this payment is in the db: '.$number_of_payments, Zend_Log::INFO);
	
	if($number_of_payments > 0)
	{
		$xml_message .= 'Online payment '.$_POST['pg_transaction_order_number'].' has already been entered into Simple Invoices';
		$logger->log($xml_message, Zend_Log::INFO);
	}

	if($number_of_payments == '0')
	{

		$payment = new payment();
		$payment->ac_inv_id = $_POST['pg_transaction_order_number'];
		#$payment->ac_inv_id = $_POST['invoice'];
		$payment->ac_amount = $_POST['pg_total_amount'];
		#$payment->ac_amount = $_POST['mc_gross'];
		$payment->ac_notes = $_POST;
		#$payment->ac_notes = $paypal_data;
		$payment->ac_date = date( 'Y-m-d');
		#$payment->ac_date = date( 'Y-m-d', strtotime($_POST['payment_date']));
		$payment->online_payment_id = $_POST['pg_trace_number'];
		$payment->domain_id = '1';

			$payment_type = new payment_type();
			$payment_type->type = "ACH";
			$payment_type->domain_id = '1';

		$payment->ac_payment_type = $payment_type->select_or_insert_where();
		$logger->log('ACH - payment_type='.$payment->ac_payment_type, Zend_Log::INFO);
		$payment->insert();

		$invoice = invoice::select($_POST['pg_transaction_order_number']);
		#$invoice = invoice::select($_POST['invoice']);
		$biller = getBiller($invoice['biller_id']);

		//send email
		$body =  "A ACH payment notification was successfully recieved into Simple Invoices\n";
		$body .= "from ".$_POST['pg_billto_postal_name_company']." on ".date('m/d/Y');
		$body .= " at ".date('g:i A')."\n\nDetails:\n";
		$body .= $_POST;

		$email = new email();
		$email -> notes = $body;
		$email -> to = $biller['email'];
		$email -> from = "simpleinvoices@localhost.localdomain";
		$email -> subject = 'ACH -Instant Payment Notification - Recieved Payment';
		$email -> send ();

		$xml_message['data'] .= $body;
	}
} else {

	$xml_message .= "ACH validate failed" ;
	$logger->log('ACH validate failed', Zend_Log::INFO);
}

header('Content-type: application/xml');
try 
{
    $xml = new encode();
    $xml->xml( $xml_message );
    echo $xml;
} 
catch (Exception $e) 
{
    echo $e->getMessage();
}

