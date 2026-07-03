<?php

// Skinny 呼び出し
include_once("Skinny.php");

// 値のチェックはいいかげん
$date = sprintf("%4d%02d%02d", $_POST["year"], $_POST["month"], $_POST["day"]);
$start_time = sprintf("%02d%02d", $_POST["start_hour"], $_POST["start_min"]);
$end_time   = sprintf("%02d%02d", $_POST["end_hour"], $_POST["end_min"]);

// エスケープ
$menu = pg_escape_string( $_POST["menu"] );
$note = pg_escape_string( $_POST["note"] );

$conn = pg_connect("");
$sql = "insert into schedule (date,start_time,end_time,menu,note) values ($date,$start_time,$end_time,'$menu','$note')";
pg_query($conn, $sql);

// Skinnyで出力
$Skinny->SkinnyDisplay("./template/regist.html");

?>
