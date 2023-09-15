<?php include 'ortakphp.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile | Dashboard</title>
	<?php include 'ortakhead.php'; ?>
</head>
<body>
	<?php include 'bar.php' ?>



	<main>
		<section class="profiledetay">
			<div class="profiledetay-container">
				<div class="profiledetay-children">
					<div class="profiledetay-child">
						<div class="profiledetay-img">
							<img src="<?= $kulcek['kullanici_resim'] ?>">
						</div>
						<div class="profiledetay-text">
							<ol id="profiledetay-text-items">
								<li><span>İsim Soyisim :</span> <span><?= $kulcek['kullanici_adsoyad'] ?></span></li>
								<li><span>Mail :</span> <span><?= $kulcek['kullanici_mail'] ?></span></li>
								<li><span>Şifre :</span> <span><?= $kulcek['kullanici_sifre'] ?></span></li>
								<li>
									<a href="profileguncelle.php">Güncelle</a>
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>

		</section>

	</main>




<?php include 'footer.php' ?>