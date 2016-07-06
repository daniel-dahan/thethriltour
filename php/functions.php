<?php

function verifyAccessAdmin() {
	if(!isset($_SESSION['admin'])){
		header('location: backoffice.php');
		exit();
	};
}

function listFestivalRand( $nom, $nb = 1 ) {
	global $bdd;
	$aReturn = array();
	if ( is_numeric($nb) ) {
		$sSql = 'SELECT * FROM festival WHERE nom NOT LIKE :nom ORDER BY rand() LIMIT '.$nb;
		$oPrepare = $bdd->prepare($sSql);
		$oPrepare->execute(array(
			'nom' => $nom
		));
		while ( $list = $oPrepare->fetch() ) {
			$aReturn[$list['id']] = array(
				'nom' => $list['nom'],
				'slug' => $list['slug'],
				'couleur' => $list['couleur']
			);
		}
	}
	return $aReturn;
}