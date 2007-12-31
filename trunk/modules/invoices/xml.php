<?php
//Developed by -==[Mihir Shah]==- during my Project work
//for the output
header("Content-type: text/xml");

$start = (isset($_POST['start'])) ? $_POST['start'] : "0" ;
$dir = (isset($_POST['dir'])) ? $_POST['dir'] : "DESC" ;
$sort = (isset($_POST['sort'])) ? $_POST['sort'] : "id" ;
$limit = (isset($_POST['limit'])) ? $_POST['limit'] : "25" ;

//SC: Safety checking values that will be directly subbed in
if (intval($start) != $start) {
	$start = 0;
}
if (intval($limit) != $limit) {
	$limit = 25;
}
if (!preg_match('/^(asc|desc)$/iD', $dir)) {
	$dir = 'DESC';
}

/*Check that the sort field is OK*/
$validFields = array('id', 'Biller', 'Customer', 'INV_TOTAL','INV_PAID','INV_OWING','Date','Age','Aging','Type');

if (in_array($sort, $validFields)) {
	$sort = $sort;
} else {
	$sort = "id";
}
/*Sort field check end*/

if ($db_server == 'pgsql') {
	$sql = "
SELECT
 iv.id,
 b.name AS Biller,
 c.name AS Customer,
 sum(ii.total) AS INV_TOTAL,
 coalesce(SUM(ap.ac_amount), 0)  AS INV_PAID,
 (SUM(ii.total) - coalesce(sum(ap.ac_amount), 0)) AS INV_OWING ,
 to_char(date,'YYYY-MM-DD') AS Date ,
 (SELECT now()::date - iv.date) AS Age,
 (CASE WHEN now()::date - iv.date <= '14 days'::interval THEN '0-14'
  WHEN now()::date - iv.date <= '30 days'::interval THEN '15-30'
  WHEN now()::date - iv.date <= '60 days'::interval THEN '31-60'
  WHEN now()::date - iv.date <= '90 days'::interval THEN '61-90'
  ELSE '90+'
 END) AS Aging,
 p.pref_description AS Type
FROM
 si_invoices iv
 LEFT JOIN si_account_payments ap ON ap.ac_inv_id = iv.id
 LEFT JOIN si_invoice_items ii ON ii.invoice_id = iv.id
 LEFT JOIN si_biller b ON b.id = iv.biller_id
 LEFT JOIN si_customers c ON c.id = iv.customer_id
 LEFT JOIN si_preferences p ON p.pref_id = iv.preference_id
GROUP BY
 iv.id, b.name, c.name, date, age, aging, type
ORDER BY
 $sort $dir 
LIMIT $limit OFFSET $start";
} else {
	$sql ="
SELECT  iv.id,  
	b.name AS Biller,  
	c.name AS Customer,  
	@invt:=(SELECT SUM(coalesce(ii.total,  0)) FROM si_invoice_items ii WHERE ii.invoice_id = iv.id) AS INV_TOTAL,  
	@invp:=(SELECT SUM(coalesce(ac_amount, 0)) FROM si_account_payments ap WHERE ap.ac_inv_id = iv.id) AS INV_PAID,  
	(SELECT (coalesce(@invt,0) - coalesce(@invp,0))) As INV_OWING,
	DATE_FORMAT(date,'%Y-%m-%d') AS Date,  
	(SELECT DateDiff(now(),date)) AS Age,  
	(CASE 	WHEN DateDiff(now(),date) <= 14 THEN '0-14'   
		WHEN DateDiff(now(),date) <= 30 THEN '15-30'   
		WHEN DateDiff(now(),date) <= 60 THEN '31-60'   
		WHEN DateDiff(now(),date) <= 90 THEN '61-90'   
		ELSE '90+'  END) AS Aging,  
	pf.pref_description AS Type 
FROM  	si_invoices iv	
		LEFT JOIN si_biller b ON b.id = iv.biller_id  
		LEFT JOIN si_customers c ON c.id = iv.customer_id  
		LEFT JOIN si_preferences pf ON pf.pref_id = iv.preference_id
ORDER BY
 $sort $dir 
LIMIT $start, $limit";
}

global $dbh;
$sth = dbQuery($sql) or die(end($dbh->errorInfo()));

$sqlTotal = "SELECT count(id) AS count FROM ".TB_PREFIX."invoices";
$tth = $dbh->prepare($sqlTotal);
$resultCount = $tth->fetch();
$count = $resultCount[0];
echo sql2xml($sth, $count, 'test');

?> 
