<?php

$request = $bd->prepare('SELECT p.id, p.programmation, p.date_debut, p.date_fin FROM programmation p
	JOIN objet_programmation op ON op.IDProgrammation = p.id
	JOIN objet o ON o.id = op.IDObjet
	JOIN constitution_groupe cp ON cp.IDObjet = o.id WHERE cp.IDGroupe = :salle AND o.nom = :charge');

$request->bindParam(':salle', $_POST['salle'], PDO::PARAM_STR);
$request->bindParam(':charge', $_POST['charge'], PDO::PARAM_STR);

$request->execute();

$programmations = [];
while ($donnees = $request->fetch())
{
	$programmations[] = $donnes;
}

echo json_encode($programmations);
