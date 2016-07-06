<?php
	include("src/include/head.html");
	include("php/functions.php");
	include("php/bdd.php");
	verifyAccessAdmin();
	if($_POST['detail']){
		$add = $bdd->prepare('INSERT INTO `services` (`id`, `detail`) VALUES (NULL, :detail);');
		$add->execute(array(
			'detail' => $_POST['detail']
		));
		header('location: admin.php');
	}
?>
	<link rel="stylesheet" href="src/css/materialize.min.css">
	<link rel="stylesheet" href="src/css/back.css">
	<title>THE THRILL TOUR - Ajouter un service</title>
	</head>
	<body>
		<form action="addservice.php" method="POST">
			<input type="hidden" name="id" value="" />
			<input type="text" name="detail" value="" placeholder="detail" />
			<input type="submit" value="Ajouter" />
		</form>
	</body>
</html>