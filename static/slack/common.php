<?php

// データベースへの接続を行う
function connect_db()
{
    return pg_connect("");
}

// セッション情報を取得する
function select_session($conn, $atoken)
{
    $result = pg_query_params($conn, "select id, name from session_info where atoken=$1", array($atoken));
    $db_arr = pg_fetch_array($result);
    return $db_arr;
}

// セッション情報を追加する
function insert_session($conn, $atoken, $id, $name)
{
    $result = pg_query_params($conn, "insert into session_info(atoken, id, name, ctime) values($1, $2, $3, 'now')",
                              array($atoken, $id, $name));
    return $result;
}

// ログイン中かどうかをチェックし、無効であればログイン画面に遷移する
function check_login($conn)
{
    session_start();
    $atoken = $_SESSION['atoken'];
    
    $db_arr = select_session($conn, $atoken);
    
    if (!$db_arr) {
        header('Location: https://hokusetsu-wind.com/slack/login.html');
        exit;
    }
    
    return $db_arr;
}

?>
