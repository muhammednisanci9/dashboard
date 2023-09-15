<?php include 'ortakphp.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include 'ortakhead.php'; ?>
</head>
<body>

	<main>
		
		<?php  

		$bugun = date("Y-m-d 00:00:00");
		$suan = date("Y-m-d H:i:s");


		$gelensor = $db->prepare("SELECT log_zaman,log_ip, MIN(log_id) AS song_id FROM log WHERE log_zaman BETWEEN '$bugun' AND '$suan' GROUP BY log_ip ORDER BY log_id DESC");
		$gelensor->execute();
		// $gelencek = $gelensor->fetch(PDO::FETCH_ASSOC);

		foreach($gelensor AS $gelencek){


			$gelenid = $gelencek['song_id'];

			$gelenksor = $db->prepare("SELECT * FROM log WHERE log_id=:log_id");
			$gelenksor->execute([
				'log_id' => $gelenid
			]);
			foreach($gelenksor AS $gelenkcek){
				echo $gelenkcek['log_oncekiSayfa']."<br>";
				echo $gelenkcek['log_suanSayfa']."<br>";
				echo $gelenkcek['log_id']."<br>";
				echo $gelenkcek['log_zaman']."<br>"."<hr>";
			}

		}

		?>



	</main>


<?php include 'footer.php'; ?>