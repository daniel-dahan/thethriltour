<?php
	include("src/include/head.html");
	include("php/functions.php");
	include("php/bdd.php");
	verifyAccessAdmin();
	if($_POST['nom']){
		$fichier = "";
		if(isset($_FILES['thumbnail']))
		{ 
			$dossier = 'media/img/';
			$fichier = basename($_FILES['thumbnail']['name']);
			$taille = filesize($_FILES['thumbnail']['tmp_name']);
			$taille_maxi = 100000000;
			$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.PNG', '.JPG');
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
		$add = $bdd->prepare('INSERT INTO `festival` (`id`, `nom`, `slug`, `description`, `place`, `day`, `month`, `year`, `video`, `thumbnail`, `couleur`, `id_guide`) 
		VALUES (NULL, :nom, :slug, :description, :place, :day, :month, :year, :video, :thumbnail, :couleur, :guide);');
		$add->execute(array(
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
			'guide' => $_POST['guide']
		));
		if(!empty($_POST['services'])){
			$id_data = $bdd->lastInsertId();
			foreach($_POST['services'] as $val)
			{
				$addService = $bdd->prepare('INSERT INTO `festival_services` (`id`, `id_festival`, `id_services`) VALUES (NULL, :id, :service);');
				$addService->execute(array(
				'id' => $id_data,
				'service' => $val
			));
			}
		}
		header('location: admin.php');
	}
?>
	<link rel="stylesheet" href="src/css/back.css">
	<title>THE THRILL TOUR - Ajouter un festival</title>
	</head>
	<body>
		<form action="addfestival.php" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="" />
			<input type="text" name="nom" value="" placeholder="nom" class="input-field col s6" />
			<input type="text" name="slug" value="" placeholder="url" class="input-field col s6"/>
			<input type="textarea" name="description" value="" placeholder="description" class="materialize-textarea"/>
			<input type="text" name="place" value="" placeholder="place" />
			<input type="number" name="day" value="" placeholder="day" />
			<input type="number" name="month" value="" placeholder="month" />
			<input type="number" name="year" value="" placeholder="year" />
			<input type="text" name="video" value="" placeholder="video" />
			<div class="file-field input-field">
				<span>Upload File</span>
				<input type="file" name="thumbnail" value="" class="file-path validate" />
			</div>
			<select name="couleur" >
				<option value="orange">Orange</option>
				<option value="blue">Bleu</option>
				<option value="rose">Rose</option>
			</select>
			<?php
			$services = $bdd->query('SELECT * FROM `services`');
				if(!$services){
					return;
				}
				while ($donnees = $services->fetch()){
					echo ('<label for="service'.$donnees['id'].'">'.$donnees['detail'].'</label><input type="checkbox" name="services[]" value="'.$donnees["id"].'" />');
				}
			$guide = $bdd->query('SELECT * FROM `guide`');
				if(!$guide){
					return;
				}
				while ($donnees = $guide->fetch()){
					echo ('<label for="guide'.$donnees['id'].'"">'.$donnees['prenom'].' '.$donnees['nom'].'</label><input type="radio" name="guide" value="'.$donnees["id"].'" />');
				}
			?>
			<input type="submit" value="Ajouter" />
		</form>
	</body>
</html>