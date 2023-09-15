<?php  
ob_start();
session_start();
include 'connect.php';

function guvenlik($veri){
	$ilkGuvenlik = trim($veri);
	$ikinciGunvenlik = strip_tags($ilkGuvenlik);
	$ucuncuGuvenlik = htmlspecialchars($ikinciGunvenlik, ENT_QUOTES);
	$dorduncuGuvenlik = addslashes($ucuncuGuvenlik);
	$sonucGuvenlik = $dorduncuGuvenlik;
	return $sonucGuvenlik;
}


// if (isset($_POST['admingiris'])) {
// 	$adminsor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:kullanici_mail");
// 	$adminsor->execute([
// 		'kullanici_mail' => $_POST['kullanici_mail']
// 	]);
// 	$admincek=$adminsor->fetch(PDO::FETCH_ASSOC);

// 	$admin_mail_gelen = guvenlik($_POST['kullanici_mail']);
// 	$admin_sifre_gelen = guvenlik($_POST['kullanici_sifre']);	


// 	$admin_mail = $admincek['kullanici_mail'];
// 	$admin_sifre = $admincek['kullanici_sifre'];
// 	$admin_durum = $admincek['kullanici_durum'];

// 	if($admin_mail_gelen===$admin_mail && $admin_sifre_gelen===$admin_sifre && $admin_durum==='14'){
// 		echo $_SESSION['admin_mail']=$admin_mail_gelen;
// 		Header("Location:../dash/index.php");
// 	}else{
// 		Header("Location:../dash/login.php");
// 	}
// }

if(isset($_POST['giris'])){

	$gelenkuladi = guvenlik($_POST['kullanici_mail']);
	$gelenkulsifre = guvenlik($_POST['kullanici_sifre']);

	$girissor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:kullanici_mail");
	$girissor->execute([
		'kullanici_mail' => $gelenkuladi
	]);

	$giriscek = $girissor->fetch(PDO::FETCH_ASSOC);

	$kuladi = guvenlik($giriscek['kullanici_mail']);
	$kulsifre = guvenlik($giriscek['kullanici_sifre']);
	$kuldurum = guvenlik($giriscek['kullanici_durum']);

	if($gelenkuladi == $kuladi && $gelenkulsifre == $kulsifre && $kuldurum == 14){
		$_SESSION['kuladi']=$gelenkuladi;
		Header("Location:../anasayfa");
	}else{
		Header("Location:../giris");
	}
}




