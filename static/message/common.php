<?php

// meta refreshを利用して画面を遷移させる。(実行を打ち切る。)
function refresh( $url )
{
    print '<html><head><meta http-equiv="Refresh" content="0;URL=' . $url . '"></head></html>';
    exit();
}

?>
