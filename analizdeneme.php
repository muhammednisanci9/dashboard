<?php include 'ortakphp.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include 'ortakhead.php'; ?>
</head>
<body>
	<?php include 'bar.php'; ?>


	<main>
		<?php 

		$bugun = date("Y-m-d 00:00:00");

		$dun = strtotime('-1 day', strtotime($bugun));
		$dun = date("Y-m-d 00:00:00",$dun);

		$yarin = strtotime('+1 day', strtotime($bugun));
		$yarin = date("Y-m-d 00:00:00",$yarin);

		for($g = 1; $g <=7; $g++){

			$azal = "-".$g."day";

			$gun = strtotime($azal, strtotime($yarin));
			echo "<br>".$gun = date("Y-m-d 00:00:00",$gun);

			$gun2 = strtotime($azal, strtotime($bugun));
			$gun2 = date("Y-m-d 00:00:00",$gun2);
			echo "<br>".$gun2."<hr>";



			$gunsor = $db->prepare("SELECT * FROM log WHERE log_zaman BETWEEN '$gun2' AND '$gun' GROUP BY log_ip");
			$gunsor->execute();
			$gunsay = $gunsor->rowCount();

			echo "<br>".$gunsay;


			
			@$toplamgunsay += $gunsay; 
		}

		echo "<br>".$toplamgunsay;

		?>	

		<?php 

		for($g = 1; $g <=7; $g++){

			$azal = "-".$g."day";

			$gun = strtotime($azal, strtotime($bugun));
			$gun = date("D",$gun);

			echo "<br>".$gun;

		}



		?>
		




	</main>




<?php include 'footer.php'; ?>