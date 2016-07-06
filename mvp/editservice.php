	<?php
	include("src/include/head.html");
	include("php/functions.php");
	include("php/bdd.php");
	verifyAccessAdmin();
	if($_POST['detail']){
		$edit = $bdd->prepare('UPDATE services SET detail = :detail WHERE id = :id;');
		$edit->execute(array(
			'detail' => $_POST['detail'],
			'id' => $_POST['id']
		));
		header('location: admin.php');
	}
	$services = $bdd->query('SELECT * FROM `services` WHERE `id` = '.$_GET['id']);
	if(!$services){
		return;
	}
	while ($donnees = $services->fetch()){
		$id = $donnees['id'];
		$detail = $donnees['detail'];
	}
?>
	<title>THE THRILL TOUR - Modifier un service</title>
	<link rel="stylesheet" href="src/css/materialize.min.css">
	<link rel="stylesheet" href="src/css/back.css">
	</head>
	<body>
		<h2>THE THRILL TOUR - Modifier un service</h2>
		<form action="editservice.php" method="POST">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="text" name="detail" value="<?php echo $detail; ?>" />
			<input type="submit" value="Modifier" />
		</form>
	</body>
</html>