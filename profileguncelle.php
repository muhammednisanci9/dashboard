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
						<?php if(isset($_GET['guncelleme'])){ ?>
						<div class="getmesaj" style="width: 430px">
							<?php if($_GET['guncelleme']=="basarili"){ ?>
							<span class="getmesaj-yes">
								Güncelleme <b>Başarılı</b>
							</span>
							<?php }elseif($_GET['guncelleme']=="basarisiz"){ ?>
							<span class="getmesaj-no">
								Güncelleme <b>Başarısız</b>
							</span>
							<?php } ?>
						</div>
						<?php } ?>
						<div class="profiledetay-text">
							<ol id="profiledetay-text-items">
								<form method="POST" action="adming/islem.php" enctype="multipart/form-data">
								<input type="hidden" name="kullanici_id" value="<?= $kulcek['kullanici_id'] ?>">
								<li>
									<label>Resim :</label>
									<input type="file" name="kullanici_resim" value="<?= $kulcek['kullanici_resim'] ?>">
								</li>
								<li>
									<label>İsim Soyisim :</label>
									<input type="" name="kullanici_adsoyad" value="<?= $kulcek['kullanici_adsoyad'] ?>">
								</li>
								<li>
									<label>Mail :</label> 
									<input type="" name="kullanici_mail" value="<?= $kulcek['kullanici_mail'] ?>">
								</li>
								<li>
									<label>Şifre :</label> 
									<input type="" name="kullanici_sifre" value="<?= $kulcek['kullanici_sifre'] ?>">
								</li>
								<li>
									<form>
										<button name="profileguncelle">Güncelle</button>
									</form>
								</li>
								</form>
							</ol>
						</div>
					</div>
				</div>
			</div>

		</section>

	</main>




<?php include 'footer.php' ?>