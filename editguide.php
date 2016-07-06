<?php
	include("src/include/head.html");
	include("php/functions.php");
	include("php/bdd.php");
	verifyAccessAdmin();
	if($_POST['nom']){
		$edit = $bdd->prepare('UPDATE guide SET nom = :nom, prenom = :prenom, blog = :blog, description = :description WHERE id = :id;');
		$edit->execute(array(
			'nom' => $_POST['nom'],
			'prenom' => $_POST['prenom'],
			'blog' => $_POST['blog'],
			'description' => $_POST['description'],
			'id' => $_POST['id']
		));
		header('location: admin.php');
	}
	$guide = $bdd->query('SELECT * FROM `guide` WHERE `id` = '.$_GET['id']);
	if(!$guide){
		return;
	}
	while ($donnees = $guide->fetch()){
		$id = $donnees['id'];
		$nom = $donnees['nom'];
		$prenom = $donnees['prenom'];
		$blog = $donnees['blog'];
		$description = $donnees['description'];
	}
?>
	<title>THE THRILL TOUR - Modifier un service</title>
	</head>
	<body>
		<form action="editguide.php" method="POST">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="text" name="nom" value="<?php echo $nom; ?>" />
			<input type="text" name="prenom" value="<?php echo $prenom; ?>" />
			<input type="text" name="blog" value="<?php echo $blog; ?>" />
			<input type="text" name="description" value="<?php echo $description; ?>" />
			<input type="submit" value="Modifier" />
		</form>
	</body>
</html>