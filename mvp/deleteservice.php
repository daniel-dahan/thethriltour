<?php
	include("src/include/head.html");
	include("php/functions.php");
	include("php/bdd.php");
	verifyAccessAdmin();
	$delete = $bdd->prepare('DELETE FROM `services` WHERE `services`.`id` = :id');
	$delete->execute(array(
		'id' => $_GET['id']
	));
	header('location: admin.php');
?>