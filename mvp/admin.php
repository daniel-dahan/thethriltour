<?php
	include("src/include/head.html");
	include("php/bdd.php");
	session_start();
	if(!isset($_SESSION['admin'])){
		header('location: backoffice.php');
	};
	
	$festival = $bdd->query('SELECT * FROM `festival` ORDER BY id DESC LIMIT 1');
	if(!$festival) {
		return;
	}
	
	$lastFestival = $festival->fetch()
/*
	while ($donnees = $festival->fetch()) {

	}
	*/
?>
		<title>Administration The Thrill Tour</title>
		<style>
		body{
			color: white;
		}
		</style>
		<link rel="stylesheet" href="src/css/materialize.min.css">
		<link rel="stylesheet" href="src/css/back.css">
	</head>
	<body>
<h2>Dernier festival</h2>

<div>
	<ul class="dernier_festival">
		<li><span class="span-festival">Nom: </span><?= $lastFestival['nom'] ?></li>
		<li><span class="span-festival">Description: </span><?= $lastFestival['description'] ?></li>
		<li><span class="span-festival">Lieux: </span><?= $lastFestival['place'] ?></li>
		<li><span class="span-festival">Date: </span><?= $lastFestival['day']?>/<?= $lastFestival['month']?>/<?= $lastFestival['year'] ?></li>
		<li><span class="span-festival">Video: </span><?= $lastFestival['video'] ?></li>
		<li><span class="span-festival">Thumbnail: </span><?= $lastFestival['thumbnail'] ?></li>
		<li><span class="span-festival">Couleur: </span><?= $lastFestival['couleur'] ?></li>
	</ul>
</div>
<!--<?php

		echo ($lastFestival['nom'].'<br />'
			.$lastFestival['description'].'<br />'
			.$lastFestival['place'].'<br />'
			.$lastFestival['day'].' '
			.$lastFestival['month'].' '
			.$lastFestival['year'].'<br />'
			.$lastFestival['video'].'<br />'
			.$lastFestival['thumbnail'].'<br />'
			.$lastFestival['couleur'].'<br />');
		
		$guide = $bdd->query('SELECT * FROM `guide` WHERE `id` = '.$lastFestival["id_guide"].'');
		$id_services = $bdd->query('SELECT `id_services` FROM `festival_services` WHERE `id_festival` = '.$lastFestival["id"].'');	
		
		while ($data_id_services = $id_services->fetch()){
			$services = $bdd->query('SELECT * FROM `services` WHERE `id` = '.$data_id_services["id_services"].'');	
			while ($data_services = $services->fetch()){
				echo ($data_services['detail'].'<br />');
			}
		}
		
		while ($data_guide = $guide->fetch()){
			echo ($data_guide['nom'] .'<br />'. $data_guide['prenom'] .'<br />'. $data_guide['description'] .'<br />'. $data_guide['blog'].'<br /><br />');
		}
?>-->




		<h2>Les festivals</h2>
		<div class="festivale-modif">
					<div>
						<ul id="dernier_festival">
							<li><?= $donnees['nom'] ?></li>
						</ul>
					</div>
			<?php
				$festival = $bdd->query('SELECT * FROM `festival`');
				if(!$festival){
					return;
				}
				while ($donnees = $festival->fetch()){
					echo ($donnees['nom'].'<a href="editfestival.php?id='.$donnees['id'].'">Modifier</a><a href="deletefestival.php?id='.$donnees['id'].'">Supprimer</a><br>');
				}
			?>
			<ul><li><?= $donnees['nom'] ?></li></ul>
			<a href="addfestival.php">
				Ajouter un nouveau festival
			</a>
		</div>
		<h2>Les services</h2>
		<div class="services-modif">

			<?php
				$services = $bdd->query('SELECT * FROM `services`');
				if(!$services){
					return;
				}
				while ($donnees = $services->fetch()){
					echo ($donnees['detail'].'<a href="editservice.php?id='.$donnees['id'].'">Modifier</a><a href="deleteservice.php?id='.$donnees['id'].'">Supprimer</a>');
				}
			?>
			<a href="addservice.php">
				Ajouter un nouveau service
			</a>
		</div>
		<h2>Les guides</h2>
		<div class="guide-modif">
			<?php
				$guide = $bdd->query('SELECT * FROM `guide`');
				if(!$guide){
					return;
				}
				while ($donnees = $guide->fetch()){
					echo ($donnees['prenom'].' '.$donnees['nom'].'<a href="editguide.php?id='.$donnees['id'].'">Modifier</a><a href="deleteguide.php?id='.$donnees['id'].'">Supprimer</a><br />');
				}
			?>
			<a href="addguide.php">
				Ajouter un nouveau guide
			</a>
		</div>

	</body>
	<div class="festival">
		<h1><?php echo $donnees['nom'] ?></h1>
	</div>
</html>