<?php 
	session_start();
	include("src/include/head.html");
	include("php/bdd.php");
	if($_POST['username'] && $_POST['password']){
		$connexion = $bdd->query('SELECT password FROM `users` WHERE `username` = \'admin\'');
		if(!$connexion){
			return;
		}
		while ($donnees = $connexion->fetch()){
			$hash = $donnees['password'];
		}
		if(password_verify($_POST['password'], $hash)){
			$_SESSION['admin'] = 1;
			header('location: admin.php');
		}
	}
?>
<link rel="stylesheet" href="src/css/materialize.min.css">
<link rel="stylesheet" href="src/css/back.css">
<title>THE THRILL TOUR - ADMIN</title>
<style type="text/css">
body {
	color: white;
}
</style>
</head>
<body id="accueil">
	<form action="backoffice.php" method="POST">
		<input type="text" name="username" placeholder="Username" class="input-field col s6" />
		<input type="password" name="password" placeholder="Password"class="input-field" />
		<input type="submit" value="Connexion" />
	</form>
</body>
</html>