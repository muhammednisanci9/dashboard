<?php include 'ortakphp.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>İletişim Detay | Dashboard</title>
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
						$iletisimgelenid = $_GET['iletisim_id'];
						$iletisimdetaysor = $db->prepare("SELECT * FROM iletisim WHERE iletisim_id=:iletisim_id");
						$iletisimdetaysor->execute([
							'iletisim_id' => $iletisimgelenid
						]);
						foreach($iletisimdetaysor as $iletisimdetaycek){
						?>
						<div class="ekle-item">
							<label style="font-weight: bold;">Id</label>
							<?= $iletisimdetaycek['iletisim_id'] ?>
						</div>
						<div class="ekle-item">
							<label style="font-weight: bold;">Ad Soyad</label>
							<?= $iletisimdetaycek['iletisim_adsoyad'] ?>
						</div>
						<div class="ekle-item">
							<label style="font-weight: bold;">Tel No</label>
							<?= $iletisimdetaycek['iletisim_tel'] ?>
						</div>
						<div class="ekle-item">
							<label style="font-weight: bold;">Mail</label>
							<?= $iletisimdetaycek['iletisim_mail'] ?>
						</div>
						<div class="ekle-item">
							<label style="font-weight: bold;">Konu</label>
							<?= $iletisimdetaycek['iletisim_konu'] ?>
						</div>
						<div class="ekle-item">
							<label style="font-weight: bold;">Mesaj</label>
							<?= $iletisimdetaycek['iletisim_icerik'] ?>
						</div>
						<?php } ?>
					</div>
					</form>
				</div>
			</div>	
		</section>
	</main>






<?php include 'footer.php'; ?>