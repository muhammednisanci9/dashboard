<?php

    function logtakip(){
        GLOBAL $db;
        $logSayfa = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        if(isset($_SERVER['HTTP_REFERER'])){
            $logOncekiSayfa = $_SERVER['HTTP_REFERER'];
        }else {
            $logOncekiSayfa = 'Direk';
        }
        $logDil = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
        $logIp = $_SERVER['REMOTE_ADDR'];
        $logZaman =date("Y-m-d H:i:s");
        $logNasil = $_POST['nasil'];


        $logsor=$db->prepare("INSERT INTO log SET
            log_suanSayfa=:logSuanSayfa,
            log_oncekiSayfa=:logOncekiSayfa,
            log_dil=:logDil,
            log_ip=:logIp,
            log_zaman=:logZaman,
            log_nasil=:log_nasil
        ");
        $logsor->execute([
            'logSuanSayfa' => $logSayfa,
            'logOncekiSayfa' => $logOncekiSayfa,
            'logDil' => $logDil,
            'logIp' => $logIp,
            'logIp' => $logIp,
            'log_nasil' => $logNasil
        ]);

    }

    logtakip();

?>