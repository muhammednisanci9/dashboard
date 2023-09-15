<!DOCTYPE html>
<html>
<head>
	<title>İletişim | Dashboard</title>
	<?php include 'ortakhead.php'; ?>
</head>
<body>
	<?php include 'bar.php'; ?>


	<main>
		
		<section class="list">
			<?php include 'topanaliz.php'; ?>

			<div class="list-container">
				<div class="list-title">
					<h1>Mesajlar</h1>
					<span id="list-title-right">Toplam : 14</span>
				</div>
					<div class="getmesaj">
						<span class="getmesaj-yes">
							Silme <b>Başarılı</b>
						</span>
						<!-- <span class="getmesaj-no">
							Silme <b>Başarısız</b>
						</span> -->
					</div>
				<div class="list-children">
					<div class="list-child">
						<table>
							<tr>
								<th class="tdbtn-3">#</th>
								<th class="tdbtn">Ad Soyad</th>
								<th class="tdbtn">Ip</th>
								<th class="tdbtn">Tel</th>
								<th class="tdbtn">Zaman</th>
								<th class="tdbtn">Konu</th>
								<th>İçerik</th>
								<th class="tdbtn-2"></th>
								<th class="tdbtn-4"></th>
							</tr>

							
							<tr>
								<td class="tdbtn-3">1</td>
								<td class="tdbtn">Muhammed Nişancı</td>
								<td class="tdbtn">192.168.1.1</td>
								<td class="tdbtn">5315452814</td>
								<td class="tdbtn">2023-10-10</td>
								<td class="tdbtn">Sipariş İptal</td>
								<td>Siparişimi iptal etmek istiyorum fakat nasıl yapacağımı bilmiyorum.</td>
								<td class="tdbtn-2">
									<!-- <form method="POST" action="adming/islem.php">
										<input type="hidden" name="iletisim_id" value="14">
										<button name="iletisimgor" id="detay">
											Oku
										</button>
									</form> -->
										<a href="iletisimdetay.php?iletisim_id=14" id="detay">
											<!-- <img src="img/icon/view.png" class="listicon"> -->Okundu
										</a>
								</td>
								<td class="tdbtn-4">
									<form method="POST" action="adming/islem.php">
										<input type="hidden" name="iletisim_id" value="<?= $iletisimcek['iletisim_id'] ?>">
										<button id="sil" name="iletisimsil">
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