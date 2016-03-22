<?php

$request = $db->prepare('INSERT INTO source VALUES(:nom, :icone, :couleur)');

$request->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
$request->bindParam(':icone', $_POST['icone'], PDO::PARAM_STR);
$request->bindParam(':couleur', $_POST['couleur'], PDO::PARAM_STR);

$request->execute();

$id = $db->lastInsertId();

$createdSource = {
	'nom' 	=> $_POST['nom'],
	'icone' => $_POST['icone'],
	'couleur' => $_POST['couleur'],
	'id' => $id
};

echo json_encode($createdSource);
