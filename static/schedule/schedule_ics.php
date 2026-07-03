<?php

// Skinny 呼び出し
include_once("Skinny.php");

// ICSファイルとして出力
header('Content-Type: text/calendar; charset=UTF-8');
header('Content-Disposition: attachment; filename="schedule.ics"');

// スケジュールを取得
$conn = pg_connect("");
$result = pg_query($conn, "select date,start_time,end_time,menu,note from schedule where date >= to_char(current_timestamp, 'yyyymmdd')::integer order by date,start_time");

// Skinnyへ渡す配列宣言
$out = array();

// 取得したレコードごとの処理
while( $arr = pg_fetch_array($result) ){
    $schedule = array();
    
    $date       = $arr[0];
    $start_time = $arr[1];
    $end_time   = $arr[2];
    $menu       = $arr[3];
    $note       = $arr[4];
    
    $schedule["STARTTIME"] = "${date}T${start_time}00";
    $schedule["ENDTIME"]   = "${date}T${end_time}00";
    $schedule["MENU"]      = $menu;
    $schedule["NOTE"]      = $note;
    
    // 出力内容をセット
    $out['SCHEDULE'][] = $schedule;
}

// $outの内容をSkinnyで出力
$Skinny->SkinnyDisplay("schedule_ics.tmpl", $out);

?>
