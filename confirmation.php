<?php
	include("php/bdd.php");
	include("php/functions.php");
	$slug = $_GET["slug"];
	$festival = $bdd->prepare('SELECT * FROM `festival` WHERE `slug` = :slug');
	$festival->execute(array(
		'slug' => $_GET['slug']
	));
	if(!$festival){
		return;
	}
	while ($donnees = $festival->fetch()){
		$nom = $donnees['nom'];
		$couleur = $donnees['couleur'];
	}
	include("src/include/head.html");
?>
<body id="confirmation" class="<?=$couleur?>">
	<?php include("src/include/header.html") ?>
	<div class="wrapper900">
		<h2>MERCI</h2>
		<div class="circle"></div>
		<p class="thanks">
			Votre réservation The Thrill Tour pour le festival de <?php echo $nom; ?> a bien été pris en compte, 
			un mail de confirmation vient de vous être envoyé.
		</p>
		<a href="/festival/<?php echo $slug;?>.html" title="Retourner vers <?php echo $nom ?>" class="buttonBig">Continuer</a>
	</div>
<?php
	include("src/include/footer.html");
?>
</body>
</html>