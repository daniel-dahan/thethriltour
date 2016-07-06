<?php

try
{
	$bdd = new PDO('mysql:host=91.216.107.162;dbname=theth723926;charset=utf8', 'theth723926', '8ballagency');
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}

?>