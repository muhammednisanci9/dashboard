<!DOCTYPE html>
<html>
<head>
	<title>İçerikler | Dashboard</title>
	<?php include 'ortakhead.php'; ?>
</head>
<body>
	<?php include 'bar.php'; ?>


	<main>
		
		<section class="list">
			<?php include 'topanaliz.php'; ?>

			<div class="list-container">
				<div class="list-title">
					<h1>İçerik</h1>
					<span id="list-title-right">Toplam : 14</span>
				</div>
				<div class="list-children">
					<div class="list-child">
						<table>
							<tr>
								<th class="tdbtn-3">#</th>
								<th>Başlık</th>
								<th class="tdbtn">Zaman</th>
								<th class="tdbtn">Kategori</th>
								<th class="tdbtn-1">Tekil Okunma</th>
								<th class="tdbtn-1">Okunma</th>
								<th class="tdbtn-2"></th>
								<th class="tdbtn-4"></th>
							</tr>

							<tr>
								<td class="tdbtn-3">14</td>
								<td class="td-pr">Başlık</td>
								<td class="tdbtn">2023-10-10</td>
								<td class="tdbtn">Kategori Ad</td>
								<td class="tdbtn-1">14</td>
								<td class="tdbtn-1">14</td>
								<td class="tdbtn-2">
									<a href="icerikdetay?icerik_id=14" id="detay">Düzenle</a>
								</td>
								<td class="tdbtn-4">
									<form method="POST" action="adming/islem.php">
										<input type="hidden" name="icerik_id" value="14">
										<button id="sil" name="iceriksil">
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