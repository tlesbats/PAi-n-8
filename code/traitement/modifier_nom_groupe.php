<?php

$request = $bdd->prepare('UPDATE groupe SET nom = :nom WHERE id = :id');

$request->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
$request->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
$request->execute();
$request->closeCursor();

$newNom = array(
	'nom' => $_POST['nom']
);

echo json_encode($newNom);
