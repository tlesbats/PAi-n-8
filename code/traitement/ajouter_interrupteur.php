<?php

$createdInterrupteur = array(
	'nom' => $_POST['nom']
);

$request = $bdd->prepare('INSERT INTO iv VALUES(:name)');
$request->exec($createdInterrupteur);
$request->closeCursor();
$cratedInterrupteur['id'] = $bdd->lastInsertId();

echo json_encode($createdInterrupteur);
