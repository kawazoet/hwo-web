<?php

ini_set('display_errors', "On");

require_once("common.php");

$conn = connect_db();

check_login($conn);

$filename = $_GET["filename"];
$filename = basename($filename);

// 拡張子を判定
$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

switch ($ext) {
    case 'pdf':
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=\"$filename\"");
        break;
    case 'zip':
        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        break;
    default:
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        break;
}

readfile("/home/hokusetsu/file/$filename");

?>
