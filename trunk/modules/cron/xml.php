<?php

header("Content-type: text/xml");

//$start = (isset($_POST['start'])) ? $_POST['start'] : "0" ;
$dir = (isset($_POST['sortorder'])) ? $_POST['sortorder'] : "DESC" ;
$sort = (isset($_POST['sortname'])) ? $_POST['sortname'] : "id" ;
$rp = (isset($_POST['rp'])) ? $_POST['rp'] : "25" ;
$page = (isset($_POST['page'])) ? $_POST['page'] : "1" ;

//$sql = "SELECT * FROM ".TB_PREFIX."invoices LIMIT $start, $limit";
$cron = new cron();
$cron->sort=$sort;
$crons = $cron->select_all('', $dir, $rp, $page);
$sth_count_rows = $cron->select_all('count',$dir, $rp, $page);


$xml ="";
$count = $sth_count_rows;

	$xml .= "<rows>";
	$xml .= "<page>$page</page>";
	$xml .= "<total>$count</total>";
	
	foreach ($crons as $row) {
		$xml .= "<row id='".$row['id']."'>";
		$xml .= "<cell><![CDATA[
		<a class='index_table' title='$LANG[view] ".$row['name']."' href='index.php?module=cron&view=details&id=$row[id]&action=view'><img src='images/common/view.png' height='16' border='-5px' padding='-4px' valign='bottom' /></a>
		<a class='index_table' title='$LANG[edit] ".$row['name']."' href='index.php?module=cron&view=details&id=$row[id]&action=edit'><img src='images/common/edit.png' height='16' border='-5px' padding='-4px' valign='bottom' /></a>
		]]></cell>";
		$xml .= "<cell><![CDATA[".$row['index_name']."]]></cell>";		
		#$xml .= "<cell><![CDATA[".siLocal::date($row['start_date'])."]]></cell>";
		#$xml .= "<cell><![CDATA[".siLocal::date($row['end_date'])."]]></cell>";
		$xml .= "<cell><![CDATA[".$row['start_date']."]]></cell>";
		$xml .= "<cell><![CDATA[".$row['end_date']."]]></cell>";
		$xml .= "<cell><![CDATA[".$row['recurrence']."]]></cell>";
		$xml .= "<cell><![CDATA[".$row['recurrence_type']."]]></cell>";
		$xml .= "<cell><![CDATA[".$row['email_biller']."]]></cell>";
		$xml .= "<cell><![CDATA[".$row['email_customer']."]]></cell>";
		$xml .= "</row>";		
	}
	$xml .= "</rows>";

echo $xml;
?> 
