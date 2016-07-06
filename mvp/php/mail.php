<?php
	include("bdd.php");
	if(!isset($_POST["mail"])) {
		return;
	}
	$mail = $_POST['mail'];
	if (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
		$emailErr = "Adresse email invalide";
		echo($emailErr);
		return;
	}
	$result = $bdd->prepare('SELECT COUNT(*) FROM infos WHERE mail=:mail');
	$result->execute(array('mail' => $mail));
	if($result->fetchColumn() == 0) {
		$insert = $bdd->prepare('INSERT INTO infos (id, mail) VALUES (NULL, :mail)');
		$insert->execute(array('mail' => $mail));
	}
	/* AFFICHAGE DES EMAILS ENREGISTRES
		$reponse = $bdd->query('SELECT * FROM infos');
		while ($donnees = $reponse->fetch())
		{
			echo $donnees['mail']. '<br>';
		}
		$reponse->closeCursor();
	*/
	//==========
?>