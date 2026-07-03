<?php

ini_set('display_errors', "On");

require_once("common.php");
include_once("Skinny.php");

$conn = connect_db();

$db_arr = check_login($conn);

$db_id   = $db_arr["id"];
$db_name = $db_arr["name"];

// $outの内容をSkinnyで出力
$out = array();
$out['NAME'] = $db_name;
$Skinny->SkinnyDisplay("index.html.tmpl", $out);

?>
