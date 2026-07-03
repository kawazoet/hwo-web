<?php

// Skinny 呼び出し
include_once("Skinny.php");

// エスケープ
$id = (int)$_POST["id"];

// 値のチェックはいいかげん
$date = sprintf("%4d%02d%02d", $_POST["year"], $_POST["month"], $_POST["day"]);
$start_time = sprintf("%02d%02d", $_POST["start_hour"], $_POST["start_min"]);
$end_time   = sprintf("%02d%02d", $_POST["end_hour"], $_POST["end_min"]);

// エスケープ
$menu = pg_escape_string( $_POST["menu"] );
$note = pg_escape_string( $_POST["note"] );

$conn = pg_connect("");
$sql = "update schedule set date='$date', start_time='$start_time', end_time='$end_time', menu='$menu', note='$note' where id=$id";
pg_query($conn, $sql);

// Skinnyで出力
$Skinny->SkinnyDisplay("./template/edit2.html");

?>
