<?php
    $code = \App\Setting::select('google_analytics_code')->first();
    if($code == null) {
        echo "";
    } else {
        echo $code->google_analytics_code;
    }
?>
