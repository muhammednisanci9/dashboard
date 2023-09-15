<?php include 'backend/data.php' ?>
<!DOCTYPE html>
<html>
<head>
	<title>Kategori Düzenle | Dashboard</title>
	<?php include 'ortakhead.php'; ?>

	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
</head>
<body>
	<?php include 'bar.php'; ?>

	<?php  
		$categories = $db->prepare("SELECT * FROM categories WHERE category_id=:category_id");
		$categories->execute([
			'category_id' => $_GET['category_id']
		]);
		$category = $categories->fetch(PDO::FETCH_ASSOC);
	?>

	<main>
		<section class="ekle">
			<div class="ekle-container">
				<div class="list-title">
					<h1>Kategori Düzenle</h1>
				</div>
						<div class="getmesaj" style="padding: 0; margin-bottom: 15px">
							<?php 
							if(isset($_GET['edit'])){
								if($_GET['edit'] == 1){
							?>
							<span class="getmesaj-yes">
								Düzenleme Başarılı
							</span>
							<?php  
								}elseif($_GET['edit'] == 0){
							?>
							<span class="getmesaj-no">
								Düzenleme Başarısız
							</span>
							<?php  
								}elseif($_GET['edit'] == 2){
							?>
							<span class="getmesaj-no">
								Resmin boyutu 3mb'den Küçük Olmalı
							</span>
							<?php  
								}elseif($_GET['edit'] == 3){
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
							<input type="text" name="category_name" placeholder="Kategori Adını Buraya Yazın" value="<?= $category['category_name'] ?>">
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

									foreach ($categories as $categoryD) {
								?>
								<div class="ekle-radio">
									<input type="radio" name="category_parent" value="<?= $category['category_id'] ?>"
									<?php  
										if($categoryD['category_id'] == $category['category_id']){ ?>
											checked=''
									<?php } ?>
									>
									<label><?= $categoryD['category_name'] ?></label>
								</div>
								<?php } ?>
							</div>
						</div>

						<div class="ekle-item">
							<label>Kategori Durum</label>
							<div class="ekle-radio-container">
								<div class="ekle-radio">
									<input type="radio" name="category_situation" value="1"
									<?php  
									if($category['category_situation'] == 1){ ?>
										 checked=""
									<?php } ?>
									>
									<label>Aktif</label>
								</div>
								<div class="ekle-radio">
									<input type="radio" name="category_situation" value="0"
									<?php  
									if($category['category_situation'] == 0){ ?>
										 checked=""
									<?php } ?>
									>
									<label>Pasif</label>
								</div>
							</div>
						</div>

						<div class="ekle-item">
							<label>Renk</label>
							<input type="text" name="category_color" placeholder="6 haneli renk kodunu buraya yazın" value="<?= $category['category_color'] ?>">
						</div>

						<div class="ekle-item">
							<label>Resim (png,jpg,jpeg,webp)(en fazla : 3mb)</label>
							<input type="file" name="category_picture">
						</div>
						
						<div class="ekle-item">
							<label>Resim alt</label>
							<input type="text" name="category_picture_alt" placeholder="Resmin Açıklamasını Buraya Yazın" value="<?= $category['category_picture_alt'] ?>">
						</div>


						<div class="ekle-item">
							<label>Description(Açıklama)</label>
							<input type="text" name="category_description" placeholder="Description(Aramalardaki Açıklama(155-160 karakter)) Buraya Yazın" value="<?= $category['category_description'] ?>">
						</div>

						<div class="ekle-item">
							<label>Yazar</label>
							<input type="text" name="category_author" placeholder="Yazarı Buraya Yazın" value="<?= $category['category_author'] ?>">
						</div>

						<div class="ekle-item">
							<label>Keywords</label>
							<input type="text" name="category_keywords" placeholder="Anahtar Kelimeleri Virgülle Ayırarak Buraya Yazın" value="<?= $category['category_keywords'] ?>">
						</div>

						<div class="ekle-item eklebtn" >
							<input type="hidden" name="category_id" value="<?= $_GET['category_id'] ?>">
							<button name="editcategory">Güncelle</button>
						</div>
					</div>
					</form>
				</div>
			</div>	
		</section>
	</main>
	






<?php include "footer.php" ?>