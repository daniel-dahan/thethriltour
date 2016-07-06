<?php
	include("bdd.php");
	$n = "\n";
	$reponse = $bdd->query('SELECT * FROM infos');
	while ($donnees = $reponse->fetch())
	{
	//=====Définition du sujet.
	$sujet = "Commande The Thrill Tour";
	$sujet = htmlspecialchars($sujet);
	//=====Création du header de l'e-mail.
	$header = "From: The Thrill Tour < eightballagency@gmail.com >" . $n;
	$header .= "MIME-Version: 1.0" . $n;
	$header .= "Content-Type: text/plain; charset=\"utf-8\";";

	$message = . 'Bonjour,' . $n . ' nous vous informons que The Thrill Tour ouvre ses portes aujourd\'hui !' . $n .
		'Réservez dès maintenant pour tenter de participer à l\'expérience la plus dingue de votre vie !' . $n .
		'http://thethrilltour.com/';

	//=====Envoi de l'e-mail.
	if (!mail($donnees['mail'], $sujet, $message, $header)) {
		exit("Nous n'avons pas réussi à envoyer le mail !");
	}
	//==========
	}
	$reponse->closeCursor();
?>