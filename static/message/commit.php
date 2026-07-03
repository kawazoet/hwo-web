<?php

// 設定ファイルを読み込む
function loadEnv($path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}

include_once("common.php");
// Skinny 呼び出し
include_once("Skinny.php");

// セッションの開始
session_start();

// セッションより値を取得
$name     = $_SESSION['name'];
$address  = $_SESSION['address'];
$body     = $_SESSION['body'];

// トークンのチェック
$sv_token = $_SESSION['TOKEN'];
$cli_token = $_POST['TOKEN'];

// バリデーション
if( $sv_token != $cli_token ){
    // トークンが不一致
    $_SESSION["message"] = "正しくない操作が行われました。"
    . "(SV: " . $sv_token . ", CL: " . $cli_token . ")";
    // 入力画面へ遷移する
    refresh('message.php');
}

// 本文の作成
date_default_timezone_set('Asia/Tokyo');
$date = date("Y/m/d H:i:s");
$mail_body =  $body . "\n" .
             "---\n" .
             "日時:           $date \n" .
             "リモートホスト:  " . $_SERVER["REMOTE_ADDR"] . "\n" .
             "エージェント:    " . $_SERVER["HTTP_USER_AGENT"] . "\n" .
             "氏名:            " . $name. "\n" .
             "アドレス:        " . $address . "\n" .
             "---\n";

// .envから読み込み
loadEnv(__DIR__ . '/.env');
$webhook_url = $_ENV['SLACK_WEBHOOK_URL'];
$mail1 = $_ENV['MAIL_TO_1'];
$mail2 = $_ENV['MAIL_TO_2'];
$mail3 = $_ENV['MAIL_TO_3'];
$mail4 = $_ENV['MAIL_TO_4'];

// 送信
mb_send_mail($mail1, "[北摂] メッセージ", $mail_body);
mb_send_mail($mail2, "[北摂] メッセージ", $mail_body);
mb_send_mail($mail3, "[北摂] メッセージ", $mail_body);
mb_send_mail($mail4, "[北摂] メッセージ", $mail_body);


//// Slackへの投稿ではメールアドレスを非表示にする。

// SemrushBot チェック
$user_agent = $_SERVER["HTTP_USER_AGENT"];
if (strpos($user_agent, "SemrushBot") !== false) {
    // セッションの破棄
    session_unset();

    // Skinnyで出力（必要に応じてスキップ可能）
    $Skinny->SkinnyDisplay("message3.html");

    // Slackを送信せずに終了
    exit;
}


$slack_body =  $body . "\n" .
             "---\n" .
             "日時:           $date \n" .
             "リモートホスト:  " . $_SERVER["REMOTE_ADDR"] . "\n" .
             "エージェント:    " . $_SERVER["HTTP_USER_AGENT"] . "\n" .
             "氏名:            " . $name. "\n" .
             "---\n";


$url = $webhook_url;
$message = [
    'channel' => '#問い合わせ',
    'text' => $slack_body,
];

$ch = curl_init();
$options = [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query([
        'payload' => json_encode($message)
    ])
];
curl_setopt_array($ch, $options);
curl_exec($ch);
curl_close($ch);

// セッションの破棄
session_unset();

// Skinnyで出力
$Skinny->SkinnyDisplay("commit.html");

?>
