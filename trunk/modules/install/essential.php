<?php
//JSON import

//SQL import
$import = new import();
$import->file = "./databases/MySQL/1-Structure.sql";
$import->pattern_find = "si_";
$import->pattern_replace = TB_PREFIX;
//dbQuery($import->collate());
$db1 = new db();
$db1->query($import->collate());


$importjson = new importjson();
$importjson->file = "./databases/JSON/EssentialData.json";
//$importjson->debug = true;
$importjson->pattern_find = "si_";
$importjson->pattern_replace = TB_PREFIX;
//dbQuery($importjson->collate());
$db2 = new db();
$db2->query($importjson->collate());

$menu = false;
?>
