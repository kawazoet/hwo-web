<?php

// Skinny 呼び出し
include_once("Skinny.php");

// スケジュールを取得
$conn = pg_connect("");
$result = pg_query($conn, "select date,start_time,end_time,menu,note from schedule where date >= to_char(current_timestamp, 'yyyymmdd')::integer order by date,start_time");

// Skinnyへ渡す配列宣言
$out = array();

// 取得したレコードごとの処理
while( $arr = pg_fetch_array($result) ){
    $schedule = array();
    
    $date = $arr["date"];
    // 日付
    $time_array = sscanf($date, "%4d%02d%02d");
    $year  = $time_array[0];
    $month = $time_array[1];
    $day   = $time_array[2];
    
    $schedule["DATE"] = "$year/$month/$day";
    
    // 時刻
    $s_hour = floor( $arr["start_time"] / 100 );
    $s_min  = $arr["start_time"] % 100;
    $e_hour = floor( $arr["end_time"] / 100 );
    $e_min  = $arr["end_time"] % 100;
    $TIME_BUF = sprintf("$s_hour:%02d - $e_hour:%02d", $s_min, $e_min);
    
    $schedule["TIME"] = $TIME_BUF;
    
    // 内容、備考
    $schedule["MENU"] = $arr["menu"];
    $schedule["NOTE"] = $arr["note"];
    
    // 出力内容をセット
    $out['SCHEDULE'][] = $schedule;
}

// $outの内容をSkinnyで出力
$Skinny->SkinnyDisplay("index.html", $out);

?>
