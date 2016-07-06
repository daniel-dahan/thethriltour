<?php
	include("src/include/head.html");
	include("php/functions.php");
	include("php/bdd.php");
	verifyAccessAdmin();
	if($_POST['prenom']){
		$add = $bdd->prepare('INSERT INTO `guide` (`id`, `nom`, `prenom`, `blog`, `description`) VALUES (NULL, :nom, :prenom, :blog, :description);');
		$add->execute(array(
			'nom' => $_POST['nom'],
			'prenom' => $_POST['prenom'],
			'blog' => $_POST['blog'],
			'description' => $_POST['description']
		));
		header('location: admin.php');
	}
?>
	<title>THE THRILL TOUR - Ajouter un service</title>
	<link rel="stylesheet" href="src/css/materialize.min.css">
	<link rel="stylesheet" href="src/css/back.css">
	</head>
	<body>
		<form action="addguide.php" method="POST">
			<input type="hidden" name="id" value="" />
			<input type="text" name="prenom" value="" placeholder="prenom" />
			<input type="text" name="nom" value="" placeholder="nom" />
			<input type="text" name="blog" value="" placeholder="lien blog" />
			<input type="text" name="description" value="" placeholder="description" />
			<input type="submit" value="Ajouter" />
		</form>
	</body>
</html>