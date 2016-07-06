<?php
	include("src/include/head.html");
	include("php/functions.php");
	include("php/bdd.php");
	verifyAccessAdmin();
	if($_POST['nom']){
		$fichier = "";
		if(isset($_FILES['thumbnail']) && basename($_FILES['thumbnail']['name']) != $thumbnail)
		{ 
			$dossier = 'media/img/';
			$fichier = basename($_FILES['thumbnail']['name']);
			$taille = filesize($_FILES['thumbnail']['tmp_name']);
			$taille_maxi = 100000000;
			$extensions = array('.png', '.gif', '.jpg', '.jpeg');
			$extension = strrchr($_FILES['thumbnail']['name'], '.'); 
			if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
			{ 
				$erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg';
			}
			if($taille>$taille_maxi)
			{
				 $erreur = 'Le fichier est trop gros...';
			}
			if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
			{
				$fichier = strtr($fichier, 
				'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
				'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
				$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
				if(move_uploaded_file($_FILES['thumbnail']['tmp_name'], $dossier . $fichier))
				{
				  echo 'Upload effectué avec succès !';
				}
				else
				{
				  echo 'Echec de l\'upload !';
				}
			}
		}
		$edit = $bdd->prepare('UPDATE festival SET nom = :nom, slug = :slug, description = :description, place = :place, day = :day, month = :month, year = :year, video = :video, thumbnail = :thumbnail, couleur = :couleur, id_guide = :guide WHERE id = :id;');
		$edit->execute(array(
			'nom' => $_POST['nom'],
			'slug' => $_POST['slug'],
			'description' => $_POST['description'],
			'place' => $_POST['place'],
			'day' => $_POST['day'],
			'month' => $_POST['month'],
			'year' => $_POST['year'],
			'video' => $_POST['video'],
			'thumbnail' => $fichier,
			'couleur' => $_POST['couleur'],
			'guide' => $_POST['guide'],
			'id' => $_POST['id']
		));
		$delService = $bdd->prepare('DELETE FROM `festival_services` WHERE `id_festival` = :id');
		$delService->execute(array(
			'id' => $_POST['id']
		));
		if(!empty($_POST['services'])){
			foreach($_POST['services'] as $val)
			{
				$addService = $bdd->prepare('INSERT INTO `festival_services` (`id`, `id_festival`, `id_services`) VALUES (NULL, :id, :service)');
				$addService->execute(array(
					'id' => $_POST['id'],
					'service' => $val
				));
			}
		}
		header('location: admin.php');
	}
	$festival = $bdd->query('SELECT * FROM `festival` WHERE `id` = '.$_GET['id']);
	if(!$festival){
		return;
	}
	while ($donnees = $festival->fetch()){
		$id = $donnees['id'];
		$nom = $donnees['nom'];
		$slug = $donnees['slug'];
		$description = $donnees['description'];
		$place = $donnees['place'];
		$day = $donnees['day'];
		$month = $donnees['month'];
		$year = $donnees['year'];
		$video = $donnees['video'];
		$thumbnail = $donnees['thumbnail'];
		$couleur = $donnees['couleur'];
		$guide = $bdd->query('SELECT * FROM `guide` WHERE `id` = '.$donnees["id_guide"].'');
		$id_services = $bdd->query('SELECT `id_services` FROM `festival_services` WHERE `id_festival` = '.$donnees["id"].'');	
		$aServices = array();
		$i = 0;
		while ($data_services = $id_services->fetch()){
			$aServices[$i] = $data_services["id_services"];
			$i++;
		}
		while ($data_guide = $guide->fetch()){
			$nomGuide = $data_guide['nom'];
			$prenomGuide = $data_guide['prenom'];
			$descriptionGuide = $data_guide['description'];
			$lienGuide = $data_guide['blog'];
		}
	}
?>
	<title>THE THRILL TOUR - Modifier <?php echo $nom ?></title>
	<link rel="stylesheet" href="src/css/materifalize.min.css">
	<link rel="stylesheet" href="src/css/back.css">
	</head>
	<body>
		<form class="form-editfestival"action="editfestival.php" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="text" name="nom" value="<?php echo $nom; ?>" />
			<input type="text" name="slug" value="<?php echo $slug; ?>" />
			<input type="textarea" name="description" value="<?php echo $description; ?>" />
			<input type="text" name="place" value="<?php echo $place; ?>" />
			<input type="number" name="day" value="<?php echo $day; ?>" />
			<input type="number" name="month" value="<?php echo $month; ?>" />
			<input type="number" name="year" value="<?php echo $year; ?>" />
			<input type="text" name="video" value="<?php echo $video; ?>" />
			<input type="file" name="thumbnail" value="<?php echo $thumbnail; ?>" />
			<select name="couleur" >
				<option value="orange" <?php if($couleur == "orange"){ echo 'selected'; }?>>Orange</option>
				<option value="blue" <?php if($couleur == "blue"){ echo 'selected'; }?>>Bleu</option>
				<option value="rose" <?php if($couleur == "rose"){ echo 'selected'; }?>>Rose</option>
			</select>
			<?php
			$services = $bdd->query('SELECT * FROM `services`');
				if(!$services){
					return;
				}
				while ($donnees = $services->fetch()){
					if(in_array($donnees["id"], $aServices)) {
						echo ('<label for="service'.$donnees['id'].'"">'.$donnees['detail'].'</label><input type="checkbox" name="services[]" checked value="'.$donnees["id"].'" />');
					}
					else{
						echo ('<label for="service'.$donnees['id'].'"">'.$donnees['detail'].'</label><input type="checkbox" name="services[]" value="'.$donnees["id"].'" />');
					}
				}
			$guide = $bdd->query('SELECT * FROM `guide`');
				if(!$guide){
					return;
				}
				while ($donnees = $guide->fetch()){
					if($donnees["nom"] == $nomGuide){
						echo ('<label for="guide'.$donnees['id'].'"">'.$donnees['prenom'].' '.$donnees['nom'].'</label><input type="radio" name="guide" checked value="'.$donnees["id"].'" />');
					}
					else{
						echo ('<label for="guide'.$donnees['id'].'"">'.$donnees['prenom'].' '.$donnees['nom'].'</label><input type="radio" name="guide" value="'.$donnees["id"].'" />');
					}
				}
			?>
			<input class="bouton_envoye" type="submit" value="Modifier" />
		</form>
	</body>
</html>