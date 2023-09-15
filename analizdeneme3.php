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
			
			// $neredenssor = $db->prepare("SELECT log_ip, MIN(log_id) AS logs_sid FROM log GROUP BY log_id ORDER BY log_id DESC");
			// $neredenssor->execute();
			// $neredensssay = $neredenssor->rowCount();
			// echo $neredensssay."<hr>";

			

			// $neredengelen = $neredencek['log_oncekiSayfa'];
			// $neredengelenson = explode("/", $neredengelen);
			// echo $neredengelenson2 = $neredengelenson['2'];


			// if(isset($neredengelenson2)){
			// 	if($neredengelenson2=="www.google.com"){
			// 		echo "evet";
			// 	}else{
			// 		echo "hayır";
			// 	}
			// }


			$neredensor = $db->prepare("SELECT log_oncekiSayfa FROM log");
			$neredensor->execute();
			$neredencek = $neredensor->fetch(PDO::FETCH_ASSOC);
			$neredengelensonsay = $neredensor->rowCount();
			$neredengelensonsay."<br>";

			$direksay = 0;
			$organiksay = 0;

			foreach($neredensor as $neredengel){

				$neredengelen = $neredengel['log_oncekiSayfa'];
				$neredengelenson = explode("/", $neredengelen);

				

				if(isset($neredengelenson['2'])){
					if($neredengelenson['2']=="www.google.com"){
						$organiksay++;
					}else{
					}
				}
				


				if($neredengelenson['0']=="Direk"){
						$direksay++;
				}else{
				}
				

				
			}
				echo $organiksay."<br>";
				echo $direksay;
				$diror = $organiksay + $direksay;
				$diger = $neredengelensonsay - $diror;
				echo "<br>".$diger;

		?>



	</main>


<?php include 'footer.php'; ?>