<?php

$request = $bdd->query('SELECT nom FROM groupe WHERE id = ' . $_POST['id_groupe']);
$donnees = $request->fetch();
$request->closeCursor();

$request = $bdd->prepare('INSERT INTO iv VALUES('', :nom, 1, 1, 0)');
$request->bindParam(':nom', $donnees['nom'], PDO::PARAM_STR);
$request->execute();
$request->closeCursor();

$lastId = $bdd->lastinsertId();

echo json_encode($lastId);
