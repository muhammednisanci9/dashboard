<?php include 'ortakphp.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include 'ortakhead.php'; ?>
</head>
<body>

	<main>
		<form method="POST" action="" enctype="multipart/form-data">
			<input type="file" name="resim">
			<button>haha</button>
		</form>

		<?php 

		
		echo "<pre>";
		print_r($_FILES['resim']);
		echo "</pre>";


		if($_FILES['resim']['error']==0){
		echo $logo_yol = "img/ayar/";echo "<br>";
		echo $logo_isim = $_FILES['resim']['name'];echo "<br>";
		echo $logo_type = $_FILES['resim']['type'];echo "<br>";
		echo $logo_gecisim = $_FILES['resim']['tmp_name'];echo "<br>";
		echo $logo_boyut = $_FILES['resim']['size'];echo "<br>";
		echo $logo_randsayi = rand(1,100000);echo "<br>";
		
		$logo_ayirisim = explode(".", $logo_isim);
		echo $logo_ayrikisim = $logo_ayirisim['0'];echo "<br>";

		$logo_ayirtype = substr($logo_isim, -4,4);
		echo $logo_sontype = $logo_ayirtype;echo "<br>";

		echo $logo_kayitisim = $logo_ayrikisim.$logo_randsayi.".".$logo_sontype;echo "<br>";

		move_uploaded_file($logo_gecisim, $logo_yol.$logo_kayitisim);
		}



		?>

	</main>


<?php include 'footer.php'; ?>