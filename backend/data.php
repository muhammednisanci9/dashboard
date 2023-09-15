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













if(isset($_POST['addcategory'])){

		if($_FILES['category_picture']['error']==0){
			$resim_yol = "img/category/";
			$resim_isim = $_FILES['category_picture']['name'];
			$resim_type = $_FILES['category_picture']['type'];
			$resim_kabultype = ['png','jpg','webp','jpeg'];
			$resim_gecisim = $_FILES['category_picture']['tmp_name'];
			$resim_boyut = $_FILES['category_picture']['size'];
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
	$categoryprepare = $db->prepare("INSERT INTO categories SET
		category_name=:category_name,
		category_situation=:category_situation,
		category_parent=:category_parent,
		category_picture=:category_picture,
		category_picture_alt=:category_picture_alt,
		category_color=:category_color,
		category_description=:category_description,
		category_keywords=:category_keywords,
		category_author=:category_author
	");

	$categoryprepare->execute([
		'category_name' => guvenlik($_POST['category_name']),
		'category_situation' => guvenlik($_POST['category_situation']),
		'category_parent' => guvenlik($_POST['category_parent']),
		'category_picture' => guvenlik($resim_kayitisim),
		'category_picture_alt' => guvenlik($_POST['category_picture_alt']),
		'category_color' => $_POST['category_color'],
		'category_description' => guvenlik($_POST['category_description']),
		'category_keywords' => guvenlik($_POST['category_keywords']),
		'category_author' => guvenlik($_POST['category_author'])
	]);
	if(in_array($resim_sontype, $resim_kabultype) && $resim_boyut < $ucmb){
		Header("Location:../add-category?add=1");
	}elseif($resim_boyut > $ucmb){
		Header("Location:../add-category?add=2");
	}elseif($uzantivarmi === false){
		Header("Location:../add-category?add=3");
	}else{
		Header("Location:../add-category?add=0");
	}
}



if(isset($_POST['editcategory'])){

		if($_FILES['category_picture']){
			$resim_yol = "img/category/";
			$resim_isim = $_FILES['category_picture']['name'];
			$resim_type = $_FILES['category_picture']['type'];
			$resim_kabultype = ['png','jpg','webp','jpeg'];
			$resim_gecisim = $_FILES['category_picture']['tmp_name'];
			$resim_boyut = $_FILES['category_picture']['size'];
			$resim_randsayi = rand(1,100000);
			
			$resim_ayirisim = explode(".", $resim_isim);
			$resim_ayrikisim = $resim_ayirisim['0'];

			$resim_ayirtype = explode("/", $resim_type);
			$resim_sontype = $resim_ayirtype['1'];

			$uzantivarmi = in_array($resim_sontype, $resim_kabultype);
			$ucmb = 1024*1024*3;

			$icerikbosresimsor = $db->prepare("SELECT * FROM categories WHERE category_id=:category_id");
			$icerikbosresimsor->execute([
				'category_id' => $_POST['category_id']
			]);
			$icerikbosresimcek = $icerikbosresimsor->fetch(PDO::FETCH_ASSOC);

			if(empty($resim_kayitisim)){
				$resim_kayitisim = $icerikbosresimcek['category_picture'];
			}


			if($uzantivarmi === true){
				if ($resim_boyut < $ucmb) {
					$resim_kayitisim = $resim_yol.$resim_ayrikisim.$resim_randsayi.".".$resim_sontype;
					move_uploaded_file($resim_gecisim, "../../../".$resim_kayitisim);
				}
			}


		}
		
		
	$editcategory = $db->prepare("UPDATE categories SET 
		category_name=:category_name,
		category_situation=:category_situation,
		category_parent=:category_parent,
		category_picture=:category_picture,
		category_picture_alt=:category_picture_alt,
		category_color=:category_color,
		category_description=:category_description,
		category_keywords=:category_keywords,
		category_author=:category_author,
		WHERE category_id=:category_id
	");
	$editcategory->execute([
		'category_name' => guvenlik($_POST['category_name']),
		'category_situation' => guvenlik($_POST['category_situation']),
		'category_parent' => guvenlik($_POST['category_parent']),
		'category_picture' => $resim_kayitisim,
		'category_picture_alt' => guvenlik($_POST['category_picture_alt']),
		'category_color' => $_POST['category_color'],
		'category_description' => guvenlik($_POST['category_description']),
		'category_keywords' => guvenlik($_POST['category_keywords']),
		'category_author' => guvenlik($_POST['category_author']),
		'category_id' => guvenlik($_POST['category_id'])
	]);

	if($editcategory){
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?edit=1");
	}else{
		$url = $_SERVER['HTTP_REFERER'];
		Header("Location:".$url."?edit=0");
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