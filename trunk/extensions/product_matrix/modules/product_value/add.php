<?php


//stop the direct browsing to this file - let index.php handle which files get displayed
checkLogin();

//if valid then do save
if ($_POST['p_description'] != "" ) {
	include("./modules/preferences/save.php");
}
$pageActive = "options";

$smarty->assign('pageActive', $pageActive);
$smarty -> assign('save',$save);
?>
