<?php

$createdSource = array(
	'nom' 	=> $_POST['nom'],
	'icone' => $_POST['icone'],
	'couleur' => $_POST['couleur'],
);

$request = $bdd->prepare('INSERT INTO objet VALUES(:nom, :icone)');
$request->exec($createdSource);
$request->closeCursor();

$createdSource['id'] = $bdd->lastInsertId();

$request = $bdd->prepare('INSERT INTO source VALUES(:id, :couleur)');
$request->execute($createdSource);

echo json_encode($createdSource);
