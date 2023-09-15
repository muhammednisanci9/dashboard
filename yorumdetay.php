<?php include 'ortakphp.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Yorum Detay | Dashboard</title>
	<?php include 'ortakhead.php'; ?>
</head>
<body>
	<?php include 'bar.php'; ?>


	<main>
		<section class="ekle">
			<div class="ekle-container">
				<div class="list-title">
					<h1>Mesaj Detayı</h1>
				</div>
				<div class="ekle-children">
					<form>
					<div class="ekle-child">
						<?php  
						$yorumgelenid = $_GET['yorum_id'];
						$yorumdetaysor = $db->prepare("SELECT * FROM yorum WHERE yorum_id=:yorum_id");
						$yorumdetaysor->execute([
							'yorum_id' => $yorumgelenid
						]);
						foreach($yorumdetaysor as $yorumdetaycek){

						$yorumkullanici_id = $yorumdetaycek['yorum_kullanici_id'];

						$yorumkullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:kullanici_id");
						$yorumkullanicisor->execute([
							'kullanici_id' => $yorumkullanici_id
						]);
						$yorumkullanicicek = $yorumkullanicisor->fetch(PDO::FETCH_ASSOC);
						?>
						<div class="ekle-item">
							<label style="font-weight: bold;">Id</label>
							<?= $yorumdetaycek['yorum_id'] ?>
						</div>
						<div class="ekle-item">
							<label style="font-weight: bold;">Ad Soyad</label>
							<?= $yorumkullanicicek['kullanici_adsoyad'] ?>
						</div>
						<div class="ekle-item">
							<label style="font-weight: bold;">Mail</label>
							<?= $yorumkullanicicek['kullanici_mail'] ?>
						</div>
						<div class="ekle-item">
							<label style="font-weight: bold;">Mesaj</label>
							<?= $yorumdetaycek['yorum_icerik'] ?>
						</div>
						<?php } ?>
					</div>
					</form>
				</div>
			</div>	
		</section>
	</main>






<?php include 'footer.php'; ?>