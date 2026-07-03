<?php

include_once("common.php");
// Skinny 呼び出し
include_once("Skinny.php");

// POSTされた値を取得
$name     = $_POST['name'];
$address  = $_POST['address'];
$address2 = $_POST['address2'];
$body     = $_POST['body'];

// セッションの開始
session_start();

// セッションに値を取得
$_SESSION['name']     = $name;
$_SESSION['address']  = $address;
$_SESSION['address2'] = $address2;
$_SESSION['body']     = $body;

// バリデーション
if( strlen($name) == 0 ){
    // メールアドレスが未入力
    $_SESSION["message"] = "お名前を入力してください。";
    // 入力画面へ遷移する
    refresh('index.php');
}

if( strlen($address) == 0 ){
    // メールアドレスが未入力
    $_SESSION["message"] = "メールアドレスを入力してください。";
    // 入力画面へ遷移する
    refresh('index.php');
}

if( $address != $address2 ){
    // メールアドレスが不一致
    $_SESSION["message"] = "入力されたメールアドレスが一致しません。";
    // 入力画面へ遷移する
    refresh('index.php');
}

if( strlen($body) == 0 ){
    // 本文が未入力
    $_SESSION["message"] = "本文を入力してください。";
    // 入力画面へ遷移する
    refresh('index.php');
}

// トークンを発行
$token = uniqid("HOKUSETSU");
$_SESSION['TOKEN'] = $token;

// Skinnyへ渡す配列宣言
$out = array();
// セッションの値を$outに設定
$out['NAME']     = $name;
$out['ADDRESS']  = $address;
$out['BODY']     = $body;
$out['TOKEN']    = $token;

// $outの内容をSkinnyで出力
$Skinny->SkinnyDisplay("confirm.html", $out);

?>
