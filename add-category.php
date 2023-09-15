<?php include 'backend/data.php' ?>
<!DOCTYPE html>
<html>
<head>
	<title>Kategori Ekle | Dashboard</title>
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
					<h1>Kategori Ekle</h1>
				</div>
						<div class="getmesaj" style="padding: 0; margin-bottom: 15px">
							<?php 
							if(isset($_GET['add'])){
								if($_GET['add'] == 1){
							?>
							<span class="getmesaj-yes">
								Ekleme Başarılı
							</span>
							<?php  
								}elseif($_GET['add'] == 0){
							?>
							<span class="getmesaj-no">
								Ekleme Başarısız
							</span>
							<?php  
								}elseif($_GET['add'] == 2){
							?>
							<span class="getmesaj-no">
								Resmin boyutu 3mb'den Küçük Olmalı
							</span>
							<?php  
								}elseif($_GET['add'] == 3){
							?>
							<span class="getmesaj-no">
								Resmin uzantısı png,jpg,jpeg ya da webp olmalı.
							</span>
							<?php  
								}};
							?>
						</div>
				<div class="ekle-children">
					<form method="POST" action="backend/data.php" enctype="multipart/form-data">
					<div class="ekle-child">
						<div class="ekle-item">
							<label>Kategori Adı</label>
							<input type="text" name="category_name" placeholder="Kategori Adını Buraya Yazın">
						</div>

						<div class="ekle-item">
							<label>Üst Kategori Seçin</label>
							<div class="ekle-radio-container">
								<div class="ekle-radio">
									<input type="radio" name="category_parent" value="0" checked="">
									<label>Yok</label>
								</div>
								<?php  
									$categories = $db->prepare("SELECT * FROM categories ORDER BY category_id DESC");
									$categories->execute();

									foreach ($categories as $category) {
								?>
								<div class="ekle-radio">
									<input type="radio" name="category_parent" value="<?= $category['category_id'] ?>">
									<label><?= $category['category_name'] ?></label>
								</div>
								<?php } ?>
							</div>
						</div>

						<div class="ekle-item">
							<label>Kategori Durum</label>
							<div class="ekle-radio-container">
								<div class="ekle-radio">
									<input type="radio" name="category_situation" value="1" checked="">
									<label>Aktif</label>
								</div>
								<div class="ekle-radio">
									<input type="radio" name="category_situation" value="0">
									<label>Pasif</label>
								</div>
							</div>
						</div>

						<div class="ekle-item">
							<label>Renk</label>
							<input type="text" name="category_color" placeholder="6 haneli renk kodunu buraya yazın">
						</div>

						<div class="ekle-item">
							<label>Resim (png,jpg,jpeg,webp)(en fazla : 3mb)</label>
							<input type="file" name="category_picture">
						</div>
						
						<div class="ekle-item">
							<label>Resim alt</label>
							<input type="text" name="category_picture_alt" placeholder="Resmin Açıklamasını Buraya Yazın">
						</div>


						<div class="ekle-item">
							<label>Description(Açıklama)</label>
							<input type="text" name="category_description" placeholder="Description(Aramalardaki Açıklama(155-160 karakter)) Buraya Yazın">
						</div>

						<div class="ekle-item">
							<label>Yazar</label>
							<input type="text" name="category_author" placeholder="Yazarı Buraya Yazın">
						</div>

						<div class="ekle-item">
							<label>Keywords</label>
							<input type="text" name="category_keywords" placeholder="Anahtar Kelimeleri Virgülle Ayırarak Buraya Yazın">
						</div>

						<div class="ekle-item eklebtn" >
							<button name="addcategory">Ekle</button>
						</div>
					</div>
					</form>
				</div>
			</div>	
		</section>
	</main>
	






<?php include "footer.php" ?>