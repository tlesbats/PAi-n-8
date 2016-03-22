<?php

$updatedSource = array(
	'id' => $_POST['id'],
	'nom' => $_POST['nom'],
	'couleur' => $_POST['couleur'],
	'icone' => $_POST['icone']
);

$request = $bdd->prepare('UPDATE objet SET nom = :nom, icone = :icone WHERE id = :id');
$request->exec($updatedSource);
$request->closeCursor();

$request = $bdd->prepare('UPDATE source SET couleur = :couleur WHERE id = :id');
$request->exec($updatedSource);
$request->closeCursor();

echo json_encode($updatedSource);
