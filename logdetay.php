<?php include 'ortakphp.php';

$logsor = $db->prepare("SELECT * FROM log GROUP BY log_ip");
$logsor->execute();
$logsay = $logsor->rowCount();


	$gelenip = $_GET['log_ip'];
	$gelensip = str_replace("-", ".", $gelenip);

	$logasor = $db->prepare("SELECT * FROM log WHERE log_ip=:log_ip ORDER BY log_zaman DESC");
	$logasor->execute([
		'log_ip' => $gelensip
	]);


 ?>

<!DOCTYPE html>
<html>
<head>
	<title><?= $gelensip ?> | Dashboard</title>
	<?php include 'ortakhead.php'; ?>
</head>
<body>
	<?php include 'bar.php'; ?>

	<main>
		


		<?php 
			$sayfa = @ceil($_GET['sayfa']);
			if($sayfa < 1) { $sayfa = 1; }
			$toplamsayfa = $logsay;
			$limit = 20;
			$sayfa_sayisi = ceil($toplamsayfa/$limit);
			if($sayfa > $sayfa_sayisi) { $sayfa = $sayfa_sayisi; }
			$goster = $sayfa * $limit - $limit;
			$gorunen_sayfa = 5;
		?>


		<section class="list">
			<?php include 'topanaliz.php'; ?>
			<div class="list-container">
				<div class="list-title">
					<h1>"<?= $gelensip ?>" Ip'li Ziyaretçinin Hareketleri</h1>
					<!-- <a href="ekle.php" id="listekle">Toplam : <?=$logsay; ?></a> -->
				</div>
				<?php if(isset($_GET['engel'])){ ?>
					<div class="getmesaj">
						<?php if($_GET['engel']=="basarili"){ ?>
						<span class="getmesaj-no">
							İp <b>Engellendi</b>
						</span>
						<?php }elseif($_GET['engel']=="basarisiz"){ ?>
						<span class="getmesaj-no">
							İp <b>Engellenedi</b>
						</span>
						<?php }elseif($_GET['engel']=="kaldirmabasarili"){ ?>
						<span class="getmesaj-yes">
							İp <b>Engeli Kaldırıldı</b>
						</span>
						<?php }elseif($_GET['engel']=="kaldirmabasarisiz"){ ?>
						<span class="getmesaj-no">
							İp <b>Engeli Kaldırılamadı</b>
						</span>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="list-children">
					<div class="list-child">
						<table>
							<tr>
								<th class="tdbtn">Ip</th>
								<th>Önceki Sayfa</th>
								<th>Şuanki Sayfa</th>
								<th class="tdbtn">Zaman</th>
								<th class="tdbtn-4">Dil</th>
								<th class="tdbtn-3"></th>
								<th class="tdbtn-2"></th>
							</tr>

							<?php  
							
								foreach($logasor as $logacek){
							?>

							<tr>
								<td class="tdbtn"><?= $logacek['log_ip'] ?></td>
								<td><?= $logacek['log_oncekiSayfa'] ?></td>
								<td><?= $logacek['log_suanSayfa'] ?></td>
								<td class="tdbtn"><?= $logacek['log_zaman'] ?></td>
								<td class="tdbtn-4"><?= $logacek['log_dil'] ?></td>
								<td class="tdbtn-3">
									<span id="ipdurum">
											<?php if(logdurum($logacek['log_ip'])=='1'){ ?>
												<span id="aktif">Aktif</span>
											<?php }elseif(logdurum($logacek['log_ip'])=='0'){ ?>
												<span id="pasif">Pasif</span>
											<?php }else{ ?>
												<span id="pasif">Belirsiz</span>
											<?php } ?>
									</span>
								</td>
								<td class="tdbtn-2">
									<?php  

									$ipengelsor = $db->prepare("SELECT * FROM logengelip WHERE engel_ip=:engel_ip");
									$ipengelsor->execute([
										'engel_ip' => $logacek['log_ip']
									]);
									$ipengelcek = $ipengelsor ->fetch(PDO::FETCH_ASSOC);

									
									if($logacek['log_ip'] == $ipengelcek['engel_ip']){
									?>
									<form method="POST" action="adming/islem.php">
										<input type="hidden" name="log_ip" value="<?= $logacek['log_ip'] ?>">
										<button id="ipengelle" name="ipengelkaldir" style="background: #D1DBBD">Engelli</button>
									</form>
									<?php }else{ ?>
									<form method="POST" action="adming/islem.php">
										<input type="hidden" name="log_ip" value="<?= $logacek['log_ip'] ?>">
										<button id="ipengelle" name="ipengelle">Engelle</button>
									</form>
									<?php } ?>
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