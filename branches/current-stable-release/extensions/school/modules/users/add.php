<?php

//stop the direct browsing to this file - let index.php handle which files get displayed
checkLogin();


#get custom field labels
//$customFieldLabel = getCustomFieldLabels();

//if valid then do save
if ($_POST['name'] != "" ) {
	include("./extensions/school/modules/subject/save.php");
}
$pageActive = "options";

$smarty->assign('pageActive', $pageActive);
//$smarty -> assign('customFieldLabel',$customFieldLabel);
$smarty -> assign('save',$save);
?>
