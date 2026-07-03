<?php

// Skinny 呼び出し
include_once("Skinny.php");

// エスケープ
$id = (int)$_GET["id"];

// スケジュールを取得
$conn = pg_connect("");
$result = pg_query($conn, "select date,start_time,end_time,menu,note from schedule where id=$id");
$arr = pg_fetch_array($result);

// Skinnyへ渡す配列宣言
$out = array();

// 日付
$time_array = sscanf($arr["date"], "%4d%02d%02d");
$year  = $time_array[0];
$month = $time_array[1];
$day   = $time_array[2];

$out['YEAR']  = "$year";
$out['MONTH'] = "$month";
$out['DAY']   = "$day";

// 時刻
$s_hour = floor( $arr["start_time"] / 100 );
$s_min  = $arr["start_time"] % 100;
$e_hour = floor( $arr["end_time"] / 100 );
$e_min  = $arr["end_time"] % 100;

$out['STARTHOUR'] = "$s_hour";
$out['STARTMIN']  = "$s_min";
$out['ENDHOUR']   = "$e_hour";
$out['ENDMIN']    = "$e_min";

// 内容、備考
$out['MENU'] = $arr["menu"];
$out['NOTE'] = $arr["note"];

// ID
$out['ID'] = $id;

// $outの内容をSkinnyで出力
$Skinny->SkinnyDisplay("./template/edit.html", $out);

?>
