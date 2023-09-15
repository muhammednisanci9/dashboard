<?php
    try{
        $db = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8","root","");
    }catch(PDOException $e){
        echo "VT bağlantında hata oluştu.".$e->getmessage();
        die();
    }
?>


