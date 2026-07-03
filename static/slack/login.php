<?php

ini_set('display_errors', "On");

require_once("common.php");

$conn = connect_db();

if(!isset($_GET["code"])) {
    echo 'codeがありません';
    exit;
}

// .envから読み込み
loadEnv(__DIR__ . '/.env');
$url = $_ENV['SLACK_WEBHOOK_URL'];
$client_id = $_ENV['SLACK_CLIENT_ID'];
$client_secret = $_ENV['SLACK_CLIENT_SECRET'];

$param = [
    "client_id" => $client_id,
    "client_secret" => $client_secret
];

$param["code"] = $_GET["code"];

$curl = curl_init($url . "?" . http_build_query($param));
curl_setopt_array($curl, [CURLOPT_HTTPGET => true, CURLOPT_RETURNTRANSFER => true]);
$json = curl_exec($curl);
curl_close($curl);

$result = json_decode($json);

if (!$result){
    echo "ログイン失敗<br />",PHP_EOL;
    exit;
    
} else {
    $slack_name   = $result->user->name;
    $slack_id     = $result->user->id;
    $slack_atoken = $result->access_token;

    // echo "ログイン成功<br />",PHP_EOL;
    // echo "$slack_name さんようこそ<br />",PHP_EOL;
    // echo "id: $slack_id<br />",PHP_EOL;
    // echo "アクセストークンは $slack_atoken です<br />", PHP_EOL;
    
    session_start();
    $_SESSION['atoken'] = $slack_atoken;
    
    // セッション情報を取得する
    $db_arr = select_session($conn, $slack_atoken);
    if (!$db_arr) {
        // レコードなし→新規のログイン
        // セッション情報を追加する
        $result = insert_session($conn, $slack_atoken, $slack_id, $slack_name);
    }
    
    header('Location: index.php');
}

?>