if(isset($_POST['iletisimgor'])){
	$iletisimgelenid = guvenlik($_POST['iletisim_id']);
	$iletisimgorsor = $db->prepare("UPDATE iletisim SET
		iletisim_durum=:iletisim_durum
		WHERE iletisim_id=:iletisim_id
	");
	$iletisimgorsor->execute([
		'iletisim_durum' => 1,
		'iletisim_id' => $iletisimgelenid
	]);
	if($iletisimgorsor){
		Header("Location:../iletisimdetay?iletisim_id=$iletisimgelenid");
	}else{
		Header("Location:../iletisimlist");
	}
}


if(isset($_POST['iletisimsil'])){
	$iletisimsilsor = $db->prepare("DELETE FROM iletisim WHERE iletisim_id=:iletisim_id");
	$iletisimsilsor->execute([
		"iletisim_id" => guvenlik($_POST['iletisim_id'])
	]);
	if($iletisimsilsor){
		Header("Location:../iletisimlist?silme=basarili");
	}else{
		Header("Location:../iletisimlist?silme=basarisiz");
	}
}



if(isset($_POST['iletisimgonder'])){
	if(!empty($_POST['iletisim_adsoyad']) && !empty($_POST['iletisim_mail']) && !empty($_POST['iletisim_tel']) && !empty($_POST['iletisim_konu']) && !empty($_POST['iletisim_icerik'])){
		$iletisimsor = $db->prepare("INSERT INTO iletisim SET
			iletisim_adsoyad=:iletisim_adsoyad,
			iletisim_mail=:iletisim_mail,
			iletisim_tel=:iletisim_tel,
			iletisim_konu=:iletisim_konu,
			iletisim_icerik=:iletisim_icerik,
			iletisim_ip=:iletisim_ip
		");
		$iletisimsor->execute([
			'iletisim_adsoyad' => guvenlik($_POST['iletisim_adsoyad']),
			'iletisim_mail' => guvenlik($_POST['iletisim_mail']),
			'iletisim_tel' => guvenlik($_POST['iletisim_tel']),
			'iletisim_konu' =>guvenlik($_POST['iletisim_konu']),
			'iletisim_icerik' => guvenlik($_POST['iletisim_icerik']),
			'iletisim_ip' => $_SERVER['REMOTE_ADDR']
		]);
		if($iletisimsor){
			$url=$_SERVER['HTTP_REFERER'];
			Header("Location:".$url."?iletisim=basarili");
		}else{
			$url=$_SERVER['HTTP_REFERER'];
			Header("Location:".$url."?iletisim=basarisiz");
		}
	}else{
		$url=$_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?iletisim=basarisiz");
	}
}




if(isset($_POST['profileguncelle'])){

	if($_FILES['kullanici_resim']['error']==0){
		$logo_yol = "../img/ayar/";
		$logo_isim = $_FILES['kullanici_resim']['name'];
		$logo_type = $_FILES['kullanici_resim']['type'];
		$logo_gecisim = $_FILES['kullanici_resim']['tmp_name'];
		$logo_boyut = $_FILES['kullanici_resim']['size'];
		$logo_randsayi = rand(1,100000);
		
		$logo_ayirisim = explode(".", $logo_isim);
		$logo_ayrikisim = $logo_ayirisim['0'];

		$logo_ayirtype = explode("/", $logo_type);
		$logo_sontype = $logo_ayirtype['1'];

		$logo_kayitisim = "img/ayar/".$logo_ayrikisim.$logo_randsayi.".".$logo_sontype;

		move_uploaded_file($logo_gecisim, "../".$logo_kayitisim);
	}
		$kuladises = guvenlik($_SESSION['kuladi']);
		$kulsor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:kullanici_mail");
		$kulsor->execute([
			'kullanici_mail' => guvenlik($kuladises)
		]);
		$kulcek = $kulsor->fetch(PDO::FETCH_ASSOC);

		if(empty($logo_kayitisim)){
			$logo_kayitisim = $kulcek['kullanici_resim'];
		}




	$profileguncelle = $db->prepare("UPDATE kullanici SET
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_mail=:kullanici_mail,
		kullanici_sifre=:kullanici_sifre,
		kullanici_resim=:kullanici_resim
		WHERE kullanici_id=:kullanici_id
	");
	$profileguncelle->execute([
		'kullanici_adsoyad' => guvenlik($_POST['kullanici_adsoyad']),
		'kullanici_mail' => guvenlik($_POST['kullanici_mail']),
		'kullanici_sifre' => guvenlik($_POST['kullanici_sifre']),
		'kullanici_id' => guvenlik($_POST['kullanici_id']),
		'kullanici_resim' => guvenlik($logo_kayitisim)
	]);
	if($profileguncelle){
		Header("Location:../profileguncelle?guncelleme=basarili");
	}else{
		Header("Location:../profileguncelle?guncelleme=basarisiz");
	}
}

if(isset($_POST['icerikkaydet'])){

		if($_FILES['icerik_resim']['error']==0){
			$resim_yol = "image/icerik/";
			$resim_isim = $_FILES['icerik_resim']['name'];
			$resim_type = $_FILES['icerik_resim']['type'];
			$resim_kabultype = ['png','jpg','webp','jpeg'];
			$resim_gecisim = $_FILES['icerik_resim']['tmp_name'];
			$resim_boyut = $_FILES['icerik_resim']['size'];
			$resim_randsayi = rand(1,100000);
			
			$resim_ayirisim = explode(".", $resim_isim);
			$resim_ayrikisim = $resim_ayirisim['0'];

			$resim_ayirtype = explode("/", $resim_type);
			$resim_sontype = $resim_ayirtype['1'];

			$uzantivarmi = in_array($resim_sontype, $resim_kabultype);
			$ucmb = 1024*1024*3;

			
			if($uzantivarmi === true){
				if ($resim_boyut < $ucmb) {
					$resim_kayitisim = $resim_yol.$resim_ayrikisim.$resim_randsayi.".".$resim_sontype;
					move_uploaded_file($resim_gecisim, "../../../".$resim_kayitisim);
				}
			}
		}
	$iceriksor = $db->prepare("INSERT INTO icerik SET
		icerik_baslik=:icerik_baslik,
		icerik_kategori_id=:icerik_kategori_id,
		icerik_genelkategori_id=:icerik_genelkategori_id,
		icerik_resim=:icerik_resim,
		icerik_resim_alt=:icerik_resim_alt,
		icerik_text=:icerik_text,
		icerik_title=:icerik_title,
		icerik_description=:icerik_description,
		icerik_keywords=:icerik_keywords,
		icerik_author=:icerik_author
	");

	$iceriksor->execute([
		'icerik_baslik' => guvenlik($_POST['icerik_baslik']),
		'icerik_kategori_id' => guvenlik($_POST['icerik_kategori_id']),
		'icerik_genelkategori_id' => guvenlik($_POST['icerik_genelkategori_id']),
		'icerik_resim' => guvenlik($resim_kayitisim),
		'icerik_resim_alt' => guvenlik($_POST['icerik_resim_alt']),
		'icerik_text' => $_POST['icerik_text'],
		'icerik_title' => guvenlik($_POST['icerik_title']),
		'icerik_description' => guvenlik($_POST['icerik_description']),
		'icerik_keywords' => guvenlik($_POST['icerik_keywords']),
		'icerik_author' => guvenlik($_POST['icerik_author'])
	]);
	if(in_array($resim_sontype, $resim_kabultype) && $resim_boyut < $ucmb){
		Header("Location:../ekle?ekleme=basarili");
	}elseif($resim_boyut > $ucmb){
		Header("Location:../ekle?ekleme=boyutbuyuk");
	}elseif($uzantivarmi === false){
		Header("Location:../ekle?ekleme=uzantiyok");
	}else{
		Header("Location:../ekle?ekleme=basarisiz");
	}
}


if(isset($_POST['iceriksil'])){
	$iceriksil = $db->prepare("DELETE FROM icerik WHERE icerik_id=:icerik_id");
	$iceriksil->execute([
		'icerik_id' => guvenlik($_POST['icerik_id'])
	]);
	if($iceriksil){
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?silme=basarili");
	}else{
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?silme=basarisiz");
	}
}


if(isset($_POST['icerikguncelle'])){

		if($_FILES['icerik_resim']){
			$resim_yol = "image/icerik/";
			$resim_isim = $_FILES['icerik_resim']['name'];
			$resim_type = $_FILES['icerik_resim']['type'];
			$resim_kabultype = ['png','jpg','webp','jpeg'];
			$resim_gecisim = $_FILES['icerik_resim']['tmp_name'];
			$resim_boyut = $_FILES['icerik_resim']['size'];
			$resim_randsayi = rand(1,100000);
			
			$resim_ayirisim = explode(".", $resim_isim);
			$resim_ayrikisim = $resim_ayirisim['0'];

			$resim_ayirtype = explode("/", $resim_type);
			$resim_sontype = $resim_ayirtype['1'];

			$uzantivarmi = in_array($resim_sontype, $resim_kabultype);
			$ucmb = 1024*1024*3;

			$icerikbosresimsor = $db->prepare("SELECT * FROM icerik WHERE icerik_id=:icerik_id");
			$icerikbosresimsor->execute([
				'icerik_id' => $_POST['icerik_id']
			]);
			$icerikbosresimcek = $icerikbosresimsor->fetch(PDO::FETCH_ASSOC);

			if(empty($resim_kayitisim)){
				$resim_kayitisim = $icerikbosresimcek['icerik_resim'];
			}


			if($uzantivarmi === true){
				if ($resim_boyut < $ucmb) {
					$resim_kayitisim = $resim_yol.$resim_ayrikisim.$resim_randsayi.".".$resim_sontype;
					move_uploaded_file($resim_gecisim, "../../../".$resim_kayitisim);
				}
			}


		}
		
	$icerikguncelle = $db->prepare("UPDATE icerik SET 
		icerik_baslik=:icerik_baslik,
		icerik_kategori_id=:icerik_kategori_id,
		icerik_genelkategori_id=:icerik_genelkategori_id,
		icerik_resim=:icerik_resim,
		icerik_resim_alt=:icerik_resim_alt,
		icerik_text=:icerik_text,
		icerik_title=:icerik_title,
		icerik_description=:icerik_description,
		icerik_keywords=:icerik_keywords,
		icerik_author=:icerik_author
		WHERE icerik_id=:icerik_id
	");
	$icerikguncelle->execute([
		'icerik_baslik' => guvenlik($_POST['icerik_baslik']),
		'icerik_kategori_id' => guvenlik($_POST['icerik_kategori_id']),
		'icerik_genelkategori_id' => guvenlik($_POST['icerik_genelkategori_id']),
		'icerik_resim' => $resim_kayitisim,
		'icerik_resim_alt' => guvenlik($_POST['icerik_resim_alt']),
		'icerik_text' => $_POST['icerik_text'],
		'icerik_title' => guvenlik($_POST['icerik_title']),
		'icerik_description' => guvenlik($_POST['icerik_description']),
		'icerik_keywords' => guvenlik($_POST['icerik_keywords']),
		'icerik_author' => guvenlik($_POST['icerik_author']),
		'icerik_id' => guvenlik($_POST['icerik_id'])
	]);

	if($icerikguncelle){
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?guncelleme=basarili");
	}else{
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?guncelleme=basarisiz");
	}
}



if(isset($_POST['yorumgonder'])){
	if(isset($_SESSION['kuladi'])){
		$yorumsor=$db->prepare("INSERT INTO yorum SET
			yorum_icerik=:yorum_icerik,
			yorum_kullanici_id=:yorum_kullanici_id,
			yorum_icerik_id=:yorum_icerik_id
		");
		$yorumsor->execute([
			'yorum_icerik' => guvenlik($_POST['yorum_icerik']),
			'yorum_kullanici_id' => guvenlik($_POST['yorum_kullanici_id']),
			'yorum_icerik_id' => guvenlik($_POST['yorum_icerik_id'])
		]);

		$url = $_SERVER['HTTP_REFERER'];

		if($yorumsor){
			Header("Location: ".$url."?yorum=basarili#icerikyorum");
		}else{
			Header("Location: ".$url."?yorum=basarisiz#icerikyorum");
		}
	}else {
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location: ".$url."?yorum=uzgun#icerikyorum");
	}
}

if(isset($_POST['yorumsil'])){
	$yorumsil = $db->prepare("DELETE FROM yorum WHERE yorum_id=:yorum_id");
	$yorumsil->execute([
		'yorum_id' => $_POST['yorum_id']
	]);
	if($yorumsil){
		Header("Location:../yorumlist?silme=basarili");
	}else{
		Header("Location:../yorumlist?silme=basarisiz");
	}
}

if(isset($_POST['yorumonayla'])){
	$yorumonay = $db->prepare("UPDATE yorum SET 
		yorum_durum=:yorum_durum
		WHERE yorum_id=:yorum_id
	");
	$yorumonay->execute([
		'yorum_durum' => 5,
		'yorum_id' => guvenlik($_POST['yorum_id'])
	]);
	if($yorumonay){
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?onay=basarili");
	}else{
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?onay=basarisiz");
	}
}


if(isset($_POST['yorumonaylama'])){
	$yorumonay = $db->prepare("UPDATE yorum SET 
		yorum_durum=:yorum_durum
		WHERE yorum_id=:yorum_id
	");
	$yorumonay->execute([
		'yorum_durum' => 0,
		'yorum_id' => guvenlik($_POST['yorum_id'])
	]);
	if($yorumonay){
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?onay=iptalbasarili");
	}else{
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?onay=iptalbasarisiz");
	}
}





if(isset($_POST['kayitol'])){

	$kullanici_mail = $_POST['kullanici_mail'];


	$kmailsor = $db->prepare("SELECT * FROM kullanici where kullanici_mail=:kullanici_mail");
	$kmailsor->execute([
		'kullanici_mail' => $kullanici_mail
	]);
	$kmailcek=$kmailsor->fetch(PDO::FETCH_ASSOC);

	$kmail_mail = $kmailcek['kullanici_mail'];


	if($kmail_mail==$kullanici_mail){
		Header("Location:../../../giris?mail=var");
	}else{
		$kullanici_onayMailSifre=rand(1000000,9999999);
		$kullanicikayitsor = $db->prepare("INSERT INTO kullanici SET
			kullanici_adsoyad=:kullanici_adsoyad,
			kullanici_mail=:kullanici_mail,
			kullanici_sifre=:kullanici_sifre,
			kullanici_ip=:kullanici_ip,
			kullanici_onayMailSifre=:kullanici_onayMailSifre
			");
		$kullanicikayitsor->execute([
			'kullanici_adsoyad' => guvenlik($_POST['kullanici_adsoyad']),
			'kullanici_mail' => guvenlik($_POST['kullanici_mail']),
			'kullanici_sifre' => guvenlik($_POST['kullanici_sifre']),
			'kullanici_ip' => guvenlik($_POST['kullanici_ip']),
			'kullanici_onayMailSifre' => guvenlik($kullanici_onayMailSifre)
		]);
		Header("Location:../../../mail/gonder?kmail=$kullanici_mail");
	}

	

	
}

if(isset($_POST['mailonay'])){
	$mailonaysor = $db->prepare("UPDATE kullanici SET
		kullanici_onayMail=:kullanici_onayMail
		WHERE kullanici_mail=:kullanici_mail
	");
	$mailonaysor->execute([
		'kullanici_onayMail' => guvenlik($_POST['kullanici_onayMail']),
		'kullanici_mail' => guvenlik($_POST['kullanici_mail'])
	]);

	$kullanici_onayMail = guvenlik($_POST['kullanici_onayMail']);
	$kullanici_onayMailSifre = guvenlik($_POST['kullanici_onayMailSifre']);

	if(($kullanici_onayMail)===($kullanici_onayMailSifre)){
		

		$mailonaylandisor = $db->prepare("UPDATE kullanici SET
			kullanici_durum=:kullanici_durum
			WHERE kullanici_mail=:kullanici_mail");
		$mailonaylandisor->execute([
			'kullanici_durum' => 5,
			'kullanici_mail' => guvenlik($_POST['kullanici_mail'])
		]);

		Header("Location:../../../giris?mail=onaybasarili");
	}else{
		Header("Location:../../../giris?mail=onaybasarisiz");
	}
}


if(isset($_POST['girisyap'])){
	$kullanicigirissor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:kullanici_mail");
	$kullanicigirissor->execute([
		'kullanici_mail' => guvenlik($_POST['kullanici_mail'])
	]);
	$kullanicigiriscek=$kullanicigirissor->fetch(PDO::FETCH_ASSOC);

	$kullanici_mail_gelen = guvenlik($_POST['kullanici_mail']);
	$kullanici_sifre_gelen = guvenlik($_POST['kullanici_sifre']);

	$kullanici_mail = guvenlik($kullanicigiriscek['kullanici_mail']);
	$kullanici_sifre = guvenlik($kullanicigiriscek['kullanici_sifre']);
	$kullanici_durum = guvenlik($kullanicigiriscek['kullanici_durum']);

	if($kullanici_mail_gelen==$kullanici_mail && $kullanici_sifre_gelen===$kullanici_sifre && $kullanici_durum==='5'){
		$_SESSION['kullanici_mail']=$kullanici_mail;
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location: ".$url);
	}elseif($kullanici_mail_gelen===$kullanici_mail && $kullanici_sifre_gelen===$kullanici_sifre && $kullanici_durum==='0'){
		Header("Location:../../../mailonay?kmail=$kullanici_mail_gelen");
	}elseif($kullanici_mail_gelen===$kullanici_mail && $kullanici_sifre_gelen===$kullanici_sifre && $kullanici_durum==='3'){
		Header("Location:../../../giris?mail=hesapengel");
	}else{
		Header("Location:../../../giris?mail=hesapyok");
	}
}



if(isset($_POST['ipengelle'])){
	$gelenengelip = guvenlik($_POST['log_ip']);

	$ipengelsor = $db->prepare("INSERT INTO logengelip SET
		engel_ip=:engel_ip
	");
	$ipengelsor->execute([
		'engel_ip' => guvenlik($gelenengelip)
	]);
	if($ipengelsor){
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?engel=basarili");
	}else{
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?engel=basarisiz");
	}
}

if(isset($_POST['ipengelkaldir'])){
	$gelenengelip = guvenlik($_POST['log_ip']);

	$ipengelsor = $db->prepare("DELETE FROM logengelip WHERE
		engel_ip=:engel_ip
	");
	$ipengelsor->execute([
		'engel_ip' => guvenlik($gelenengelip)
	]);
	if($ipengelsor){
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?engel=kaldirmabasarili");
	}else{
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?engel=kaldirmabasarisiz");
	}
}


?>