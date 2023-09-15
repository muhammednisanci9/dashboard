<?php
include 'adming/islem.php';


	$engelkulipsor= $db->prepare("SELECT * FROM logengelip");
	$engelkulipsor->execute();
	$engelkulipcek=$engelkulipsor->fetch(PDO::FETCH_ASSOC);

	$gelen_ip = $_SERVER['REMOTE_ADDR'];
	$engellenen_ip =$engelkulipcek['engel_ip'];

	if($gelen_ip==$engellenen_ip){
		Header("Location:https://www.google.com");
	}


$kuladises = $_SESSION['kuladi'];

if(isset($_SESSION['kuladi'])){
}else{
	Header("Location:giris.php");
}

$kulsor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:kullanici_mail");
$kulsor->execute([
	'kullanici_mail' => $kuladises
]);
$kulcek = $kulsor->fetch(PDO::FETCH_ASSOC);

// include 'log.php';


// saat değişkenleri başlangıç
$bugun = date("Y-m-d 00:00:00");
$suan = date("Y-m-d H:i:s");

// saat değişkenleri bitiş



		function logdurum($logip){
			GLOBAL $db;
			$zaman = date("Y-m-d H:i:s", time()-600);
			$logdurumsor = $db->prepare("SELECT * FROM log WHERE log_ip='$logip' AND log_zaman > '$zaman'");
			$logdurumsor->execute();
			$logdurumsay=$logdurumsor->rowCount();
			if($logdurumsay > 0){
				return 1;
			}else{
				return 0;
			}
		}







 ?>