<?php
//stop the direct browsing to this file - let index.php handle which files get displayed
checkLogin();

#get the invoice id
$product_id = $_GET['id'];

$product = getProduct($product_id);

#get custom field labels
$customFieldLabel = getCustomFieldLabels();

$smarty -> assign('product',$product);
$smarty -> assign('customFieldLabel',$customFieldLabel);

$smarty -> assign('pageActive', 'product_manage');
$smarty -> assign('active_tab', '#product');
