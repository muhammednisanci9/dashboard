<?php include 'backend/data.php' ?>
<!DOCTYPE html>
<html>
<head>
	<title>Kategoriler | Dashboard</title>
	<?php include 'ortakhead.php'; ?>
</head>
<body>
	<?php include 'bar.php'; ?>


	<main>
		
		<section class="list">
			<?php include 'topanaliz.php'; ?>

			<?php  
				$categories = $db->prepare("SELECT * FROM categories ORDER BY category_id DESC");
				$categories->execute();
			?>

			<div class="list-container">
				<div class="list-title">
					<h1>Kategoriler</h1>
					<span id="list-title-right">Toplam : <?= $categories->rowCount(); ?></span>
				</div>
				<div class="list-children">
					<div class="list-child">
						<table>
							<tr>
								<th class="tdbtn-3">#</th>
								<td class="tdbtn-1">Durum</th>
								<td class="tdbtn-1">Kategori Adı</th>
								<td class="tdbtn-1">Zaman</th>
								<td class="tdbtn-1">Üst Kategori</th>
								<th class="tdbtn-1">Resim</th>
								<th class="tdbtn-1">Resim Alt</th>
								<th class="tdbtn-1">Renk</th>
								<th class="tdbtn-1">Açıklama</th>
								<th class="tdbtn-1">Yazar</th>
								<th class="tdbtn-1">Anahtar Kelimeler</th>
								<th class="tdbtn-2"></th>
								<th class="tdbtn-4"></th>
							</tr>

							<?php  
								foreach ($categories as $category) {

								$category_parent=$category['category_parent'];
								$findcategoryparent=$db->prepare("SELECT * FROM categories WHERE category_id=:category_id");
								$findcategoryparent->execute([
									'category_id' => $category_parent
								]);
								$foundcategoryparent=$findcategoryparent->fetch(PDO::FETCH_ASSOC);
							?>
							<tr>
								<td class="tdbtn-3"><?= $category['category_id'] ?></td>
								<td class="tdbtn-1"><?= $category['category_situation'] == 0 ? 'Pasif' : 'Aktif' ?></td>
								<td class="tdbtn-1"><?= $category['category_name'] ?></td>
								<td class="tdbtn-1"><?= $category['category_date'] ?></td>
								<td class="tdbtn-1"><?= $category['category_parent'] == 0 ? 'Yok' : $foundcategoryparent['category_name'] ?></td>
								<td class="tdbtn-1"><?= $category['category_picture'] ?></td>
								<td class="tdbtn-1"><?= $category['category_picture_alt'] ?></td>
								<td class="tdbtn-1"><?= $category['category_color'] ?></td>
								<td class="tdbtn-1"><?= $category['category_description'] ?></td>
								<td class="tdbtn-1"><?= $category['category_author'] ?></td>
								<td class="tdbtn-1"><?= $category['category_keywords'] ?></td>
								<td class="tdbtn-2">
									<a href="edit-category?category_id=<?= $category['category_id'] ?>" id="detay">Düzenle</a>
								</td>
								<td class="tdbtn-4">
									<form method="POST" action="backend/data.php">
										<input type="hidden" name="icerik_id" value="14">
										<button id="sil" name="iceriksil">
											<!-- <img src="img/icon/delete.png" class="listicon"> -->Sil
										</button>
									</form>
								</td>
							</tr>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
		</section>

	</main>






<?php include "footer.php" ?>