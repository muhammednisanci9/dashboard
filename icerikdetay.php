<!DOCTYPE html>
<html>
<head>
	<title>Düzenle | Dashboard</title>
	<?php include 'ortakhead.php'; ?>

	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
</head>
<body>
	<?php include 'bar.php'; ?>


	<main>
		<section class="ekle">
			<div class="ekle-container">
				<div class="list-title">
					<h1>İçerik Düzenle</h1>
				</div>
						<div class="getmesaj" style="padding: 0; margin-bottom: 15px">
							<span class="getmesaj-yes">
								Ekleme Başarılı
							</span>
							<!-- <span class="getmesaj-no">
								Ekleme Başarısız
							</span> -->
							<!-- <span class="getmesaj-no">
								Resmin boyutu 3mb'den Küçük Olmalı
							</span> -->
							<!-- <span class="getmesaj-no">
								Resmin uzantısı png,jpg,jpeg ya da webp olmalı.
							</span> -->
						</div>
				<div class="ekle-children">
					<form method="POST" action="adming/islem.php" enctype="multipart/form-data">
					<div class="ekle-child">
						<div class="ekle-item">
							<label>Başlık</label>
							<input type="text" name="icerik_baslik" placeholder="Başlığı Buraya Yazın" value="">
						</div>

						<div class="ekle-item">
							<label>Kategori</label>
							<div class="ekle-radio-container">
								<div class="ekle-radio">
									<input type="radio" name="icerik_kategori_id" value="" checked=""
									>
									<label>Kategori Adı</label>
								</div>
							</div>
						</div>

						<div class="ekle-item">
							<label>Genel Kategori</label>
							<div class="ekle-radio-container">
								<div class="ekle-radio">
									<input type="radio" name="icerik_genelkategori_id" value="<?= $genelkategoricek['genelkategori_id'] ?>" checked=""
									>
									<label>Genel Kategori</label>
								</div>
							</div>
						</div>

						<div class="ekle-item">
							<label>Resim (png,jpg,jpeg,webp)(en fazla : 3mb)</label>
							<input type="file" name="icerik_resim">
						</div>
						
						<div class="ekle-item">
							<label>Resim alt</label>
							<input type="text" name="icerik_resim_alt" placeholder="Resmin Açıklamasını Buraya Yazın" value="">
						</div>

						<div class="ekle-item">
							<label>İçerik</label>
							<textarea id="editor1" class="ckeditor" name="icerik_text" value=""></textarea>
						</div>

						<div class="ekle-item">
							<label>Title</label>
							<input type="text" name="icerik_title" placeholder="Title(Tarayıcı Başlığı) Buraya Yazın" value="">
						</div>

						<div class="ekle-item">
							<label>Description</label>
							<input type="text" name="icerik_description" placeholder="Description(Aramalardaki Açıklama) Buraya Yazın" value="">
						</div>

						<div class="ekle-item">
							<label>Yazar</label>
							<input type="text" name="icerik_author" placeholder="Yazarı Buraya Yazın" value="">
						</div>

						<div class="ekle-item">
							<label>Keywords</label>
							<input type="text" name="icerik_keywords" placeholder="Anahtar Kelimeleri Virgülle Ayırarak Buraya Yazın" value="">
						</div>

						<div class="ekle-item eklebtn" >
							<input type="hidden" name="icerik_id" value="">
							<button name="icerikguncelle">Güncelle</button>
						</div>
					</div>
					</form>
				</div>
			</div>	
		</section>
	</main>
	






<?php include "footer.php" ?>