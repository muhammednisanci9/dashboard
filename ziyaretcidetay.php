<?php  

	function seo($link){
		$link = trim($link);
		$karakterDegis = array("ı","İ","ğ","Ğ","ü","Ü","ş","Ş","ö","Ö","ç","Ç");
		$karakterDegisti = array("i","i","g","g","u","u","s","s","o","o","c","c");
		$link = str_replace($karakterDegis, $karakterDegisti, $link);
		$link = mb_strtolower($link, "UTF-8");
		$link = preg_replace("/[^a-z0-9]/", "-", $link);
		$link = preg_replace("/-+/", "-", $link);
		$link = trim($link, "-");
		return $link;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Ziyaretçi Detay | Dashboard</title>
	<?php include 'ortakhead.php'; ?>

	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<body>
	<?php include 'bar.php'; ?>

	<main>
		<section class="detaytopanaliz">
			<div class="detaytopanaliz-container">
				<div class="detaytopanaliz-children">
					<div class="detaytopanaliz-child">
						<div class="detaytopanaliz-img">
							<img src="img/icon/plus.png">
						</div>
						<div class="detaytopanaliz-text">
							<span>Aktif Ziyaretçiler</span>
							<span>
								14
							</span>
						</div>
					</div>
					<div class="detaytopanaliz-child">
						<div class="detaytopanaliz-img">
								<!-- <img src="img/icon/plus.png"> -->
								<img src="img/icon/negative.png">
						</div>
						<div class="detaytopanaliz-text">
							<span>Günlük Ziyaretçiler</span>
							<span>
								14
							</span>
							<div class="analizmesaj-container">
								<span class="analizmesaj-top" style="background: #7CC390;"></span>
								<p class="analizmesaj" style="background: #7CC390;">
										Düne Göre 14 Kullanıcı Arttı
								</p>
								<span class="analizmesaj-top" style="background: #EE5D70;"></span>
								<p class="analizmesaj" style="background: #EE5D70;"> Düne Göre 14 Kullanıcı Azaldı 
								</p>
								<span class="analizmesaj-top" style="background: #4C8DEB;"></span>
								<p class="analizmesaj" style="background: #4C8DEB;"> Dün ve Bugün Eşit.
								</p>
							</div>
						</div>
					</div>
					<div class="detaytopanaliz-child">
						<div class="detaytopanaliz-img">
							<img src="img/icon/plus.png">
							<!-- <img src="img/icon/negative.png"> -->
						</div>
						<div class="detaytopanaliz-text">
							<span>Haftalık Ziyaretçiler</span>
							<span>
								14
							</span>
							<div class="analizmesaj-container">
								<span class="analizmesaj-top" style="background: #7CC390;"></span>
								<p class="analizmesaj" style="background: #7CC390;">
										Geçen Haftaya Göre 14 Kullanıcı Arttı
								</p>
								<!-- <span class="analizmesaj-top" style="background: #EE5D70;"></span>
								<p class="analizmesaj" style="background: #EE5D70;"> Geçen Haftaya Göre 14 Kullanıcı Azaldı 
								</p> -->
								<!-- <span class="analizmesaj-top" style="background: #4C8DEB;"></span>
								<p class="analizmesaj" style="background: #4C8DEB;"> Geçen Hafta ve Bu Hafta Eşit.
								</p> -->
							</div>
						</div>
					</div>



					<div class="detaytopanaliz-child">
						<div class="detaytopanaliz-img">
							<img src="img/icon/plus.png">
							<!-- <img src="img/icon/negative.png"> -->
						</div>
						<div class="detaytopanaliz-text">
							<span>Aylık Ziyaretçiler</span>
							<span>
								14
							</span>
							<div class="analizmesaj-container">
								<span class="analizmesaj-top" style="background: #7CC390;"></span>
								<p class="analizmesaj" style="background: #7CC390;">
										Geçen Ay'a Göre 14 Kullanıcı Arttı
								</p>
								<!-- <span class="analizmesaj-top" style="background: #EE5D70;"></span>
								<p class="analizmesaj" style="background: #EE5D70;"> Geçen Ay'a Göre 14 Kullanıcı Azaldı 
								</p> -->
								<!-- <span class="analizmesaj-top" style="background: #4C8DEB;"></span>
								<p class="analizmesaj" style="background: #4C8DEB;"> Geçen Ay ve Bu Ay Eşit.
								</p> -->
							</div>
						</div>
					</div>


				</div>
			</div>
		</section>


		<section class="detayanalizgrafik">
			<div class="detayanalizgrafik-container">
				<div class="detayanalizgrafik-children">
					<div class="detayanalizgrafik-child">
						<canvas id="detaylinecanvas" height="400"></canvas>
					</div>
				</div>
			</div>
		</section>




		<section class="list">
			<div class="list-container">
				<div class="list-title">
					<h1>Ziyaretçiler</h1>
					<span id="list-title-right">Toplam : 14</span>
				</div>
					<div class="getmesaj">
						<span class="getmesaj-no">
							İp <b>Engellendi</b>
						</span>
						<!-- <span class="getmesaj-no">
							İp <b>Engellenemedi</b>
						</span> -->
						<!-- <span class="getmesaj-yes">
							İp <b>Engeli Kaldırıldı</b>
						</span> -->
						<!-- <span class="getmesaj-no">
							İp <b>Engeli Kaldırılamadı</b>
						</span> -->
					</div>
				<div class="list-children">
					<div class="list-child">
						<table>
							<tr>
								<th class="tdbtn-4">#</th>
								<th class="tdbtn">Ip</th>
								<th>Önceki Sayfa</th>
								<th>Şuanki Sayfa</th>
								<th class="tdbtn">Zaman</th>
								<th class="tdbtn-4">Dil</th>
								<th class="tdbtn-3"></th>
								<th class="tdbtn-2"></th>
							</tr>

							<tr>
								<td class="tdbtn-4"><a href="ziyaretci-<?= seo($sonlogcek['log_ip']."-".$sonlogcek['log_id']); ?>" style="display: flex; align-items: center;justify-content: center;margin-left: 2px;"	><img src="img/icon/search.png" class="listicon" style="margin-right: 0; padding: 1.5px"></a></td>
								<td class="tdbtn">192.168.1.1</td>
								<td>14</td>
								<td>14</td>
								<td class="tdbtn">2023-10-10</td>
								<td class="tdbtn-4">tr</td>
								<td class="tdbtn-3">
									<span id="ipdurum">
												<span id="aktif">Aktif</span>
												<!-- <span id="pasif">Pasif</span> -->
												<!-- <span id="pasif">Belirsiz</span> -->
									</span>
								</td>
								<td class="tdbtn-2">
									<!-- <form method="POST" action="adming/islem.php">
										<input type="hidden" name="log_ip" value="14">
										<button id="ipengelle" name="ipengelkaldir" style="background: #D1DBBD">Engelli</button>
									</form> -->
									<form method="POST" action="adming/islem.php">
										<input type="hidden" name="log_ip" value="14">
										<button id="ipengelle" name="ipengelle">Engelle</button>
									</form>
								</td>
							</tr>
						
						</table>
					</div>
				</div>
				<div class="list-sayfa">
					<div class="say_sabit"><a href="loglist.php?sayfa=1"><img src="img/icon/enleft.png"></a></div>
					<div class="say_sabit"><a href="loglist.php?sayfa=14"><img src="img/icon/left.png"></a></div>
					<div class="say_sabit"><a href="loglist.php?sayfa=14"><img src="img/icon/right.png"></a></div>
					<div class="say_sabit"><a href="loglist.php?sayfa=14"><img src="img/icon/enright.png"></a></div>
				</div>
			</div>
		</section>




	</main>
	

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript">
	
		var ctx = document.getElementById('detaylinecanvas').getContext('2d');
		var detaylinecanvas = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: [
			        <?php  

			        $bugun = date("Y-m-d 00:00:00");

			        for($bg = 1; $bg <=31; $bg++){
						$bazal = "-".$bg."day";

						$gun = strtotime($bazal, strtotime($bugun));

						$gun = date("D",$gun);


						echo "'".$gun."'".",";
					}
		        	?>
		        ],
		        datasets: [{
		            label: 'Son 30 Gün',
		            data: [
		           		<?php	

		           		$dun = strtotime('-1 day', strtotime($bugun));
						$dun = date("Y-m-d 00:00:00",$dun);

						$yarin = strtotime('+1 day', strtotime($bugun));
						$yarin = date("Y-m-d 00:00:00",$yarin);
		            	for($g = 31; $g >=1; $g--){

							$azal = "-".$g."day";

							$gun = strtotime($azal, strtotime($yarin));
							$gun = date("Y-m-d 00:00:00",$gun);

							$gun2 = strtotime($azal, strtotime($bugun));
							$gun2 = date("Y-m-d 00:00:00",$gun2);

							$gunsor = $db->prepare("SELECT * FROM log WHERE log_zaman BETWEEN '$gun2' AND '$gun' GROUP BY log_ip");
							$gunsor->execute();
							$gunsay = $gunsor->rowCount();

							echo $gunsay.",";

						}
						?>

		            ],
		            borderColor: [
		                '#041528',
		            ],

		            borderWidth: 3,
		        },
		        {
					label: 'Önceki 30 Gün',
		            data: [
		           		<?php	
		           		$bugun = date("Y-m-d 00:00:00");
		           		$bugun = strtotime('-1 day', strtotime($bugun));
						$bugun = date("Y-m-d 00:00:00",$bugun);

		           		$dun = strtotime('-1 day', strtotime($bugun));
						$dun = date("Y-m-d 00:00:00",$dun);

						$yarin = strtotime('+1 day', strtotime($bugun));
						$yarin = date("Y-m-d 00:00:00",$yarin);
		            	for($g = 63; $g >=32; $g--){

							$azal = "-".$g."day";

							$gun = strtotime($azal, strtotime($yarin));
							$gun = date("Y-m-d 00:00:00",$gun);

							$gun2 = strtotime($azal, strtotime($bugun));
							$gun2 = date("Y-m-d 00:00:00",$gun2);

							$gunsor = $db->prepare("SELECT * FROM log WHERE log_zaman BETWEEN '$gun2' AND '$gun' GROUP BY log_ip");
							$gunsor->execute();
							$gunsay = $gunsor->rowCount();

							echo $gunsay.",";

						}
						?>

		            ],
		            borderColor: [
		                '#3a506b',
		            ],
		            borderWidth: 3,
		        }]
		    },
		  
		});
</script>


<?php include "footer.php" ?>