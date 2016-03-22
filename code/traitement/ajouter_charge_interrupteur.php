<?php

$request = $bdd->prepare('INSERT INTO pilotage_iv_charge VALUES(:id_interrupteur, :id_charge)');

$request->bindParam(':id_interrupteur', $_POST['id_interrupteur'], PDO::PARAM_INT);
$request->bindParam(':id_charge', $_POST['id_charge'], PDO::PARAM_INT);

$request->execute();
$request->closeCursor();

$retour = array(
	'id_interrupteur' => $_POST['id_interrupteur'],
	'id_charge' => $_POST['id_charge']
);

$request = $bdd->query('SELECT nom FROM objet WHERE id = ' . $retour['id_charge']);
$donnee = $request->fetch();
$retour['nom_charge'] = $donnee['nom'];
$request->closeCursor();

$request = $bdd->prepare('SELECT name FROM iv WHERE id = ' . $retour['id_interrupteur']);
$donnee = $request->fetch();
$retour['nom_interrupteur'] = $donnee['name'];
$request->closeCursor();

echo json_encode($retour);
