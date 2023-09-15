<!DOCTYPE html>
<html lang="tr">
<head>
	<title>Dashboard | Ana Sayfa</title>
	<?php include 'ortakhead.php'; ?>
</head>
<body>
	<?php include 'bar.php'; ?>

	<main>
		<section class="topanaliz">
			<div class="topanaliz-container">
				<?php include 'topanaliz.php'; ?>
			</div>
		</section>


		<section class="randomanaliz">
			<div class="randomanaliz-container">
				<div class="randomanaliz-children">



					<div class="randomanaliz-child">
						<div class="randomanaliz-title">
							<span>Trafik</span>
						</div>
						<div class="yatayanaliz-container">
							<ol id="yatayanaliz-item"></ol>
						</div>
						<canvas id="linecanvas" style="height: 150px"></canvas>
					</div>


					<div class="randomanaliz-child">
						<div class="randomanaliz-title">
							<span>Trafik</span>
						</div>
						<div class="yatayanaliz-container">
							<ol id="yatayanaliz-item"></ol>
						</div>
						<canvas id="barcanvas" style="height: 150px"></canvas>
					</div>









					<div class="randomanaliz-child">
						<div class="randomanaliz-title">
							<span>Site Bulunma</span>
						</div>
						
						<div class="yatayanaliz-container">
							<ol id="yatayanaliz-item">
								<li>
									<span>Google Arama</span>
									<div class="yatayanaliz-bg">
										<span style="width: 14%; background: #2ec4b6"></span>
										<span></span>
									</div>
									<div class="yatayanaliz-oran">
										<span id="yatayanaliz-oran">%14</span>
										<!-- <img src="img/icon/bottom.png"> -->
									</div>
								</li>
								<li>
									<span>Direk</span>
									<div class="yatayanaliz-bg">
										<span style="width: 14%; background: #ffbf69"></span>
										<span></span>
									</div>
									<div class="yatayanaliz-oran">
										<span id="yatayanaliz-oran">%14</span>
										<!-- <img src="img/icon/bottom.png"> -->
									</div>
								</li>
								<li>
									<span>Diğer</span>
									<div class="yatayanaliz-bg">
										<span style="width: 14%; background: #fad2e1"></span>
										<span></span>
									</div>
									<div class="yatayanaliz-oran">
										<span id="yatayanaliz-oran">%14</span>
										<!-- <img src="img/icon/bottom.png"> -->
									</div>
								</li>
							</ol>
						</div>
					</div>




					<div class="randomanaliz-child" style="padding-top: 50px">
						<div class="randomanaliz-title">
							<span>Site Bulunma</span>
						</div>
						<div class="pastagrafikanaliz-circle">
							<canvas id="piecanvas" height="150px"></canvas>
						</div>
					</div>




					

				</div>
			</div>
		</section>




	</main>

	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>






	<script type="text/javascript">
		var ctx = document.getElementById('barcanvas').getContext('2d');
		var barcanvas = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: [
			        <?php  

			        $bugun = date("Y-m-d 00:00:00");

			        for($g = 1; $g <=7; $g++){
						$azal = "-".$g."day";

						$gun = strtotime($azal, strtotime($bugun));

						$gun = date("D",$gun);


						echo "'".$gun."'".",";
					}
		        	?>
		        ],
		        datasets: [{
		            label: 'Bu Hafta',
		            data: [
		           		<?php	

		           		$dun = strtotime('-1 day', strtotime($bugun));
						$dun = date("Y-m-d 00:00:00",$dun);

						$yarin = strtotime('+1 day', strtotime($bugun));
						$yarin = date("Y-m-d 00:00:00",$yarin);
		            	for($g = 7; $g >=1; $g--){

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
		            backgroundColor: [
		                '#3a506b',
		                '#3a506b',
		                '#3a506b',
		                '#3a506b',
		                '#3a506b',
		                '#3a506b',
		                '#3a506b'
		            ],

		            fill: false
		        },
		        {
					label: 'Geçen Hafta',
		            data: [
		           		<?php	
		           		$bugun = date("Y-m-d 00:00:00");
		           		$bugun = strtotime('-1 day', strtotime($bugun));
						$bugun = date("Y-m-d 00:00:00",$bugun);

		           		$dun = strtotime('-1 day', strtotime($bugun));
						$dun = date("Y-m-d 00:00:00",$dun);

						$yarin = strtotime('+1 day', strtotime($bugun));
						$yarin = date("Y-m-d 00:00:00",$yarin);
		            	for($g = 7; $g >=1; $g--){

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
		            backgroundColor: [
		                '#1d2d44',
		                '#1d2d44',
		                '#1d2d44',
		                '#1d2d44',
		                '#1d2d44',
		                '#1d2d44',
		                '#1d2d44'
		            ],
		            fill: false
		        }]
		    },
		  
		});
	</script>


















	<script type="text/javascript">
		var ctx = document.getElementById('linecanvas').getContext('2d');
		var linecanvas = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: [
			        <?php  

			        $bugun = date("Y-m-d 00:00:00");

			        for($bg = 1; $bg <=7; $bg++){
						$bazal = "-".$bg."day";

						$gun = strtotime($bazal, strtotime($bugun));

						$gun = date("D",$gun);


						echo "'".$gun."'".",";
					}
		        	?>
		        ],
		        datasets: [{
		            label: 'Bu Hafta',
		            data: [
		           		<?php	

		           		$dun = strtotime('-1 day', strtotime($bugun));
						$dun = date("Y-m-d 00:00:00",$dun);

						$yarin = strtotime('+1 day', strtotime($bugun));
						$yarin = date("Y-m-d 00:00:00",$yarin);
		            	for($g = 7; $g >=1; $g--){

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
		                '#4d7cfe',
		            ],

		            borderWidth: 5,
		            fill: false
		        },
		        {
					label: 'Geçen Hafta',
		            data: [
		           		<?php	
		           		$bugun = date("Y-m-d 00:00:00");
		           		$bugun = strtotime('-1 day', strtotime($bugun));
						$bugun = date("Y-m-d 00:00:00",$bugun);

		           		$dun = strtotime('-1 day', strtotime($bugun));
						$dun = date("Y-m-d 00:00:00",$dun);

						$yarin = strtotime('+1 day', strtotime($bugun));
						$yarin = date("Y-m-d 00:00:00",$yarin);
		            	for($g = 7; $g >=1; $g--){

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
		                '#ED5564',
		            ],
		            borderWidth: 5,
		            fill: false
		        }]
		    },
		  
		});
	</script>










	<script type="text/javascript">
		var ctx = document.getElementById('piecanvas').getContext('2d');
		var piecanvas = new Chart(ctx, {
		    type: 'pie',
		    data: {
		        labels: ['Organik', 'Direk', 'Diğer'],
		        datasets: [{
		            label: '# of Votes',
		            data: [<?= number_format($organikyuzde,2) ?>, <?= number_format($direkyuzde,2) ?>, <?= number_format($digeryuzde,2) ?>],
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)'
		            ],
		            borderColor: [
		                'rgba(255, 99, 132, 1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)'
		            ],
		            borderWidth: 0
		        }]
		    },
		  
		});
	</script>


<?php include "footer.php" ?>