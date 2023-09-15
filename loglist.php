<?php include 'ortakphp.php';

$logsor = $db->prepare("SELECT * FROM log GROUP BY log_ip");
$logsor->execute();
$logsay = $logsor->rowCount();

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
	<title>Log | Dashboard</title>
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
					<h1>Log Kontrol</h1>
					<!-- <a href="ekle.php" id="listekle">Toplam : <?=$logsay; ?></a> -->
				</div>
				<div class="list-children">
					<div class="list-child">
						<table>
							<tr>
								<th class="tdbtn-4"></th>
								<th class="tdbtn">Ip</th>
								<th>Önceki Sayfa</th>
								<th>Şuanki Sayfa</th>
								<th class="tdbtn">Zaman</th>
								<th class="tdbtn-4">Dil</th>
								<th class="tdbtn-3"></th>
								<th class="tdbtn-2"></th>
							</tr>

							<?php  
								$logsor = $db->prepare("SELECT log_id, MAX(log_id) AS son_id FROM log GROUP BY log_ip ORDER BY log_id DESC limit $goster,$limit");
								$logsor->execute();
								foreach($logsor as $logcek){

								$son_id = $logcek['son_id'];

								$sonlogsor = $db->prepare("SELECT * FROM log WHERE log_id='$son_id'");
								$sonlogsor->execute();
								foreach($sonlogsor as $sonlogcek){
							?>

							<tr>
								<td class="tdbtn-4"><a href="ziyaretci-<?= seo($sonlogcek['log_ip']."-".$sonlogcek['log_id']); ?>" style="display: flex; align-items: center;justify-content: center;margin-left: 2px;"	><img src="img/icon/search.png" class="listicon" style="margin-right: 0; padding: 1.5px"></a></td>
								<td class="tdbtn"><?= $sonlogcek['log_ip'] ?></td>
								<td><?= $sonlogcek['log_oncekiSayfa'] ?></td>
								<td><?= $sonlogcek['log_suanSayfa'] ?></td>
								<td class="tdbtn"><?= $sonlogcek['log_zaman'] ?></td>
								<td class="tdbtn-4"><?= $sonlogcek['log_dil'] ?></td>
								<td class="tdbtn-3">
									<span id="ipdurum">
											<?php if(logdurum($sonlogcek['log_ip'])=='1'){ ?>
												<span id="aktif">Aktif</span>
											<?php }elseif(logdurum($sonlogcek['log_ip'])=='0'){ ?>
												<span id="pasif">Pasif</span>
											<?php }else{ ?>
												<span id="pasif">Belirsiz</span>
											<?php } ?>
									</span>
								</td>
								<td class="tdbtn-2">
									<form>
										<button id="ipengelle">Engelle</button>
									</form>
								</td>
							</tr>
							<?php } } ?>
						
						</table>
					</div>
				</div>
				<div class="list-sayfa">
					<div class="say_sabit"><a href="loglist.php?sayfa=1"><img src="img/icon/enleft.png"></a></div>
					<div class="say_sabit"><a href="loglist.php?sayfa=<?=$sayfa - 1?>"><img src="img/icon/left.png"></a></div>
					<?php
						 for($i = $sayfa - $gorunen_sayfa; $i < $sayfa + $gorunen_sayfa +1; $i++){
						 	 if($i > 0 and $i <= $sayfa_sayisi){
						 	 	if($i == $sayfa){
            						echo '<span class="say_aktif">'.$i.'</span>';
         						}else{
            						echo '<a class="say_sirala" href="loglist.php?sayfa='.$i.'">'.$i.'</a>';

							         }

							      }

							   }

					?>
					<div class="say_sabit"><a href="loglist.php?sayfa=<?=$sayfa + 1?>"><img src="img/icon/right.png"></a></div>
					<div class="say_sabit"><a href="loglist.php?sayfa=<?=$sayfa_sayisi?>"><img src="img/icon/enright.png"></a></div>
				</div>
			</div>
		</section>

	</main>


<?php include "footer.php" ?>