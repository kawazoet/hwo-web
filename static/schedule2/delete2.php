<?php

// Skinny 呼び出し
include_once("Skinny.php");

// エスケープ
$id = (int)$_GET["id"];

// スケジュールを削除
$conn = pg_connect("");
$sql = "delete from schedule where id=$id";
pg_query($conn, $sql);

// Skinnyで出力
$Skinny->SkinnyDisplay("./template/delete2.html");

?>
