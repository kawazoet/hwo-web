<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

include_once("common.php");
// Skinny 呼び出し
include_once("Skinny.php");

// セッションの開始
session_start();

// Skinnyへ渡す配列宣言
$out = array();

// メッセージの設定とクリア
$message = $_SESSION['message'];
if( strlen($message) > 0 ){
  $out['MESSAGE']  = $message;
}
$_SESSION['message'] = "";

// セッションの値を$outに設定
$out['NAME']     = $_SESSION['name'];
$out['ADDRESS']  = $_SESSION['address'];
$out['ADDRESS2'] = $_SESSION['address2'];
$out['BODY']     = $_SESSION['body'];

// $outの内容をSkinnyで出力
$Skinny->SkinnyDisplay("index.html", $out);

?>
