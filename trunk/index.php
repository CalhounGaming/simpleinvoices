<?php

/*
* Script: index.php
* 	Main controller file for Simple Invoices
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


//stop browsing to files directly - all viewing to be handled by index.php
//if browse not defined then the page will exit
define("BROWSE","browse");

//keeps the old path
set_include_path(get_include_path() . PATH_SEPARATOR . "./include". PATH_SEPARATOR . "./library");

$module = isset($_GET['module'])?$_GET['module']:null;
$view = isset($_GET['view'])?$_GET['view']:null;
$action = isset($_GET['case'])?$_GET['case']:null;


require_once("smarty/Smarty.class.php");
require_once("./include/functions.php");

$smarty = new Smarty();

//cache directory. Have to be writeable (chmod 777)
$smarty -> compile_dir = "cache";
if(!is_writable($smarty -> compile_dir)) {
	simpleInvoicesError("cache", $smarty -> compile_dir);
	//exit("Simple Invoices Error : The folder <i>".$smarty -> compile_dir."</i> has to be writeable");
}


//adds own smarty plugins
$smarty->plugins_dir = array("plugins","smarty_plugins");

require_once("./include/include_main.php");

$smarty -> assign("authenticationOn",$authenticationOn); // to toggle the login / logout button visibility in the menu
$smarty -> assign("module",$module);


$smarty -> assign("LANG",$LANG);
//For Making easy enabled pop-menus (see biller)
$smarty -> assign("enabled",array($LANG['disabled'],$LANG['enabled']));

$menu = true;
//$menu = false;
$file = "home";

// Check for any unapplied SQL patches when going home
if (($module == "options") && ($view == "database_sqlpatches")) {
	include_once('./modules/options/database_sqlpatches.php');
	donePatches();
} elseif ($file == 'home') {
	include_once('./modules/options/database_sqlpatches.php');
	if (getNumberOfPatches() > 0 ) {
		$view = "database_sqlpatches";
		$module = "options";
		
		if($action == "run") {
			runPatches();
		} else {
			listPatches();
		}
		$menu = false;
	}
}

/*dont include the header if requested file is an invoice template - for print preview etc.. header is not needed */

if (($module == "invoices" ) && (strstr($view,"templates"))) {
	//TODO: why is $view templates/template?...
	if (file_exists("./modules/invoices/template.php")) {
	        include("./modules/invoices/template.php");
	}
	else {
		echo "The file that you requested doesn't exist";
	}
	
	exit(0);
}

//xml for the new grid
if (($module == "invoices" ) && (strstr($view,"xml"))) {
	if (file_exists("./modules/invoices/xml.php")) {
		include("./modules/invoices/xml.php");
	}
	else {
		echo "The file that you requested doesn't exist";
	}
	
	exit(0);

}
$path = "$module/$view";

if(file_exists("./modules/$path.php")) {
	
	preg_match("/^[a-z|A-Z|_]+\/[a-z|A-Z|_]+/",$path,$res);

	if(isset($res[0]) && $res[0] == $path) {
		$file = $path;
	}	
}



$smarty -> display("../templates/default/header.tpl");
//temp added menu.tpl back in so we can easily design new menu system


include_once("./modules/$file.php");

//TODO - remove menu and main
//old main file no longer needed
if($menu) {
	//getMenuStructure();
	$smarty -> display("../templates/default/menu.tpl");
}

$smarty -> display("../templates/default/main.tpl");
//Shouldn't be necessary anymore. Ist for old files without tempaltes...

if(file_exists("./templates/default/$file.tpl")) {
	
	$path = "../templates/default/$module/";
	$smarty->assign("path",$path);
	$smarty -> display("../templates/default/$file.tpl");
}
// If no smarty template - add message - onyl uncomment for dev - commented out for release
else {
	error_log("NOTEMPLATE!!!");
}

// not needed
$smarty -> display("../templates/default/footer.tpl");


?>
