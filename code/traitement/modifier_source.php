<?php

$request = $db->prepare('UPDATE source SET nom = :nom, icone = :icone, couleur = :couleur WHERE id = :id');

$request->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
$request->bindParam(':icone', $_POST['icone'], PDO::PARAM_STR);
$request->bindParam(':couleur', $_POST['couleur'], PDO::PARAM_STR);
$request->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

$request->execute();

$updatedSource = {
	'id' => $_POST['id'],
	'nom' => $_POST['nom'],
	'couleur' => $_POST['couleur'],
	'icone' => $_POST['icone']
};

echo json_encode($updatedSource);
