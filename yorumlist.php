<!DOCTYPE html>
<html>
<head>
	<title>Yorumlar | Dashboard</title>
	<?php include 'ortakhead.php'; ?>
</head>
<body>
	<?php include 'bar.php'; ?>


	<main>
		
		<section class="list">
			<?php include 'topanaliz.php'; ?>

			<div class="list-container">
				<div class="list-title">
					<h1>Yorumlar</h1>
					<span id="list-title-right">Toplam : 14</span>
				</div>
					<div class="getmesaj">
						<span class="getmesaj-yes">
							Yorum <b>Onaylandı</b>
						</span>
						<!-- <span class="getmesaj-no">
							Yorum <b>Onaylanamadı</b>
						</span>
						<span class="getmesaj-no">
							Yorum <b>Kaldırıldı</b>
						</span>
						<span class="getmesaj-no">
							Yorum <b>Kaldırılamadı</b>
						</span> -->
					</div>
				<div class="list-children">
					<div class="list-child">
						<table>
							<tr>
								<th class="tdbtn-4">#</th>
								<th class="tdbtn">Ad Soyad</th>
								<th class="tdbtn">Mail</th>
								<th class="tdbtn">Zaman</th>
								<th>yorum</th>
								<th class="tdbtn-1"></th>
								<th class="tdbtn-4"></th>
							</tr>

							
							<tr>
								<td class="tdbtn-4"><a href="yorumdetay.php?yorum_id=14"><img src="img/icon/search.png" class="listicon" style="margin-right: 0; padding: 1.5px"></a></td>
								<td class="tdbtn">Muhammed Nişancı</td>
								<td class="tdbtn">muhammednisanci2000@gmail.com</td>
								<td class="tdbtn">2023-10-10</td>
								<td>Ürünü çok beğendim, bedeni tam oldu.</td>
								<td class="tdbtn-1">
									<form method="POST" action="adming/islem.php">
										<input type="hidden" name="yorum_id" value="<?= $yorumcek['yorum_id'] ?>">
										<button id="detay" name="yorumonayla">
											<!-- <img src="img/icon/delete.png" class="listicon"> -->Onayla
										</button>
									</form>
										<!-- <button id="aktif" name="yorumonaylama">
											<img src="img/icon/delete.png" class="listicon">Onaylandı
										</button> -->
								</td>
								<td class="tdbtn-4">
									<form method="POST" action="adming/islem.php">
										<input type="hidden" name="yorum_id" value="<?= $yorumcek['yorum_id'] ?>">
										<button id="sil" name="yorumsil">
											<!-- <img src="img/icon/delete.png" class="listicon"> -->Sil
										</button>
									</form>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</section>

	</main>






<?php include "footer.php" ?>